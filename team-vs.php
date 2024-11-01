<?php
/*
	Plugin Name: VS Team - Team Showcase WordPress
	Plugin URI: http://vecurosoft.com/products/plugins/vs-wp-team-showcase/
	Description: VS Team – Team Showcase WP Plugin developed with creative & modern web trends to provide the best. Its design with fully responsive layout that will fit any device.
	Version: 1.0
	Author: vecurosoft
	Author URI: https://themeforest.net/user/vecuro
	License: GPLv2 or Later
	Text Domain: team-vs
*/
/*
VS Team PLUGIN is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
VS Team PLUGIN is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with VS Team PLUGIN. If not, see {URI to Plugin License}.
*/

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );

if (file_exists(dirname(__FILE__).'/vendor/autoload.php')) {
	require_once dirname(__FILE__).'/vendor/autoload.php';
}

// This code that runs during plugin Activation
function Team_VS_activation() {
	vcore\base\Vsactivate::Teavs_activate();
}
register_activation_hook( __FILE__, 'Team_VS_activation' );

// VS Team Register Files
if (class_exists( 'vcore\\VSinit' )) {
	vcore\VSinit::team_register();
}