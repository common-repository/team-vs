<?php
/**
 * @package team-vs
 */
namespace vcore\base;
use \vcore\base\basecontroller;

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );
/**
 * Files Enqueue Functionality
 */
class Vsenqueue extends Basecontroller {

	public function register() {
		// Font-End Scripts Enqueue
		add_action( 'wp_enqueue_scripts', [ $this, 'Fontend_Enqueue' ]);
	}

	// Font-End Css & Js Files Include
	public function Fontend_Enqueue() {
		wp_enqueue_style( 'bootstrapCss', $this->file_url.'/assets/css/bootstrap.min.css' ); // Bootstrap Css
		wp_enqueue_style( 'fontawesomeCss', $this->file_url.'/assets/css/fontawesome.min.css' ); // Fontawesome Css
		wp_enqueue_style( 'designCss', $this->file_url.'/assets/css/design.css' ); // Design Css
		wp_enqueue_script( 'popperJs', $this->file_url.'/assets/js/popper.min.js' ); // Bootstrap Popper Js
		wp_enqueue_script( 'bootstrapJs', $this->file_url.'/assets/js/bootstrap.min.js' ); // Bootstrap Js
	}
}