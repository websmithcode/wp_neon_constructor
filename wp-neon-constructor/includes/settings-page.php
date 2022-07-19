<?php
if (function_exists('acf_add_options_page')) :

  acf_add_options_page(array(
    'page_title' => 'Neon Constructor',
    'menu_slug' => 'wp-neon-constructor',
    'menu_title' => 'Neon Constructor',
    'capability' => 'edit_posts',
    'position' => '80',
    'parent_slug' => '',
    'icon_url' => '',
    'redirect' => true,
    'post_id' => 'wp-neon-constructor',
    'autoload' => false,
    'update_button' => 'Update',
    'updated_message' => 'Options Updated',
    'active' => true,
  ));

  add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('wp_admin_neon_constructor', $this->plugin_url . 'admin/dist/style.css');
  });

endif;


if (function_exists('acf_add_local_field_group')) :

  acf_add_local_field_group(array(
    'key' => 'group_62750a3585ed6',
    'title' => 'Neon Constructor',
    'fields' => array(
      array(
        'key' => 'field_62750b00c36c4',
        'label' => 'Fonts',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
        'no_preference' => 0,
        'acfe_field_group_condition' => 0,
      ),
      array(
        'key' => 'field_62750a49b0efb',
        'label' => 'Fonts',
        'name' => 'fonts',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => 'fonts',
          'id' => '',
        ),
        'acfe_repeater_stylised_button' => 0,
        'collapsed' => '',
        'min' => 0,
        'max' => 0,
        'layout' => 'block',
        'button_label' => '',
        'acfe_field_group_condition' => 0,
        'sub_fields' => array(
          array(
            'key' => 'field_627545346d1c7',
            'label' => 'Name',
            'name' => 'name',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => 'name',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'acfe_field_group_condition' => 0,
          ),
          array(
            'key' => 'field_62d5869605ced',
            'label' => 'Spelling',
            'name' => 'spelling',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => 'spelling',
              'id' => '',
            ),
            'choices' => array(
              'lat' => 'lat',
              'cyr' => 'cyr',
            ),
            'default_value' => array(
              0 => 'lat',
              1 => 'cyr',
            ),
            'allow_null' => 0,
            'multiple' => 1,
            'min' => '',
            'max' => '',
            'ui' => 1,
            'ajax' => 0,
            'return_format' => 'value',
            'allow_custom' => 0,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'acfe_field_group_condition' => 0,
          ),
          array(
            'key' => 'field_62d6be92c002b',
            'label' => 'Base size',
            'name' => 'base_size',
            'type' => 'number',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => 'font-base-size',
              'id' => '',
            ),
            'required_message' => '',
            'default_value' => 96,
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'min' => '',
            'max' => '',
            'step' => '',
            'acfe_field_group_condition' => 0,
          ),
          array(
            'key' => 'field_62751618f2605',
            'label' => 'Preview',
            'name' => 'preview',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => 'preview',
              'id' => '',
            ),
            'uploader' => '',
            'acfe_thumbnail' => 0,
            'return_format' => 'array',
            'preview_size' => 'FontPreview',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
            'acfe_field_group_condition' => 0,
            'library' => 'all',
          ),
          array(
            'key' => 'field_62750b2e7d08e',
            'label' => 'File',
            'name' => 'file',
            'type' => 'file',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => 'file',
              'id' => '',
            ),
            'uploader' => '',
            'return_format' => 'array',
            'min_size' => '',
            'max_size' => '',
            'mime_types' => 'ttf,otf,woff,woff2',
            'upload_folder' => '',
            'multiple' => 0,
            'max' => '',
            'acfe_field_group_condition' => 0,
            'library' => 'all',
          ),
        ),
      ),
      array(
        'key' => 'field_62750b13cbb6c',
        'label' => 'Colors',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
        'no_preference' => 0,
        'acfe_field_group_condition' => 0,
      ),
      array(
        'key' => 'field_62750ac0b0efc',
        'label' => 'Colors',
        'name' => 'colors',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'acfe_repeater_stylised_button' => 0,
        'collapsed' => '',
        'min' => 0,
        'max' => 0,
        'layout' => 'table',
        'button_label' => '',
        'acfe_field_group_condition' => 0,
        'sub_fields' => array(
          array(
            'key' => 'field_627516fbf9932',
            'label' => 'Name',
            'name' => 'name',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'acfe_field_group_condition' => 0,
          ),
          array(
            'key' => 'field_627590cd4bdf6',
            'label' => 'Description',
            'name' => 'description',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
            'acfe_field_group_condition' => 0,
          ),
          array(
            'key' => 'field_62750ac8b0efd',
            'label' => 'Color',
            'name' => 'color',
            'type' => 'color_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'acfe_field_group_condition' => 0,
            'default_value' => '',
            'enable_opacity' => false,
            'return_format' => 'value',
            'display' => 'default',
            'button_label' => 'Select Color',
            'color_picker' => true,
            'absolute' => false,
            'input' => true,
            'allow_null' => true,
            'alpha' => false,
            'theme_colors' => false,
            'colors' => array(),
          ),
          array(
            'key' => 'field_62751732f9933',
            'label' => 'Preview',
            'name' => 'preview',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'uploader' => '',
            'acfe_thumbnail' => 0,
            'return_format' => 'array',
            'preview_size' => 'NeonPreview',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
            'acfe_field_group_condition' => 0,
            'library' => 'all',
          ),
          array(
            'key' => 'field_62751753f9934',
            'label' => 'DetailPreview',
            'name' => 'detail-preview',
            'type' => 'image',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'uploader' => '',
            'acfe_thumbnail' => 0,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'min_width' => '',
            'min_height' => '',
            'min_size' => '',
            'max_width' => '',
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
            'acfe_field_group_condition' => 0,
            'library' => 'all',
          ),
        ),
      ),
      array(
        'key' => 'field_627518d65b7d2',
        'label' => 'Settings',
        'name' => '',
        'type' => 'tab',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'placement' => 'top',
        'endpoint' => 0,
        'no_preference' => 0,
        'acfe_field_group_condition' => 0,
      ),
      array(
        'key' => 'field_627518df5b7d3',
        'label' => 'Background Image',
        'name' => 'background_image',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'uploader' => '',
        'acfe_thumbnail' => 0,
        'return_format' => 'array',
        'preview_size' => 'medium',
        'min_width' => '',
        'min_height' => '',
        'min_size' => '',
        'max_width' => '',
        'max_height' => '',
        'max_size' => '',
        'mime_types' => '',
        'acfe_field_group_condition' => 0,
        'library' => 'all',
      ),
      array(
        'key' => 'field_6275a1cf2dc16',
        'label' => 'Submit Text',
        'name' => 'submit_text',
        'type' => 'text',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
        'acfe_field_group_condition' => 0,
      ),
      array(
        'key' => 'field_6275a27da7de4',
        'label' => 'Popup Form',
        'name' => 'popup_form',
        'type' => 'wysiwyg',
        'instructions' => 'Can contains shortcodes',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'tabs' => 'all',
        'toolbar' => 'full',
        'media_upload' => 1,
        'delay' => 0,
        'acfe_wysiwyg_height' => 300,
        'acfe_wysiwyg_max_height' => '',
        'acfe_wysiwyg_valid_elements' => '',
        'acfe_wysiwyg_custom_style' => '',
        'acfe_wysiwyg_disable_wp_style' => 0,
        'acfe_wysiwyg_autoresize' => 0,
        'acfe_wysiwyg_disable_resize' => 0,
        'acfe_wysiwyg_remove_path' => 0,
        'acfe_wysiwyg_menubar' => 0,
        'acfe_wysiwyg_transparent' => 0,
        'acfe_wysiwyg_merge_toolbar' => 0,
        'acfe_wysiwyg_custom_toolbar' => 0,
        'acfe_field_group_condition' => 0,
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'wp-neon-constructor',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'left',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'acfe_autosync' => '',
    'acfe_form' => 0,
    'acfe_display_title' => '',
    'acfe_meta' => '',
    'acfe_note' => '',
  ));

endif;
