<?php
/**
 * @package team-vs
 */

namespace vcore\api\callbacks;

/**
 * ShortCode Fields Callbacks
 */
class Cpteam {
	
	public function vs_box_callbacks( $post ) {
		wp_nonce_field( 'vs_save_options_data', 'vs_link_meta_box_nonce' );

		$facebook = get_post_meta( $post->ID, '_option_fb_value_key', true );
		$twitter = get_post_meta( $post->ID, '_option_tw_value_key', true );
		$behance = get_post_meta( $post->ID, '_option_bh_value_key', true );
		$linkedin = get_post_meta( $post->ID, '_option_in_value_key', true );
		$dribble = get_post_meta( $post->ID, '_option_dr_value_key', true );
		
		echo '<label for="option_fb_value_key">Facebook : </label>';
		echo '<input type="text" id="option_fb_value_key" name="option_fb_value_key" value="'.esc_attr($facebook).'" size="100%"><br><br> ';

		echo '<label for="option_tw_value_key">Twitter : </label>';
		echo '<input type="text" id="option_tw_value_key" name="option_tw_value_key" value="'.esc_attr($twitter).'" size="100%"><br><br>';

		echo '<label for="option_bh_value_key">Behance : </label>';
		echo '<input type="text" id="option_bh_value_key" name="option_bh_value_key" value="'.esc_attr($behance).'" size="100%"><br><br>';

		echo '<label for="option_in_value_key">Linkedin : </label>';
		echo '<input type="text" id="option_in_value_key" name="option_in_value_key" value="'.esc_attr($linkedin).'" size="100%"><br><br>';

		echo '<label for="option_dr_value_key">Dribbble : </label>';
		echo '<input type="text" id="option_dr_value_key" name="option_dr_value_key" value="'.esc_attr($dribble).'" size="100%"><br><br>';
	}

	public function vs_designation_callbacks( $post ) {
		wp_nonce_field( 'vs_save_designation_data', 'vs_designation_box_nonce' );

		$designation = get_post_meta( $post->ID, '_option_designation_value_key', true );
		
		echo '<textarea id="option_designation_value_key" name="option_designation_value_key" rows="2" cols="100">'.esc_attr($designation).'</textarea>';
	}
}