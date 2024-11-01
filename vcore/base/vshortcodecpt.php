<?php
/**
 * @package team-vs
 */
namespace vcore\base;
use \vcore\base\basecontroller;
use \vcore\api\callbacks\cptshortcode;

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );
/**
 * Question Custom Post Type Functionality
 */

class Vshortcodecpt extends Basecontroller {

	public $callback;

	public function register() {

		$this->callback = new Cptshortcode();

		add_action( 'init', [ $this, 'shortcode_cpt' ]);
		add_filter('manage_short-code_posts_columns', [ $this, 'vs_shortcode_column' ]);
		add_action( 'manage_short-code_posts_custom_column', [ $this, 'vs_shortcode_custom_column'], 10, 2 );
		// Meta Box Action
		add_action( 'add_meta_boxes', [ $this, 'social_link_meta_box' ]);
		add_action( 'save_post', [ $this, 'vs_shortcode_save_options_data' ]);
		add_action( 'save_post', [ $this, 'vs_get_shortcode_save_data' ]);
	}

	public function shortcode_cpt() {
		$args = [
			'label'               => __( 'ShortCode', 'team-vs' ),
			'description'         => __( 'TLP Team ShortCode generator', 'team-vs' ),
			'labels'              => [
				'all_items'          => __( 'ShortCodes', 'team-vs' ),
				'menu_name'          => __( 'ShortCode', 'team-vs' ),
				'singular_name'      => __( 'ShortCode', 'team-vs' ),
				'edit_item'          => __( 'Edit ShortCode', 'team-vs' ),
				'new_item'           => __( 'New ShortCode', 'team-vs' ),
				'view_item'          => __( 'View ShortCode', 'team-vs' ),
				'search_items'       => __( 'ShortCode Locations', 'team-vs' ),
				'not_found'          => __( 'No ShortCode found.', 'team-vs' ),
				'not_found_in_trash' => __( 'No ShortCode found in trash.', 'team-vs' )
			],
				'supports'            => [ 'title' ],
				'public'              => false,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => 'edit.php?post_type=vs-member',
				'show_in_admin_bar'   => true,
				'show_in_nav_menus'   => true,
				'can_export'          => true,
				'has_archive'         => false,
				'exclude_from_search' => false,
				'publicly_queryable'  => false,
				'capability_type'     => 'post',
		];

		register_post_type('short-code', $args);
	}

	public function vs_shortcode_column( $columns ){
		$SC_column = array();
		$SC_column['title'] = __('Title', 'team-vs');
		$SC_column['code'] = __('Short Code', 'team-vs');
 		$SC_column['date'] = __('Date', 'team-vs');
		return $SC_column;
	}

	function vs_shortcode_custom_column( $column, $post_id ){
	
		switch( $column ){
			case 'code' :
				//code column
				$code = get_post_meta( $post_id, '_option_shortcode_value_key', true );
				$scode = sprintf('<textarea onfocus="this.select();" class="regular-text" name="option_shortcode_value_key" rows="1" cols="50" readonly>%s</textarea>',$code);
				echo $scode;
				break;
		}
	}
	/* Short Code Generator Meta Box */

	public function social_link_meta_box() {
		add_meta_box( 'get_code', 'Get ShortCode', [ $this->callback, 'vs_get_shortcode_callbacks' ], 'short-code' );
		add_meta_box( 'code_generator', 'Short Code Generator', [ $this->callback, 'vs_shortcode_code_callbacks' ], 'short-code' );
	}

	public function vs_shortcode_save_options_data( $post_id ) {

		if ( ! isset($_POST['vs_shortcode_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['vs_shortcode_meta_box_nonce'], 'vs_shortcode_save_options_data') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;

		foreach ($this->shortcode_value_key() as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	public function vs_get_shortcode_save_data( $post_id ) {

		if ( ! isset($_POST['vs_get_shortcode_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['vs_get_shortcode_meta_box_nonce'], 'vs_get_shortcode_save_data') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;

		foreach ($this->get_shortcode_admin_value_key() as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

}