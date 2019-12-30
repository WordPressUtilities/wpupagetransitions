/* ----------------------------------------------------------
  Page loader
---------------------------------------------------------- */

(function wpupagetransitions_front() {
    'use strict';

    function domReady(func) {
        if (/in/.test(document.readyState) || !document.body) {
            setTimeout(function() {
                domReady(func);
            }, 9);
        }
        else {
            func();
        }
    }

    domReady(function() {
        var $loader = document.querySelector('.page-loader');
        $loader.classList.add('is-disabled');
        window.addEventListener("beforeunload", function() {
            $loader.classList.remove('is-disabled');
        });
    });

}());
