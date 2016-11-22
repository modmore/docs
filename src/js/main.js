// import "_modernizr.js";

// import "_helper.js";
// import "_outbound-linktracker.js";
// import "../bower_components/foundation-sites/dist/plugins/foundation.core.js";
// import "../bower_components/foundation-sites/dist/plugins/foundation.util.mediaQuery.js";
// import "../bower_components/foundation-sites/dist/plugins/foundation.util.keyboard.js";
// import "../bower_components/foundation-sites/dist/plugins/foundation.util.timerAndImageLoader.js";
// import "../bower_components/foundation-sites/dist/plugins/foundation.tabs.js";



/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	on jQuery ready
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
$(function(){


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 *	init Foundation Components
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	$(document).foundation();


	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 *	mobile navigation toggle / hamburger
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

	var $nav = $('.pagenav'),
		$menuButton = $('.open-nav'),
		$triggerWord = $('.trigger-status');

	$menuButton.on('click', function(){
		$(this).toggleClass('active');
		$nav.toggleClass('active');

		if ($nav.hasClass('active') === true) {
			$(this).attr('aria-expanded','true');
			$triggerWord.text('Close');
		} else {
			$(this).attr('aria-expanded','false');
			$triggerWord.text('Open');
		}
	});

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     *	scroll to id from url hash
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

        if (window.location.hash !== '' && window.location.hash.charAt(1) != '&' && $(window.location.hash).length > 0) {
        	$("html, body").animate({ scrollTop: $(window.location.hash).offset().top - 100 }, 1000);
        }
    
    
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     *	process link tags
     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

    	$('body').on('click', 'a', function(e){
    		var href = $(this).attr('href');

    		// scroll to id if hash link clicked
    		if (href.charAt(0) == '#' && href.length > 1 && $(href).length && typeof $(href).attr('aria-expanded') !== 'undefined') {
    			e.preventDefault();
    		    $('html, body').animate({
    		        scrollTop: ($(href).offset().top - 13)
    		    }, 1000);
    		    return false;
    	    }

    	    return true;
    	});
});