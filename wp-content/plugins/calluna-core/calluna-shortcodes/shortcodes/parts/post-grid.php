<?php

// Recent Posts -------------------------------------------------------------------------- >
function calluna_posts_grid_shortcode($atts) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'			=> '',
			'post_type'			=> 'post',
			'taxonomy'			=> '',
			'term_slug'			=> '',
			'count'				=> '12',
			'style'				=> 'default', // Maybe add more styles in the future?
			'fade_in'			=> 'false',
			'columns'			=> '3',
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'thumbnail_link'	=> 'post',
			'img_crop'			=> 'true',
			'img_width'			=> '9999',
			'img_height'		=> '9999',
			'title'				=> 'true',
			'meta'				=> 'true',
			'excerpt'			=> 'true',
			'excerpt_length'	=> '15',
			'read_more'			=> 'true',
			'read_more_text'	=> esc_html__( 'read more', 'calluna-shortcodes' ),
			'pagination'		=> 'false',
			'filter_content'	=> 'false',
			'taxonomy'			=> '',
			'terms'				=> '',
		), $atts));
	
	// Post Type doesn't exist, get me out of here!
	if ( ! post_type_exists( $post_type ) ) {
		return esc_html__( 'Sorry the post type you have selected does not exist', 'calluna-shortcodes' );
	}
	
	// FadeIn Class
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'calluna-scroll-fade' );
		$fade_in_class = 'calluna-fadein';
	}
	
	// Start Tax Query
	$tax_query = '';
	if ( $taxonomy !== '' && $term_slug !== '' ) {
		if ( ! taxonomy_exists($taxonomy) ) return esc_html__( 'Your selected taxonomy does not exist', 'calluna-shortcodes' );
		if ( ! term_exists( $term_slug, $taxonomy ) ) return esc_html__( 'Your selected term does not exist', 'calluna-shortcodes' );
		$tax_query = array(
			array(
				'taxonomy'	=> $taxonomy,
				'field'		=> 'slug',
				'terms'		=> $term_slug,
			),
		);
	}
	
	// Pagination var
	if ( $pagination == 'true' ) {
		global $paged;
		$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	} else {
		$paged = null;
	}
	
	// The Query
	$calluna_post_grid_query = new WP_Query(
		array(
			'post_type'			=> $post_type,
			'posts_per_page'	=> $count,
			'order'				=> $order,
			'orderby'			=> $orderby,
			'tax_query'			=> $tax_query,
			'filter_content'	=> $filter_content,
			'paged'				=> $paged
		)
	);

	$output = '';

	//Output posts
	if ( $calluna_post_grid_query->posts ) :
	
		$unique_id = $unique_id ? ' id="'. $unique_id .'"' : null;
	
		// Main wrapper div
		$output .= '<div class="calluna-recent-posts"'. $unique_id .'><div class="calluna-grid calluna-clearfix">';
	
		// Loop through posts
		$count=0;
		foreach ( $calluna_post_grid_query->posts as $post ) :
		$count++;

			// Post VARS
			$post_id          = $post->ID;
			$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
			$featured_img     = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
			$post_date		  = sprintf(wp_kses(__( '<span class="calluna-recent-posts-entry-posted-on">posted on %1$s</span>', 'calluna-shortcodes'), array( 'span' => array( 'class' => array() ) ) ),esc_html( get_the_date('Y/m/d') ) );
			$url              = get_permalink($post_id);
			$post_title       = get_the_title($post_id);
			$post_excerpt     = $post->post_excerpt;
			$custom_excerpt   = wp_trim_words( strip_shortcodes( $post->post_content ), $excerpt_length);
			
			// Load scripts
			if ( $thumbnail_link == 'lightbox' ) {
				wp_enqueue_script( 'magnific-popup' );
				wp_enqueue_script( 'calluna-lightbox' );
			}
			
			// Crop featured images if necessary
			if ( $img_crop == 'true' ) {
				$thumbnail_hard_crop = $img_height == '9999' ? false : true;
				$featured_img = calluna_shortcodes_img_resize( $featured_img_url, $img_width, $img_height, $thumbnail_hard_crop );
			}

			// Recent post article start
			$output .= '<article id="post-'. $post_id .'" class="calluna-recent-posts-entry calluna-col calluna-count-'. $count .' calluna-col-'. $columns .' fitvids '. $fade_in_class .' calluna-grid-'. $post_type .'">';
			
				// Media Wrap
				if ( has_post_thumbnail( $post_id ) ) {
					$output .= '<div class="calluna-recent-posts-entry-media">';
					
						if ( $thumbnail_link == 'none' ) {
							$output .= '<img class="img-responsive" src="'. $featured_img .'" alt="'. $post_title .'" />';
						} elseif ( $thumbnail_link == 'lightbox' ) {
							$output .= '<a href="'. esc_url($featured_img_url) .'" title="'. $post_title .'" class="calluna-recent-posts-entry-img calluna-shortcodes-lightbox">';
								$output .= '<img class="img-responsive" src="'. $featured_img .'" alt="'. $post_title .'" />';
							$output .= '</a><!-- .calluna-recent-posts-entry-img -->';
						} else {
							$output .= '<a href="'. esc_url($url) .'" title="'. $post_title .'" class="calluna-recent-posts-entry-img">';
								$output .= '<img class="img-responsive" src="'. $featured_img .'" alt="'. $post_title .'" />';
							$output .= '</a><!-- .calluna-recent-posts-entry-img -->';
						}
						
					$output .= '</div>';
				}
			
				// Open details div
				if ( $title == 'true' || $excerpt == 'true' ) {

					$output .= '<div class="calluna-recent-posts-entry-details">';
						//Post Date
						$output .='<p>' .  $post_date . '</p>';

						// Title
						if ( $title == 'true' ) {
							$output .= '<header class="calluna-recent-posts-entry-heading entry-header">';
								$output .= '<h3 class="calluna-recent-posts-entry-title"><a href="'. esc_url($url) .'" title="'. $post_title .'">'. $post_title .'</a></h3>';
							$output .= '</header><!-- .calluna-recent-posts-entry-heading -->';
						}
						
						// Excerpt
						if ( $excerpt == 'true' ) {
							$output .= '<div class="calluna-recent-posts-entry-excerpt"><p>';
								if ( $post_excerpt ) {
									$output .= $post_excerpt;
								} else {
									$output .= $custom_excerpt;
								}
							$output .= '</p>';
								if ( $read_more == 'true' && ( $post_excerpt || $custom_excerpt ) ) { 
									$output .= '<span class="calluna-recent-posts-entry-readmore-wrap"><a href="'. esc_url($url) .'" title="'. $post_title .'" class="calluna-recent-posts-entry-readmore calluna-button btn btn-primary small style-1">'. $read_more_text .'</a></span>';
								}
							$output .= ' </div><!-- /calluna-recent-posts-entry-excerpt -->';
						}
				
					// Close details div
					$output .= '</div><!-- .calluna-recent-posts-entry-details -->';
				}
				
			// Close main wrap	
			$output .= '</article>';

			// Reset counter
			if ( $count == $columns ) {
				$count = '0';
			}
		
		// End foreach loop
		endforeach;
		
		// Close main wrap
		$output .= '</div></div><div class="calluna-clear-floats"></div>';
		
		// Paginate Posts
		if ( $pagination == 'true' ) {

			$output .= '<nav class="navigation pagination">';

				$total = $calluna_post_grid_query->max_num_pages;

				$big = 999999999; // need an unlikely integer

				if ( $total > 1 )  {
				    if ( ! $current_page = get_query_var( 'paged' ) )
						 $current_page = 1;
					 if ( get_option( 'permalink_structure' ) ) {
						 $format = 'page/%#%/';
					 } else {
						 $format = '&paged=%#%';
					 }

					 $output .= paginate_links(array(
						'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'	=> $format,
						'current'   => max( 1, $current_page ),
						'total'		=> $total,
						'mid_size'	=> 2,
						'type'		=> 'plain',
						'prev_text' => '<i class="icon-left"></i>',
		                'next_text' => '<i class="icon-right"></i>'
					 ));
				}

			$output .= '</nav>';
		}
	
	endif; // End has posts check
			
	// Set things back to normal
	$calluna_post_grid_query = null;
	wp_reset_postdata();

	// Return output
	return $output; 
	
}
add_shortcode("cl_posts_grid", "calluna_posts_grid_shortcode");