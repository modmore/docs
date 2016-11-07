/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *	_helper.js
 *  contains small bug fixes or polyfills or new feature
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

// make sure the Antenne Object contains all containers
if (typeof modmore === 'undefined') modmore = {};
if (typeof modmore.config === 'undefined') modmore.config = {};
if (typeof modmore.client === 'undefined') modmore.client = {};


// Lighweight wrapper for console.log
// via http://paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
    if (typeof Antenne.config.logging !== 'undefined' && Antenne.config.logging === false) return;
    log.history = log.history || [];   // store logs to an array for reference
    log.history.push(arguments);
    if(window.console){
        console.log( Array.prototype.slice.call(arguments) );
    }
};

if (!Date.now) {
    Date.now = function() { return new Date().getTime(); };
}

// get random integer
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// add/update query parameters in a url
function updateUrlParameter(uri, key, value) {
    // remove the hash part before operating on the uri
    var i = uri.indexOf('#');
    var hash = i === -1 ? ''  : uri.substr(i);
    uri = i === -1 ? uri : uri.substr(0, i);

    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
        uri = uri.replace(re, '$1' + key + "=" + value + '$2');
    } else {
        uri = uri + separator + key + "=" + value;
    }
    // finally append the hash as well
    return uri + hash;
}

// parse a url (via http://james.padolsey.com/javascript/parsing-urls-with-the-dom/)
/* jshint ignore:start */
function parseUrl(url) {
    var a =  document.createElement('a');
    a.href = url;

    var query = {};
    var search = a.search.substr(1).split('&');
    for (var i = 0; i < search.length; i++) {
        var b = search[i].split('=');
        query[decodeURIComponent(b[0])] = decodeURIComponent(b[1] || '');
    }

    return {
        source: url,
        protocol: a.protocol.replace(':',''),
        hostname: a.hostname,
        port: a.port,
        query: a.search,
        params: query
    };
}
/* jshint ignore:end */