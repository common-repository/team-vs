<?php
/**
 * @package team-vs
 */

namespace vcore\api\callbacks;

/**
 * ShortCode Fields Callbacks
 */
class Cptshortcode {

	public function vs_get_shortcode_callbacks( $post )
	{
		wp_nonce_field( 'vs_get_shortcode_save_data', 'vs_get_shortcode_meta_box_nonce' );
		$code = get_post_meta( $post->ID, '_option_shortcode_value_key', true );
		$title = '';
		if (@get_the_title()) {
			$title = get_the_title();
		}
		$shortcode = '[vsteam id="'.get_the_ID().'" title="'.$title.'"]';
		
		echo '<textarea onfocus="this.select();" class="regular-text" name="option_shortcode_value_key" rows="1" cols="50" readonly>'.$shortcode.'</textarea>';
	}
	
	public function vs_shortcode_code_callbacks( $post ) {
		wp_nonce_field( 'vs_shortcode_save_options_data', 'vs_shortcode_meta_box_nonce' );

		 $layouts = get_post_meta( $post->ID, '_option_layouts_value_key', true );
		 $limit = get_post_meta( $post->ID, '_option_limit_value_key', true );
		 $slugs = get_post_meta( $post->ID, '_option_slugs_value_key', true );
		 $desktop = get_post_meta( $post->ID, '_option_desktop_value_key', true );
		 $tab = get_post_meta( $post->ID, '_option_tab_value_key', true );
		 $mobile = get_post_meta( $post->ID, '_option_mobile_value_key', true );
		 $orderby = get_post_meta( $post->ID, '_option_orderby_value_key', true );
		 $order = get_post_meta( $post->ID, '_option_order_value_key', true );

		_e('<ul class="nav nav-tabs"></ul>');
		_e('<div class="tab-content"><div id="tab-1" class="tab-pane active">');
			_e('<p>Manage Your ShortCode Design.</p>');
			// Layouts Select Fields
			_e('<label for="option_layouts_value_key">Layouts : </label>');
			_e('<select name="option_layouts_value_key" class="regular-text">;
			    <option value="layout9" '.selected( 'layout9', $layouts, false ).'>1st Design</option>
			    <option value="layout5" '.selected( 'layout5', $layouts, false ).'>2nd Design</option>
			    <option value="layout6" '.selected( 'layout6', $layouts, false ).'>3rd Design</option>
			</select><br><br><hr><br>');
			// Slugs Select Fields
			_e('<label for="option_slugs_value_key">Members Slugs : </label>');
				$cat_args = array(
				    'orderby'       => 'term_id', 
				    'order'         => 'ASC',
				    'hide_empty'    => true, 
				);

				$terms = get_terms('memberslug', $cat_args);

			_e('<select name="option_slugs_value_key" class="regular-text">');
			_e('<option selected="selected">Select Your Slug</option>');
				foreach ( $terms as $term ) {
					echo '<option value="'.$term->name.'" '.selected( "$term->name", $slugs, false ).'>'.$term->name.'</option>';
				}
			_e('</select><br><br><hr><br>');
			// Member Limit Select Fields
			_e('<label for="option_limit_value_key">Members Limit : </label>');
			_e('<input type="number" class="regular-text" id="option_limit_value_key" name="option_limit_value_key" value="'.$limit.'" placeholder="Enter Member Number" required><br><br><hr><br>');
			// Column Select Fields
			_e('<label for="option_desktop_value_key">Column : </label>');
			_e('<label for="option_desktop_value_key">Desktop : </label>');
			_e('<select name="option_desktop_value_key" class="regular-text">
				<option selected="col-xl-3" value="col-xl-3">4 Column</option>
			    <option value="col-xl-12" '.selected( 'col-xl-12', $desktop, false ).'>1 Column</option>
			    <option value="col-xl-6" '.selected( 'col-xl-6', $desktop, false ).'>2 Column</option>
			    <option value="col-xl-4" '.selected( 'col-xl-4', $desktop, false ).'>3 Column</option>
			    <option value="col-xl-3" '.selected( 'col-xl-3', $desktop, false ).'>4 Column</option>
			    <option value="col-xl-2" '.selected( 'col-xl-2', $desktop, false ).'>5 Column</option>
			    <option value="col-xl-2" '.selected( 'col-xl-2', $desktop, false ).'>6 Column</option>
			</select>');
			_e('<label for="option_tab_value_key">Tab : </label>');
			_e('<select name="option_tab_value_key" class="regular-text">
				<option selected="col-md-6" value="col-md-6">2 Column</option>
			    <option value="col-md-12" '.selected( 'col-md-12', $tab, false ).'>1 Column</option>
			    <option value="col-md-6" '.selected( 'col-md-6', $tab, false ).'>2 Column</option>
			    <option value="col-md-4" '.selected( 'col-md-4', $tab, false ).'>3 Column</option>
			    <option value="col-md-3" '.selected( 'col-md-3', $tab, false ).'>4 Column</option>
			    <option value="col-md-2" '.selected( 'col-md-2', $tab, false ).'>5 Column</option>
			    <option value="col-md-2" '.selected( 'col-md-2', $tab, false ).'>6 Column</option>
			</select>');
			_e('<label for="option_mobile_value_key">Mobile : </label>');
			_e('<select name="option_mobile_value_key" class="regular-text">
				<option selected="col-sm-6" value="col-sm-6">2 Column</option>
			    <option value="col-sm-12" '.selected( 'col-sm-12', $mobile, false ).'>1 Column</option>
			    <option value="col-sm-6" '.selected( 'col-sm-6', $mobile, false ).'>2 Column</option>
			    <option value="col-sm-4" '.selected( 'col-sm-4', $mobile, false ).'>3 Column</option>
			    <option value="col-sm-3" '.selected( 'col-sm-3', $mobile, false ).'>4 Column</option>
			    <option value="col-sm-2" '.selected( 'col-sm-2', $mobile, false ).'>5 Column</option>
			    <option value="col-sm-2" '.selected( 'col-sm-2', $mobile, false ).'>6 Column</option>
			</select><br><br><hr><br>');
			// Order By Select Fields
			_e('<label for="option_orderby_value_key">Order By : </label>');
			_e('<select name="option_orderby_value_key" class="regular-text">
			    <option value="rand" '.selected( 'rand', $orderby, false ).'>Random</option>
			    <option value="id" '.selected( 'id', $orderby, false ).'>ID</option>
			    <option value="name" '.selected( 'name', $orderby, false ).'>Name</option>
			    <option value="date" '.selected( 'date', $orderby, false ).'>Date</option>
			</select><br><br><hr><br>');
			// Order Select Fields
			_e('<label for="option_order_value_key">Order : </label>');
			_e('<select name="option_order_value_key" class="regular-text">
			    <option value="DESC" '.selected( 'DESC', $order, false ).'>DESC</option>
			    <option value="ASC" '.selected( 'ASC', $order, false ).'>ASC</option>
			</select><br><br>');
		_e('</div></div>');
	}
}