<?php

/*
Plugin Name: WPU Page Transitions
Plugin URI: https://github.com/WordPressUtilities/wpupagetransitions
Update URI: https://github.com/WordPressUtilities/wpupagetransitions
Description: Add smooth transitions between pages without AJAX
Version: 0.3.0
Author: Darklg
Author URI: https://darklg.me/
License: MIT License
License URI: https://opensource.org/licenses/MIT
*/

class WPUPageTransitions {
    private $plugin_version = '0.3.0';
    private $color = '#FFFFFF';
    private $duration = '1s';
    private $transition_expire = 3000;

    public function __construct() {
        add_action('plugins_loaded', array(&$this, 'plugins_loaded'));
        add_action('wp', array(&$this, 'wp'));
        add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
        add_action('wp_head', array(&$this, 'wp_head'));
        add_action('wp_body_open', array(&$this, 'wp_body_open'));
    }

    function plugins_loaded() {
        include dirname(__FILE__) . '/inc/WPUBaseUpdate/WPUBaseUpdate.php';
        $this->settings_update = new \wpupagetransitions\WPUBaseUpdate(
            'WordPressUtilities',
            'wpupagetransitions',
            $this->plugin_version);
    }

    public function wp() {
        $this->color = apply_filters('wpupagetransitions_color', $this->color);
        $this->duration = apply_filters('wpupagetransitions_duration', $this->duration);
        $this->transition_expire = apply_filters('wpupagetransitions_transition_expire', $this->transition_expire);
    }

    public function wp_enqueue_scripts() {
        wp_register_script('wpupagetransitions-script', plugins_url('assets/front.js', __FILE__), '', $this->plugin_version, true);
        wp_register_style('wpupagetransitions-style', plugins_url('assets/front.css', __FILE__), '', $this->plugin_version);
        wp_localize_script('wpupagetransitions-script', 'wpupagetransitions_settings', array(
            'color' => $this->color,
            'duration' => $this->duration,
            'transition_expire' => $this->transition_expire
        ));
        wp_enqueue_script('wpupagetransitions-script');
        wp_enqueue_style('wpupagetransitions-style');
    }

    public function wp_head() {
        echo '<style>.page-loader{';
        echo 'background-color:' . $this->color . ';';
        echo 'transition-duration:' . $this->duration . ',' . $this->duration . ';';
        echo '}</style>';
    }

    function wp_body_open() {
        echo '<div class="page-loader"></div>';
    }

}

$WPUPageTransitions = new WPUPageTransitions();
