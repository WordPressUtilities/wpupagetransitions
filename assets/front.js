
/* ----------------------------------------------------------
  Page loader
---------------------------------------------------------- */

jQuery(document).ready(function($) {
    'use strict';
    var $loader = jQuery('.page-loader');

    $loader.addClass('is-disabled');

    window.addEventListener("beforeunload", function(event) {
        $loader.removeClass('is-disabled');
    });
});
