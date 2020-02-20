/* ----------------------------------------------------------
  Page loader
---------------------------------------------------------- */

(function wpupagetransitions_front() {
    'use strict';

    var transition_expire = parseInt(wpupagetransitions_settings.transition_expire, 10);
    var $loader = false;

    function domReady(func) {
        if (/in/.test(document.readyState) || !document.body) {
            setTimeout(function() {
                domReady(func);
            }, 18);
        }
        else {
            func();
        }
    }
    domReady(hide_loader);

    function hide_loader() {
        if (!$loader) {
            $loader = document.querySelector('.page-loader');
        }
        if ($loader.classList.contains('is-disabled')) {
            return;
        }
        $loader.classList.add('is-disabled');
    }

    function display_loader() {
        if (!$loader) {
            $loader = document.querySelector('.page-loader');
        }
        $loader.classList.remove('is-disabled');
    }


    window.addEventListener("popstate", hide_loader);
    window.addEventListener("beforeunload", display_loader);

    setInterval(hide_loader, transition_expire);

}());
