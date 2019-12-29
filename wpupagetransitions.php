<?php

/*
Plugin Name: WPU Page Transitions
Plugin URI: https://github.com/WordPressUtilities/wpupagetransitions
Description: Add smooth transitions between pages without AJAX
Version: 0.1.1
Author: Darklg
Author URI: http://darklg.me/
License: MIT License
License URI: http://opensource.org/licenses/MIT
*/

class WPUPageTransitions {
    private $plugin_version = '0.1.1';
    private $color = '#FFFFFF';

    public function __construct() {
        add_action('wp', array(&$this, 'wp'));
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        add_action('wp_head', array(&$this, 'wp_head'));
    }

    public function wp() {
        $this->color = apply_filters('wpupagetransitions_color', $this->color);
    }

    public function wp_enqueue_scripts() {
        wp_register_script('wpupagetransitions-script', plugins_url('assets/front.js', __FILE__), array('jquery'), $this->plugin_version, true);
        wp_register_style('wpupagetransitions-style', plugins_url('assets/front.css', __FILE__), '', $this->plugin_version);
        wp_enqueue_script('wpupagetransitions-script');
        wp_enqueue_style('wpupagetransitions-style');
    }

    public function wp_head() {
        echo '<div class="page-loader" style="background-color:' . $this->color . '"></div>';
    }

}

$WPUPageTransitions = new WPUPageTransitions();
