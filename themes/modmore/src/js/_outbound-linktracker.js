/**
 * @component outbound-linktracker
 * Track outbound links in Google Analytics
 */
;(function ($, window, document, undefined) {
    'use strict';

    // current page host
    var baseURI = window.location.host;

    // click event on body
    $('body').on('click', 'a[href^="//"],a[href^="http"]', function(e) {

        // only continue if click is triggered by a human
        if (e.originalEvent === undefined) return;

        // abandon if analytics is not available
        if (typeof ga !== 'function') return;

        // abandon if no active link or link within domain
        var $link = $(this);
        if ($link.length !== 1 || baseURI == $link[0].host) return;

        var href = $link.attr('href');
        ga('send', {
            'hitType': 'event',
            'eventCategory': 'Outbound Links',
            'eventAction': 'click',
            'eventLabel': href
         });

        return true;
    });

}(jQuery, window, window.document));