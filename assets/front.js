/* ----------------------------------------------------------
  Page loader
---------------------------------------------------------- */

(function wpupagetransitions_front() {
    'use strict';

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
    domReady(set_loader);

    function set_loader() {
        var $loader = document.querySelector('.page-loader');
        if ($loader.classList.contains('is-disabled')) {
            return;
        }
        $loader.classList.add('is-disabled');
        window.addEventListener("beforeunload", function() {
            $loader.classList.remove('is-disabled');
        });
    }

    window.addEventListener("popstate", set_loader);

    setTimeout(set_loader, 3000);

}());
