<?php

namespace WPNeonConstructor;

(function () use ($public_path) {
  global $wp_neon_constructor;
  add_action('wp_footer', function () use ($wp_neon_constructor) {
    $wp_neon_constructor->enqueue_script('alpinejs');
  });

  $wp_neon_constructor->enqueue_style([
    'name' => 'wp_neon_constructor-shortcode-style',
    'path' => $public_path . 'style.css'
  ]);
  $wp_neon_constructor->enqueue_script([
    'name' => 'wp_neon_constructor-shortcode-script',
    'path' => $public_path . 'script.js',
    'in_footer' => true
  ]);


  $settings = get_fields('wp-neon-constructor');
  do_action('qm/debug', $settings['colors']);

  $fonts = array_map(function ($font) {
    return [
      'name' => $font['name'],
      'spelling' => $font['spelling'],
      'base_size' => $font['base_size'],
      'preview' => $font['preview']['sizes']['FontPreview'],
      'link' => $font['file']['url'],
    ];
  }, $settings['fonts']);
  $colors = array_map(function ($color) {
    return [
      'name' => $color['name'],
      'color' => $color['color'],
      'description' => $color['description'],
      'preview' => $color['preview']['sizes']['NeonPreview'],
      'detailPreview' => $color['detail-preview']['url']
    ];
  }, $settings['colors']);


  include_once 'template.php';
})();
