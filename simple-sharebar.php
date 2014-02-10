<?php
/**
 * @package Simple_Sharbar
 */
/*
	Plugin Name: 	Genesis Simple Sharebar
 *	Plugin URI:		http://www.blogsynthesis.com/plugins/simple-sharebar/
 *	Author:			BlogSynthesis
 *	Author URI: 	http://www.blogsynthesis.com
 *	Version: 		0.1.0
 *	Description: 	A simple lightweight sharebar plugin for Genesis Framework.
 *
 *
 *	License: GPLv2 or later
 *
 *
 **/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


//* Define our constants
define( 'SIMPLESHAREBAR_SETTINGS_FIELD', 'simplesharebar-settings' );
define( 'SIMPLESHAREBAR_PLUGIN_DIR', dirname( __FILE__ ) );


register_activation_hook( __FILE__, 'simplesharebar_activation' );
/**
 * This function runs on plugin activation. It checks to make sure Genesis
 * or a Genesis child theme is active. If not, it deactivates itself.
 *
 * @since 0.1.0
 */
function simplesharebar_activation() {

	if ( ! defined( 'PARENT_THEME_VERSION' ) || ! version_compare( PARENT_THEME_VERSION, '2.0.0', '>=' ) )
		simplesharebar_deactivate( '2.0.0', '3.6' );

}

/**
 * Deactivate Simple Sharebar.
 *
 * This function deactivates Simple Sharebar.
 *
 * @since 0.1.0
 */
function simplesharebar_deactivate() {
	
	deactivate_plugins( plugin_basename( __FILE__ ) );
	wp_die( sprintf( __( 'Sorry, This plugin will work only with <strong><a href="%s">Genesis Framework</a></strong> (or its child theme). First install the Genesis Framework then activate this plugin. <br /> <br />Visit <strong><a href="%s">BlogSynthesis</a></strong> for more info.', 'simplesharebar' ), 'http://www.blogsynthesis.com/go/genesis/', 'http://www.blogsynthesis.com/genesis-simple-sharebar/#installation' ) );
	
}

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'wpa_custom_scripts' );
function wpa_custom_scripts() {
	wp_enqueue_style( 'simple-sharebar', plugins_url( 'css/style.css', __FILE__ ) );
	wp_enqueue_script( 'simple-sharebar', plugins_url( 'js/simple-sharebar.js', __FILE__ ), array( 'jquery' ) );
}

/** Add Genesis Box on Single Posts **/
add_action('genesis_entry_content', 'gssb_the_bar', 3 );
function gssb_the_bar() {
    if ( is_single() ) { ?>
		
		<div id="ssbp-widgets" class="ssbp-widgets">
			<div class="ssbp-share-txt">Share:</div>

			<div class="ssbp-btn facebook-widget">
				<div class="fb-like" data-href="<?php echo get_permalink(); ?>" data-send="false" data-layout="button_count" data-width="62" data-show-faces="false"></div>
			</div>

			<div class="ssbp-btn google-widget">
				<div class="g-plusone" data-href="<?php echo get_permalink(); ?>" data-size="medium"></div>
			</div>

			<div class="ssbp-btn twitter-widget">
				<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php the_title(); ?>" data-url="<?php the_permalink(); ?>" data-via="netrival" data-related="NetRival">Tweet</a>
			</div>

			<div class="ssbp-btn twitter-widget">
				<a href="http://bufferapp.com/add" class="buffer-add-button" data-text="<?php the_title(); ?>" data-url="<?php echo get_permalink(); ?>" data-count="none" data-via="UbuntuBeginner" data-related="NetRival">Buffer</a>
			</div>

			<div class="ssbp-btn twitter-widget">
			<a href="https://twitter.com/UbuntuBeginner" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @UbuntuBeginner</a>
			</div>

		</div>
		<div class="clear"></div>

	<!-- Simple Sharebar Plugin: http://www.blogsynthesis.com/simple-sharebar-plugin/ -->
	<?php }
}

add_action('wp_footer', 'gssb_scripts', 3 );
function gssb_scripts() {
    if ( is_single() ) { ?>
		<script type="text/javascript">
		  (function() {
			var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			po.src = 'https://apis.google.com/js/plusone.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		  })();
		</script>

		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=240260822693130";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<script type="text/javascript" src="http://static.bufferapp.com/js/button.js"></script>
	<?php }
}