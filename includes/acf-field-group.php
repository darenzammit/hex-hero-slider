<?php

if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(array(
		'key'                   => 'group_58a3eae964c84',
		'title'                 => 'Hero Slider',
		'fields'                => array(
			array(
				'key'               => 'field_58a3eaed64ed6',
				'label'             => 'Display',
				'name'              => 'hero_slider_display',
				'type'              => 'select',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'choices'           => array(
					'default' => 'Default',
					'custom'  => 'Custom Slides',
					'slider'  => 'Slider',
					'gallery' => 'Gallery',
					'none'    => 'None',
				),
				'default_value'     => array(
				),
				'allow_null'        => 0,
				'multiple'          => 0,
				'ui'                => 0,
				'ajax'              => 0,
				'return_format'     => 'value',
				'placeholder'       => '',
			),
			array(
				'key'               => 'field_58a3eb7d64ed7',
				'label'             => 'Slides',
				'name'              => 'hero_slider_slides',
				'type'              => 'relationship',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_58a3eaed64ed6',
							'operator' => '==',
							'value'    => 'custom',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'post_type'         => array(
					0 => 'hex_hero_slide',
				),
				'taxonomy'          => array(
				),
				'filters'           => array(
					0 => 'search',
				),
				'elements'          => '',
				'min'               => '',
				'max'               => '',
				'return_format'     => 'object',
			),
			array(
				'key'               => 'field_58a3ec8d9e169',
				'label'             => 'Slider',
				'name'              => 'hero_slider_slider',
				'type'              => 'taxonomy',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_58a3eaed64ed6',
							'operator' => '==',
							'value'    => 'slider',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'taxonomy'          => 'hex_hero_slider',
				'field_type'        => 'select',
				'allow_null'        => 0,
				'add_term'          => 1,
				'save_terms'        => 0,
				'load_terms'        => 0,
				'return_format'     => 'id',
				'multiple'          => 0,
			),
			array(
				'key'               => 'field_5947844bae11c',
				'label'             => 'Gallery',
				'name'              => 'hero_slider_gallery',
				'type'              => 'gallery',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_58a3eaed64ed6',
							'operator' => '==',
							'value'    => 'gallery',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'min'               => '',
				'max'               => '',
				'insert'            => 'append',
				'library'           => 'all',
				'min_width'         => '',
				'min_height'        => '',
				'min_size'          => '',
				'max_width'         => '',
				'max_height'        => '',
				'max_size'          => '',
				'mime_types'        => '',
			),
			array(
				'key'               => 'field_5947848fb204f',
				'label'             => 'Content',
				'name'              => 'hero_slider_content',
				'type'              => 'wysiwyg',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_58a3eaed64ed6',
							'operator' => '==',
							'value'    => 'gallery',
						),
					),
				),
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'tabs'              => 'all',
				'toolbar'           => 'full',
				'media_upload'      => 0,
				'delay'             => 0,
			),
			array(
				'key'               => 'field_59770be0b03e9',
				'label'             => 'Fullscreen',
				'name'              => 'hero_slider_fullscreen',
				'type'              => 'true_false',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'message'           => 'Fill Screen Height',
				'default_value'     => 0,
				'ui'                => 0,
				'ui_on_text'        => '',
				'ui_off_text'       => '',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'page',
				),
			),
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'settings',
				),
			),
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'acf-options-options',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'left',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => 1,
		'description'           => '',
		'modified'              => 1501685049,
	));

endif;