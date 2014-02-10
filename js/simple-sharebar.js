jQuery(document).ready(function ($) {
	// Simple Sharbar Plugin
	if ($('body').hasClass('single')) {
	  var timeout = null; var entryShare = $('#ssbp-widgets').first(); var entryContent =$('.entry-content').first();
	  $(window).scroll(function () {
		var scrollTop = $(this).scrollTop();
		if(!timeout) {
		  timeout = setTimeout(function() { timeout = null;
			if (entryShare.css('position') !== 'fixed' && entryShare.offset().top < $(document).scrollTop()) {
			  entryContent.css('padding-top', entryShare.outerHeight() + 8);
			  entryShare.css({'background': '#fff', 'z-index': 500, 'position': 'fixed', 'top': 0, 'width': entryContent.width()});
			} else if ($(document).scrollTop() <= entryContent.offset().top) {
			  entryContent.css('padding-top', '');
			  entryShare.css({ 'position': '', 'z-index': '', 'width': ''});
			}
		  }, 250);
		}
	  });
	}
});  