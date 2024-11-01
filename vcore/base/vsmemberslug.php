<?php
/**
 * @package team-vs
 */
namespace vcore\base;

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );

/**
 * Member Slugs Functionality
 */
class Vsmemberslug {
	
	public function register() {
		add_action( 'init', [ $this, 'member_slug' ]);
	}

	public function member_slug()
	{
		$labels = [
			'name'              => __('Slugs', 'team-vs'),
			'singular_name'     => __('Slug', 'team-vs'),
			'search_items'      => __('Search Slugs', 'team-vs'),
			'all_items'         => __('All Slugs', 'team-vs'),
			'parent_item'       => __('Parent Slug', 'team-vs'),
			'parent_item_colon' => __('Parent Slug:', 'team-vs'),
			'edit_item'         => __('Edit Slug', 'team-vs'),
			'update_item'       => __('Update Slug', 'team-vs'),
			'add_new_item'      => __('Add New Slug', 'team-vs'),
			'new_item_name'     => __('New Slug Name', 'team-vs'),
			'menu_name'         => __('Slugs', 'team-vs'),
		];

		$args = [
			'labels'            => $labels,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'memberslug' ),
		];

		register_taxonomy( 'memberslug', 'vs-member', $args );
	}
}