<?php
/**
 * @package team-vs
 */
namespace vcore\base;
use \vcore\base\basecontroller;
use \vcore\api\callbacks\cpteam;

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );
/**
 * Question Custom Post Type Functionality
 */

class Vsteamcpt extends Basecontroller {

	public $cpt_callback;

	public function register() {

		if (!is_admin()) {
			return;
		}

		$this->cpt_callback = new Cpteam();

		add_action( 'init', [ $this, 'members_cpt' ]);
		add_filter('manage_vs-member_posts_columns', [ $this, 'vs_member_column' ]);

		// Meta Box Action
		add_action( 'add_meta_boxes', [ $this, 'social_link_meta_box' ]);
		add_action( 'save_post', [ $this, 'vs_save_options_data' ]);
		add_action( 'save_post', [ $this, 'vs_save_designation_data' ]);
	}

	public function members_cpt() {
		$labels = [
			'name'                  => __('Members', 'team-vs'),
			'singular_name'         => __('Member', 'team-vs'),
			'menu_name'             => __('WP VS Team', 'team-vs'),
			'name_admin_bar'        => __('Member', 'team-vs'),
			'archives'              => __('Member Archives', 'team-vs'),
			'attributes'            => __('Member Attributes', 'team-vs'),
			'parent_item_colon'     => __('Parent Member', 'team-vs'),
			'all_items'             => __('All Members', 'team-vs'),
			'add_new_item'          => __('Add New Member', 'team-vs'),
			'add_new'               => __('Add Member', 'team-vs'),
			'new_item'              => __('New Member', 'team-vs'),
			'edit_item'             => __('Edit Member', 'team-vs'),
			'update_item'           => __('Update Member', 'team-vs'),
			'view_item'             => __('View Member', 'team-vs'),
			'view_items'            => __('View Members', 'team-vs'),
			'search_items'          => __('Search Members', 'team-vs'),
			'not_found'             => __('No Member Found', 'team-vs'),
			'not_found_in_trash'    => __('No Member Found in Trash', 'team-vs'),
			'insert_into_item'      => __('Insert into Member', 'team-vs'),
			'uploaded_to_this_item' => __('Upload to this Member', 'team-vs'),
			'items_list'            => __('Members List', 'team-vs'),
			'items_list_navigation' => __('Members List Navigation', 'team-vs'),
			'filter_items_list'     => __('Filter Members List', 'team-vs')
		];

		$args = [
			'labels'              => $labels,
			'supports'            => [ 'title', 'thumbnail' ],
			'taxonomies'          => [],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 61,
			'menu_icon' 		  => 'dashicons-buddicons-buddypress-logo',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post'
		];

		register_post_type('vs-member', $args);
	}

	public function vs_member_column( $columns ){
		$QB_column = array();
		$QB_column['title'] = __('Members', 'team-vs');
		$QB_column['date'] = __('Date', 'team-vs');
		return $QB_column;
	}

	/* Gnenrate Meta Box */

	public function social_link_meta_box() {
		add_meta_box('member_designation', 'Member Designation', [ $this->cpt_callback, 'vs_designation_callbacks' ], 'vs-member');
		add_meta_box( 'member_link', 'Social Links', [ $this->cpt_callback, 'vs_box_callbacks' ], 'vs-member' );
	}

	public function vs_save_options_data( $post_id ) {

		if ( ! isset($_POST['vs_link_meta_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['vs_link_meta_box_nonce'], 'vs_save_options_data') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;
		if (! isset($_POST['option_fb_value_key']) || ! isset($_POST['option_tw_value_key']) || ! isset($_POST['option_bh_value_key']) || ! isset($_POST['option_in_value_key']) || ! isset($_POST['option_dr_value_key']) ) {
			return;
		}

		foreach ($this->value_key() as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

	public function vs_save_designation_data( $post_id ) {

		if ( ! isset($_POST['vs_designation_box_nonce'])) return;
		if ( ! wp_verify_nonce($_POST['vs_designation_box_nonce'], 'vs_save_designation_data') ) return;
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id )) return;

		if (! isset($_POST['option_designation_value_key']) ) {
			return;
		}

		foreach ($this->desvalue_key() as $key => $value) {
			update_post_meta( $post_id, $key, $value );
		}
	}

}