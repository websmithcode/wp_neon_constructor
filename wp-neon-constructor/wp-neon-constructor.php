<?php

/**
 * Plugin Name: Neon Constructor
 * Description: Template of plagin from dev kit
 * Version: 0.0.0
 * Author: Alexander Smith
 * Author URI: https://t.me/alxndr_smith
 */

namespace WPNeonConstructor;

use \Nillkizz\PluginBase;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}



if (!class_exists('WPNeonConstructor')) :
  require('deps_check.php');
  $depsChecker = new DepsChecker(__FILE__);
  $depsChecker->init([
    'advanced-custom-fields-pro',
  ]);

  add_action('n_core_defined', '\WPNeonConstructor\wp_neon_constructor');
  function wp_neon_constructor()
  {
    class WPNeonConstructor extends PluginBase
    {
      public $includes = [
        // 'rest_api.php', // Uncomment, if rest needs
      ];
      public $js_scripts = [
        ['name' => 'wp_neon_constructor-main', 'path' => 'public/js/main.js'],
      ];
      public $css_styles = [
        ['name' => 'wp_neon_constructor-style', 'path' => 'public/css/style.css']
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
