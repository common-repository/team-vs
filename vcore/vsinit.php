<?php
/**
 * @package team-vs
 */
namespace vcore;

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );
/**
 * All File Enqueue and Installation
 */
class VSinit {
	public static function get_files() {
		return [
			base\Vsenqueue::class,
			base\Vsteamcpt::class,
			base\Vsmemberslug::class,
			base\Vshortcodecpt::class,
			pages\Vshortcodequery::class,
		];
	}

	public static function team_register() {
		foreach ( self::get_files() as $class ) {
			$services = self::instantiates( $class );
			if (method_exists( $services, 'register' )) {
				$services->register();
			}
		}
	}

	public static function instantiates( $class ) {
		$service = new $class;
		return $service;
	}
}