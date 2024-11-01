<?php
/**
 * @package team-vs
 */
namespace vcore\base;

defined( 'ABSPATH' ) or die( 'Write Something to Show!' );
/**
 * Activate Functionality
 */
class Vsactivate {
	public static function Teavs_activate() {
		flush_rewrite_rules();
	}
}