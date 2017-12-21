<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package calluna
 */
?>
<?php
  $args= array(
  	    'posts_per_page' => 1,
	  	  'post_type' => 'room',
		    'order'		 => 'ASC',
		    'orderby' => 'menu_order',
        'suppress_filters' => false
	);
	$wp2_query = new WP_Query($args);
	
	global $post;
	
	$currency = get_theme_mod( 'currency', '$' );
	$currency_pos = get_theme_mod( 'currency_pos', 'before' ); 
    $prefix_price = get_theme_mod('room_price_text', 'starting at');
    $reservation_header = get_theme_mod( 'reservation_header', '' );
	$reservation_text = get_theme_mod( 'reservation_text', '' );
	$reservation_hint = get_theme_mod( 'reservation_hint', '' );
    // WPML translations
    $prefix_price = calluna_translate_theme_mod( 'room_price_text', $prefix_price );
    $reservation_header = calluna_translate_theme_mod( 'reservation_header', $reservation_header );
    $reservation_text = calluna_translate_theme_mod( 'reservation_text', $reservation_text );
    $reservation_hint = calluna_translate_theme_mod( 'reservation_hint', $reservation_hint );
?>
<aside id="widget-area" class="widget-area selected-room">
  <div id="room_params">
    
    
    <?php if( $wp2_query->have_posts() ) :
        
        while ( $wp2_query->have_posts() ) : $wp2_query->the_post();
        
        global $room;
        
        if ( has_excerpt( $post->ID ) ) {
            $custom_excerpt = $post->post_excerpt;
        }else {
            $custom_excerpt = wp_trim_words( strip_shortcodes( $post->post_content ), 30);
        }
        ?>
    	<?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'img-responsive' ) ); ?>
    	<h3 class="title"><?php echo esc_attr($post->post_title) ?></h3>
        <div class="excerpt"><p><?php echo wp_kses_data($custom_excerpt) ?></p></div>
        <div class="offer_price">
           <?php $pre_price_text = get_theme_mod('room_button_text', 'starting at');
                // WPML translations
								$pre_price_text = calluna_translate_theme_mod( 'room_button_text', $pre_price_text ); ?>
          <span><?php echo esc_attr($pre_price_text) ?></span>
        	<?php echo $room->calluna_get_min_price_html(); ?>
        </div>
        
        
        <?php endwhile;
        
        endif; 
        
        wp_reset_query();
        ?>
  </div>
  <div class="reservation_header">
  	<?php if ($reservation_header) { ?><?php echo esc_attr($reservation_header) ?><?php } ?>
  </div>
  <div class="reservation_text">
  	<?php if ($reservation_text) { ?><?php echo esc_attr($reservation_text) ?><?php } ?>
  </div>
  <div class="reservation_hint">
  	<?php if ($reservation_hint) { ?><?php echo esc_attr($reservation_hint) ?><?php } ?>
  </div>
  
</aside><!-- .widget-area -->