<?php

namespace WPNeonConstructor;

(function () use ($public_path) {
  global $wp_neon_constructor;
  $wp_neon_constructor->enqueue_style([
    'name' => 'wp_neon_constructor-shortcode-style',
    'path' => $public_path . 'style.css'
  ]);
  $wp_neon_constructor->enqueue_script([
    'name' => 'wp_neon_constructor-shortcode-script',
    'path' => $public_path . 'script.js',
  ]);

  include_once 'template.php';
})();
