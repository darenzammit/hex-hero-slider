<?php
/*
Plugin Name: Hex Hero Slider
Description: Slider plugin for pages, posts, archives and more.
Version: 1.0
Author: Daren Zammit
Author URI: https://darenzammit.com/
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class HexHeroSlider {

	/**
	 * HexHeroSlider Constructor.
	 */
	function __construct() {
		$this->includes();
		$this->init_hooks();
		$this->register_objects();
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
		// add_action('hook', [$this, 'function_callback']);
		// add_filter('hook', [$this, 'function_callback']);
	}

	/**
	 * Include required files
	 */
	private function includes() {
		require_once dirname(__FILE__) . '/vendor/johnbillion/extended-cpts/extended-cpts.php';
		require_once dirname(__FILE__) . '/vendor/johnbillion/extended-taxos/extended-taxos.php';
	}

	/**
	 * Register Custom Post Types + Taxonomies
	 */
	private function register_objects() {
		if (function_exists('register_extended_post_type')) {
			$hex_hero_slide = register_extended_post_type(
				'hex_hero_slide',
				[
					'admin_cols'    => [
						'slider' => array(
							'title'    => 'Slider',
							'taxonomy' => 'hex_hero_slider',
						),
					],
					'menu_icon'     => 'dashicons-images-alt',
					'menu_position' => 3,
					'supports'      => ['title', 'revisions', 'editor', 'thumbnail'],
					'labels'        => ['menu_name' => 'Hero Slider'],
					'public'        => false,
					'show_ui'       => true,
				],
				[
					'singular' => 'Slide',
					'plural'   => 'Slides',
					'slug'     => 'slide',
				]
			);
			$hex_hero_slide->add_taxonomy(
				'hex_hero_slider',
				[
					'meta_box'     => 'simple',
					'hierarchical' => false,
				],
				[
					'singular' => 'Slider',
					'plural'   => 'Sliders',
					'slug'     => 'sliders',
				]
			);
		}
	}

}

new HexHeroSlider();