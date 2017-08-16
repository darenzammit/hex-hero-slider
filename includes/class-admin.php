<?php

class Hex_Hero_Slider_Admin {

	/**
	 * HexHeroSlider Constructor.
	 */
	function __construct() {

		$this->add_options_page();

		add_filter('acf/load_field/name=hero_slider_display', [$this, "remove_default_option_from_settings"]);

	}

	/**
	 * Add Hero Options Page
	 */
	private function add_options_page() {

		if (function_exists('acf_add_options_page')) {
			acf_add_options_sub_page([
				'page_title'  => 'Hero Slider Settings',
				'menu_title'  => 'Settings',
				'menu_slug'   => 'settings',
				'parent_slug' => 'edit.php?post_type=hex_hero_slide',
			]);
		}

	}

	/**
	 * Remove the Default option from the settings page
	 */
	public function remove_default_option_from_settings($field) {

		if (is_admin() && $current_screen = get_current_screen()) {
			if ('hex_hero_slide_page_settings' == $current_screen->id) {
				unset($field['choices']['default']);
			}
		}

		return $field;

	}

}

new Hex_Hero_Slider_Admin();