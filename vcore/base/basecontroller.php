<?php
/**
 * @package team-vs
 */
namespace vcore\base;

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );
/**
 * BaseController Functionality
 */
class Basecontroller {
	public $file_path;
	public $file_url;
	public $file;

	function __construct() {
		$this->file_path = plugin_dir_path(dirname(__FILE__, 2));
		$this->file_url = plugin_dir_url(dirname(__FILE__, 2));
		$this->file = plugin_basename(dirname(__FILE__, 3).'/team-vs.php');
	}

	// Options Value Key
	public function value_key() {
		$option_key = [
			'_option_fb_value_key' => sanitize_text_field( $_POST['option_fb_value_key']),
			'_option_tw_value_key' => sanitize_text_field( $_POST['option_tw_value_key']),
			'_option_bh_value_key' => sanitize_text_field( $_POST['option_bh_value_key']),
			'_option_in_value_key' => sanitize_text_field( $_POST['option_in_value_key']),
			'_option_dr_value_key' => sanitize_text_field( $_POST['option_dr_value_key'])
		];

		return $option_key;
	}

	public function desvalue_key() {
		$option_key = [
			'_option_designation_value_key' => sanitize_text_field( $_POST['option_designation_value_key']),
		];

		return $option_key;
	}

	public function get_shortcode_admin_value_key() {
		$option_key = [
			'_option_shortcode_value_key' => sanitize_text_field( $_POST['option_shortcode_value_key']),
		];

		return $option_key;
	}

	// ShortCode Options Value Key
	public function shortcode_value_key() {
		$option_key = [
			'_option_layouts_value_key' => sanitize_text_field( $_POST['option_layouts_value_key']),
			'_option_limit_value_key' => sanitize_text_field( $_POST['option_limit_value_key']),
			'_option_slugs_value_key' => sanitize_text_field( $_POST['option_slugs_value_key']),
			'_option_desktop_value_key' => sanitize_text_field( $_POST['option_desktop_value_key']),
			'_option_tab_value_key' => sanitize_text_field( $_POST['option_tab_value_key']),
			'_option_mobile_value_key' => sanitize_text_field( $_POST['option_mobile_value_key']),
			'_option_orderby_value_key' => sanitize_text_field( $_POST['option_orderby_value_key']),
			'_option_order_value_key' => sanitize_text_field( $_POST['option_order_value_key']),
		];

		return $option_key;
	}

}