// import "../bower_components/loadjs/loadJS.js";
// import "../bower_components/loadcss/src/loadCSS.js";
// import "../bower_components/loadcss/src/cssrelpreload.js";
// import "../bower_components/svg4everybody/dist/svg4everybody.js";

//init
svg4everybody();

// replace no-js class with js class
(function(h){
    h.className = h.className.replace('no-js', 'js');
})(document.documentElement);

// add HTML5 shiv if needed (simple test if the canvas element exists)
/*jslint evil: true */
if (!document.createElement('canvas').getContext) document.write('<script src="/assets/templates/[[*context_key]]/src/bower_components/html5shiv/dist/html5shiv-printshiv.min.js"><\\/script>');
/*jslint evil: false */

function onContentLoaded(callback) {
    if (document.readyState == "complete" || document.readyState == "loaded") {
        callback(); return;
    }
    if (window.addEventListener)
        window.addEventListener('DOMContentLoaded', callback, false);
    else if (window.attachEvent)
        window.attachEvent('onload', callback);
    else window.onload = callback;
}

// init lazysizes
window.lazySizesConfig = {
    addClasses: true
};

// fallback: show unstyled content if the main stylesheet hasn't been loaded for 3s
setTimeout(function(){
    document.body.style.visibility = 'visible';
    document.body.style.opacity = '1';
}, 3 * 60 * 1000);