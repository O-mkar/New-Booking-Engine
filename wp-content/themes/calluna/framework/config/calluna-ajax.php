<?php
//Add ajax callback to show the selected room on pages with the reservation form
function calluna_implement_ajax() {
if(isset($_POST['room_Id']))
            {
             
			$wp_query = new WP_Query( array( 
				'p' => $_POST['room_Id'],
				'post_type' => 'room',
				'order' => 'ASC',
				'orderby' => 'menu_order',
				'posts_per_page' => 1));
             
            global $post;
            
            if( $wp_query->have_posts() ) :
        
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			global $room;
			
			if ( has_excerpt( $post->ID ) ) {
			    $custom_excerpt = $post->post_excerpt;
			}else {
			    $custom_excerpt = wp_trim_words( strip_shortcodes( $post->post_content ), 30);
			}
			
			$output = '<div>';
			$output .= get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'img-responsive' ) );
			$output .= '<h3 class="title">' . apply_filters( 'the_title', $post->post_title ) . '</h3>';
			$output .= '<div class="excerpt"><p>' . apply_filters( 'the_excerpt', $custom_excerpt ) . '</p></div>';
			
			$pre_price_text = get_theme_mod('room_button_text', 'starting at');
			$pre_price_text = calluna_translate_theme_mod( 'room_button_text', $pre_price_text );
			
			$output .= '<div class="offer_price"><span>' . esc_attr($pre_price_text) . '</span>' . $room->calluna_get_min_price_html() . '</div>';
        
			echo $output;
			
			endwhile;
		        
		    endif;
		    
            wp_reset_postdata(); 
            
            die();
            } // end if
}
add_action('wp_ajax_my_special_action', 'calluna_implement_ajax');
add_action('wp_ajax_nopriv_my_special_action', 'calluna_implement_ajax');//for users that are not logged in.

?>