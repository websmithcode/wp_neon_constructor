<?php

/**
 * Plugin Name: Neon Constructor
 * Description: Template of plagin from dev kit
 * Version: 0.1.6
 * Author: Alexander Smith
 * Author URI: https://t.me/alxndr_smith
 */

namespace WPNeonConstructor;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

if (!class_exists('WPNeonConstructor')) :

  require('deps_check.php');
  $depsChecker = new DepsChecker(__FILE__);
  $depsChecker->init([
    'advanced-custom-fields-pro',
    'file-upload-types',
  ]);

  add_action('n_core_defined', '\WPNeonConstructor\wp_neon_constructor');
  function wp_neon_constructor()
  {
    class WPNeonConstructor extends \Nillkizz\PluginBase
    {
      public $includes = [
        // 'rest_api.php', // Uncomment, if rest needs
        'includes/settings-page.php',
      ];
      public $shortcodes = [
        'wp-neon-constructor',
      ];
      public $js_scripts = [];
      public $css_styles = [
        'dashicons',
        ['name' => 'wp_neon_constructor-style', 'path' => 'public/css/style.css']
      ];
      public $image_sizes = [
        ['FontPreview', 80, 25, false],
        ['NeonPreview', 335, 150, true],
      ];
    }


    global $wp_neon_constructor;
    // Instantiate only once.
    if (!isset($wp_neon_constructor)) {
      $wp_neon_constructor = new WPNeonConstructor(__FILE__);
      add_action('init', [$wp_neon_constructor, 'initialize']);
    }
    return $wp_neon_constructor;
  }
endif;
