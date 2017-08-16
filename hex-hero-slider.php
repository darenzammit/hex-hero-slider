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

class Hex_Hero_Slider {

	/**
	 * The single instance of the class.
	 * @var HexHeroSlider
	 */
	protected static $_instance = null;

	/**
	 * Main HexHeroSlider Instance.
	 * Ensures only one instance of HexHeroSlider is loaded or can be loaded.
	 * @return HexHeroSlider - Main instance.
	 */
	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * HexHeroSlider Constructor.
	 */
	public function __construct() {
		if ($this->dependencies_loaded()) {
			$this->includes();
			$this->init_hooks();
			$this->register_objects();
		}
	}

	public function dependencies_loaded() {
		if (class_exists('acf')) {
			return true;
		}
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
		add_action('wp_enqueue_scripts', [$this, 'load_scripts']);
		// add_filter('hook', [$this, 'function_callback']);
	}

	/**
	 * Include required files
	 */
	private function includes() {

		/**
		 * Vendor
		 */
		include_once dirname(__FILE__) . '/vendor/johnbillion/extended-cpts/extended-cpts.php';
		include_once dirname(__FILE__) . '/vendor/johnbillion/extended-taxos/extended-taxos.php';

		/**
		 * Field Groups
		 */
		include_once dirname(__FILE__) . '/includes/acf-field-group.php';

		/**
		 * Core classes
		 */
		include_once dirname(__FILE__) . '/includes/class-admin.php';
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

	/**
	 * Returns array of slide post objects
	 */

	public function get_slides() {

		if (!$this->dependencies_loaded()) {
			return;
		}

		$config  = ['post_type' => 'hex_hero_slide', 'posts_per_page' => 50, 'orderby' => 'menu_order'];
		$slides  = (object) [];
		$post_id = get_queried_object();

		if (is_object($post_id)) {
			// post
			if (isset($post_id->post_type, $post_id->ID)) {
				$post_id = $post_id->ID;
				// user
			} elseif (isset($post_id->roles, $post_id->ID)) {
				$post_id = 'user_' . $post_id->ID;
				// term
			} elseif (isset($post_id->taxonomy, $post_id->term_id)) {
				$post_id = 'term_' . $post_id->term_id;
				// comment
			} elseif (isset($post_id->comment_ID)) {
				$post_id = 'comment_' . $post_id->comment_ID;
			} else {
				$post_id = 0;
			}
		}

		$hero_slider_display = get_field('hero_slider_display', $post_id);

		if (empty($hero_slider_display) || ('default' == $hero_slider_display)) {
			$post_id             = 'option';
			$hero_slider_display = get_field('hero_slider_display', $post_id);
		}

		$slides->display = $hero_slider_display;

		if ('custom' == $hero_slider_display) {
			$slides->items = get_field('hero_slider_slides', $post_id);
		}

		if ('slider' == $hero_slider_display) {
			$slides->items = get_posts([
				'tax_query' => [
					[
						'taxonomy' => 'hex_hero_slider',
						'field'    => 'term_id',
						'terms'    => get_field('hero_slider_slider', $post_id),
					],
				],
			] + $config);
		}

		if ('gallery' == $hero_slider_display) {
			$slides->items   = get_field('hero_slider_gallery', $post_id);
			$slides->content = get_field('hero_slider_content', $post_id);
		}

		$slides->object_id = $post_id;

		if (isset($slides->items)) {
			return $slides;
		}

	}

	/**
	 * Renders the slider
	 */
	public function render() {
		global $slides;
		if (apply_filters('hex/hero_slider/show_on', true) && ($slides = $this->get_slides())) {
			$this->get_template_part('slider', $slides->display);
		}
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit(plugin_dir_path(__FILE__));
	}

	/**
	 * Get template part
	 */
	public function get_template_part($slug, $name = '') {
		$template = '';

		// Look in yourtheme/hero-slider/slug-name.php and yourtheme/components/hero-slider/slug-name.php
		if ($name) {
			$template = locate_template(array("hero-slider/{$slug}-{$name}.php", "components/hero-slider/{$slug}-{$name}.php"));
		}

		
		// Get default slug-name.php
		if (!$template && $name && file_exists($this->plugin_path() . "/templates/{$slug}-{$name}.php")) {
			$template = $this->plugin_path() . "/templates/{$slug}-{$name}.php";
		}

		// If template file doesn't exist, look in yourtheme/hero-slider/slug.php and yourtheme/components/hero-slider/slug.php
		if (!$template && !WC_TEMPLATE_DEBUG_MODE) {
			$template = locate_template(array("hero-slider/{$slug}.php", "components/hero-slider/{$slug}.php"));
		}

		// Get default slug.php
		if (!$template && file_exists($this->plugin_path() . "/templates/{$slug}.php")) {
			$template = $this->plugin_path() . "/templates/{$slug}.php";
		}

		if ($template) {
			load_template($template, false);
		}
	}

	/**
	 * Load Scripts
	 */
	public function load_scripts(){

		wp_enqueue_style('swiper', plugins_url('assets/vendor/swiper/css/swiper.min.css', __FILE__), [], '3.4.2');
		wp_enqueue_script('swiper', plugins_url('assets/vendor/swiper/js/swiper.min.js', __FILE__), [], '3.4.2');

		wp_enqueue_style('hex-hero-slider', plugins_url('assets/css/hero-slider.css', __FILE__), ['swiper'], time());
		wp_enqueue_script('hex-hero-slider', plugins_url('assets/js/hero-slider.js', __FILE__), ['swiper'], time());
	}

}

/**
 * Main instance of Hex_Hero_Slider.
 * Returns the main instance of WC to prevent the need to use globals.
 * @return Hex_Hero_Slider
 */

function HeroSlider() {
	return Hex_Hero_Slider::instance();
}

add_action('plugins_loaded', 'HeroSlider');