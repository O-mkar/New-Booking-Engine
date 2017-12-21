<?php

// Room Carousel -------------------------------------------------------------------- >
function calluna_room_carousel_shortcode($atts, $content = NULL) {

		extract(shortcode_atts(array(
            'items'			    => '3',
            'order'			    => 'ASC',
            'orderby'		    => 'menu_order',
            'categories'        => 'all',
            'max_items'         => '8',
            'button_text'       => esc_html__( 'starting at', 'calluna-shortcodes' ),    
            'button_style'	    => 'style-1',
			'categories' 	    => 'all',
			'img_crop'		    => 'true',
			'img_width'		    => '420',
			'img_height'	    => '510',
			'excerpt_length'    => '30',
			'button_price'      => 'yes'
		), $atts));

		global $post;
		
        $post_ID = get_the_ID();
		
		$args = array(
			'post_type' => 'room',
			'posts_per_page' => $max_items,
			'post__not_in' => array( $post_ID ),
			'post_status'    => 'publish',

		);
		
		switch ( $orderby ) {

			case 'ids' :
				$ids = explode( ',', $ids );
				$args[ 'post__in' ] = $ids;
				$args[ 'orderby' ]  = 'post__in';
				break;

			default :
				$args[ 'order' ] = $order;
				$args[ 'orderby' ]  = $orderby;
				break;
		}
        
        
		if($categories != 'all'){
			$str = $categories;
			$arr = explode(',', $str); // string to array

			$args['tax_query'][] = array(
				'taxonomy'  => 'room_cat',
				'field'   => 'slug',
				'terms'   => $arr
			);
		}

        wp_enqueue_style('calluna-carousel-style');
		wp_enqueue_script('calluna-carousel');

        ob_start();

		$wp_query = new WP_Query($args);
		if( $wp_query->have_posts() ) : ?>
			<div class="calluna-room-carousel">
			<div class="room2-carousel owl-carousel owl-theme" data-items="<?php echo esc_attr( $items ); ?>">

            <?php
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			
			    global $room;

		  		$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				$featured_img     = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

                //$price = AWE_function::apb_price(get_post_meta($post->ID,"base_price",true));
	  			if ( has_excerpt( $post->ID ) ) {
                    $custom_excerpt = $post->post_excerpt;
                } elseif(get_post_meta( $post->ID, 'room_desc', true ) != '') {
                    $custom_excerpt = get_post_meta( $post->ID, 'room_desc', true );

                }
                else {
                    $custom_excerpt = $post->post_content;
                }
                $custom_excerpt = wp_trim_words( strip_shortcodes( $custom_excerpt ), $excerpt_length);

				// Crop featured images if necessary
				if ( $img_crop != 'false' ) {
					$thumbnail_hard_crop = $img_height == '9999' ? false : true;
					$featured_img = calluna_shortcodes_img_resize( $featured_img_url, $img_width, $img_height, $thumbnail_hard_crop );
				}
                ?>
				<div class="room-item">
                    <?php
                    if ( has_post_thumbnail( $post->ID ) ) { ?>

                    <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="room-pic">
                        <img src="<?php echo esc_url($featured_img)?>" alt="room-image" />
                        <div class="room-content-wrapper">
                            <span class="overlay"></span>
                            <div class="room-title">
                                <h3><?php echo get_the_title() ?></h3>
                            </div>
                            <div class="room-excerpt">
                                <p><?php echo esc_attr($custom_excerpt) ?></p>
                            </div>
                            <div class="room-price-wrapper">
                                <div class="room-price <?php echo esc_attr($button_style)?>">
                                    <?php 
                                    if (is_single()) {
                                    	$room_button_text = get_theme_mod('room_button_text', 'starting at');
                                    	// WPML translations
										$room_button_text = calluna_translate_theme_mod( 'room_button_text', $room_button_text ); ?>
                                    
                                    	<span><?php echo esc_attr($room_button_text) ?></span>
                                    <?php }else{ ?>
                                    	<span><?php echo esc_attr($button_text) ?></span>
                                    <?php }?>
                                    
                                    <?php
                                        if ($button_price != 'no') { ?>
                                        <span class="inline-price">
                                            <?php echo $room->calluna_get_min_price_html(); ?>
                                            <?php //echo esc_attr($price); ?>
                                        </span>
                                        <?php } ?>

                                </div>
                            </div>
                        </div>
                    </a>

                    <?php } ?>

				</div>

			<?php endwhile; ?>

			</div>

			</div><div class="clearfix"></div>

		    <?php
		    wp_reset_postdata();

		endif;

        $calluna_room_carousel_output = ob_get_contents();
		ob_end_clean();
		return $calluna_room_carousel_output;

	}

add_shortcode('cl_room_carousel', 'calluna_room_carousel_shortcode');