<?php
/**
 * @package team-vs
 */
namespace vcore\pages;
use \vcore\base\basecontroller;

defined( 'ABSPATH' ) or die( 'Write Some to Show!' );
/**
 * Short-Code Query Functionality
 */
class Vshortcodequery extends Basecontroller {

	public function register(){
		add_shortcode('vsteam', [ $this, 'shortcode_Query' ]);
	}
	// [team id="" title=""]
	function shortcode_Query( $attr ) {
		$id = '421';
		$title = 'sagor sss';
		shortcode_atts(
			 [
			    'id' => $id,
			    'title' => $title
			 ], $attr 
		);

		$getid = $attr['id'];
		$getitle = $attr['title'];
		
		if (!empty($getid)) {
			ob_start();
				return $this->Get_Shortcode($getid, $getitle);
			return ob_get_clean();
		}
		
		
	}

	function Get_Shortcode( $id, $title ){
		//echo $title.' your Id '.$id.'<br>';
		$args = array(
		    'post_type' => 'short-code',
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'name' => $title,
		);

		$query = new \WP_Query( $args );

		if ($query->have_posts()) :
			while ($query->have_posts()) : $query->the_post();
				global $post;
				$layouts = get_post_meta( $post->ID, '_option_layouts_value_key', true );
				$slugs = get_post_meta( $post->ID, '_option_slugs_value_key', true );
				$limit = get_post_meta( $post->ID, '_option_limit_value_key', true );
				$desktop = get_post_meta( $post->ID, '_option_desktop_value_key', true );
				$tab = get_post_meta( $post->ID, '_option_tab_value_key', true );
				$mobile = get_post_meta( $post->ID, '_option_mobile_value_key', true );
				$orderby = get_post_meta( $post->ID, '_option_orderby_value_key', true );
				$order = get_post_meta( $post->ID, '_option_order_value_key', true );
				
				return $this->Get_Shortcode_Design($layouts, $slugs, $limit, $desktop, $tab, $mobile, $orderby, $order);
				
			endwhile;
			wp_reset_query();
		endif;
		
	}

	function Get_Shortcode_Design($layout, $slug, $limit, $desktop, $tab, $mobile, $orderby, $order){
		// Section and Container Area start
		if (!empty($layout)) { 
			$vslayout = sprintf('<section class="%s %s  pt-130 pb-100"  id="%s"><div class="%s">', 'team-vs-showcase', $layout, 'showcase5', 'container');
			echo $vslayout;
		}
			// Row Area Start
			if ($layout == 'layout9') { 
				_e('<div class="row">'); 
			}else { 
				_e('<div class="row text-center gutters-10 justify-content-center">'); 
			}

			// WP Query Start
			$vsmember = [
				'post_type' 	 => 'vs-member',
				'memberslug' 	 => $slug,
				'posts_per_page' => $limit,
				'orderby'   	 => $orderby,
				'order'   		 => $order
			];
			$members = new \WP_Query($vsmember);
			// WP Query End
			// Get all Members
			if ($members->have_posts()) :
				while ($members->have_posts()) : $members->the_post();
					// Columns Area Star
					if (!empty($desktop)) { 
						$vsdesktop = sprintf('<div class="%s %s %s">', $mobile, $tab, $desktop);
						echo $vsdesktop;
					}

					_e('<div class="team-vs-member">');
						if (has_post_thumbnail()) {
							$featured_img = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()), 'thumbnail');
						}
						
						if (!empty($featured_img)) {
							$vsimg = sprintf('<div class="%s"><img src="%s" alt="%s"></div>', 'member-img', $featured_img, 'Agent Image');
							echo $vsimg;
						}

						global $post;
						$designation = get_post_meta( $post->ID, '_option_designation_value_key', true );
						$facebook = get_post_meta( $post->ID, '_option_fb_value_key', true );
						$twitter = get_post_meta( $post->ID, '_option_tw_value_key', true );
						$behance = get_post_meta( $post->ID, '_option_bh_value_key', true );
						$linkedin = get_post_meta( $post->ID, '_option_in_value_key', true );
						$dribble = get_post_meta( $post->ID, '_option_dr_value_key', true );

						_e('<div class="member-content">');
							// If select Layout 9
							if ($layout == 'layout9') {
								if (!empty(get_the_title())) {
									echo '<h5 class="name"><a href="#">'.the_title().'</a></h5>';
								}
								if (!empty($designation)) {
									echo '<span>'.$designation.'</span>';
								}
								echo '<ul class="social-links">';
								if (!empty($facebook)) {
									echo '<li><a href="'.$facebook.'"><i class="fab fa-facebook-f"></i></a></li>';
								}
								if (!empty($twitter)) {
									echo '<li><a href="'.$twitter.'"><i class="fab fa-twitter"></i></a></li>';
								}
								if (!empty($linkedin)) {
									echo '<li><a href="'.$linkedin.'"><i class="fab fa-linkedin-in"></i></a></li>';
								}
					            if (!empty($dribble)) {
					            	echo '<li><a href="'.$dribble.'"><i class="fab fa-dribbble"></i></a></li>';
					            }
					            echo '</ul>';
							}

							// If Select Layout 6 And Layout 5
							if ($layout == 'layout6' || $layout == 'layout5') {
								if ($layout === 'layout6') {
									_e('<a href="single-team.html" class="plus-icon"><i class="far fa-plus"></i></a>');
								}
								_e('<ul class="social-links">');
								if (!empty($facebook)) {
									$VSFB = sprintf('<li><a href="%s"><i class="%s"></i></a></li>', $facebook, 'fab fa-facebook-f');
									echo $VSFB;
								}
								if (!empty($twitter)) {
									echo '<li><a href="'.$twitter.'"><i class="fab fa-twitter"></i></a></li>';
								}
								if (!empty($behance)) {
									echo '<li><a href="'.$behance.'"><i class="fab fa-behance"></i></a></li>';
								}
								if (!empty($linkedin)) {
									echo '<li><a href="'.$linkedin.'"><i class="fab fa-linkedin-in"></i></a></li>';
								}
					            if (!empty($dribble)) {
					            	echo '<li><a href="'.$dribble.'"><i class="fab fa-dribbble"></i></a></li>';
					            }
					            _e('</ul>');
					            if (!empty($designation)) {
					            	$vsdesignation = sprintf('<span>%s</span>', $designation);
									echo $vsdesignation;
								}
								if (!empty(get_the_title())) {
									echo '<h3 class="name"><a href="#">'.the_title().'</a></h3>';
								}
							}
						_e('</div>');
					_e('</div>');
					// Columns Area End
					if (!empty($desktop)){
					 	_e('</div>'); 
					}

				endwhile;
				wp_reset_query();
			endif;

			// Row Area End
			if ($layout == 'layout9') { 
				_e('</div>');
			}else { 
				_e('</div>'); 
			}
				

		// Section and Container Area End
		if (!empty($layout)) { 
			_e('</div></section>');
		}
	}

}