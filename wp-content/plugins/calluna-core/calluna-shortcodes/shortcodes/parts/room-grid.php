<?php

// Room Carousel -------------------------------------------------------------------- >
function calluna_room_grid_shortcode($atts, $content = NULL) {

		extract(shortcode_atts(array(
            'items'			    => '4',
            'style'             => 'overlay',
            'columns'			=> '4',
            'order'			    => 'ASC',
            'orderby'		    => 'menu_order',
            'max_items'         => '8',
            'button_text'       => '',    
            'button_style'	    => 'style-1',
			'categories' 	    => 'all',
			'img_crop'		    => 'true',
			'img_width'		    => '9999',
			'img_height'	    => '9999',
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
        /*if($orderby == 'price') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = 'base_price';
        }*/
		if($categories != 'all'){
			$str = $categories;
			$arr = explode(',', $str); // string to array

			$args['tax_query'][] = array(
				'taxonomy'  => 'room_cat',
				'field'   => 'slug',
				'terms'   => $arr
			);
		}

        ob_start();

		$wp_query = new WP_Query($args);
		if( $wp_query->have_posts() ) : ?>
			<div class="calluna-room-grid calluna-grid calluna-clearfix">

            <?php
            $count=0;
            
			while ( $wp_query->have_posts() ) : $wp_query->the_post();
			    $count++;
			    global $room;

		  		$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				$featured_img     = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

	  			if ( has_excerpt( $post->ID ) ) {
                    $custom_excerpt = $post->post_excerpt;
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
                <?php
                    
                if( 'overlay' == $style ) : ?>
				<div class="calluna-col calluna-count-<?php echo $count ?> calluna-col-<?php echo $columns ?> fitvids no-padding">
                    
                    
                    <div class="room-item">    
                    <?php if ( has_post_thumbnail( $post->ID ) ) { ?>

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
                                    <?php $button_text = get_theme_mod('room_button_text', 'starting at');
                                    // WPML translations
									$button_text = calluna_translate_theme_mod( 'room_button_text', $button_text );
									
                                    ?>
                                    <span><?php echo esc_attr($button_text) ?></span>
                                    <?php
                                        if ($button_price != 'no') { ?>
                                        <span class="inline-price">
                                            <?php echo $room->calluna_get_min_price_html(); ?>
                                        </span>
                                        <?php } ?>

                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <?php } ?>
                
                <?php else : ?>
                <div class="calluna-col calluna-count-<?php echo $count ?> calluna-col-<?php echo $columns ?> fitvids">
                    <div class="room-image-wrapper">
                        <img src="<?php echo esc_url($featured_img)?>" alt="room-image" />
                        <?php
                        if ($button_price != 'no') { ?>
                         <div class="classic secondary">
                             <div class="room_grid_price">
                                <?php $button_price_text = get_theme_mod('room_button_text', 'starting at');
                                // WPML translations
								$button_price_text = calluna_translate_theme_mod( 'room_button_text', $button_price_text );
								
                                ?>
                                <span><?php echo esc_attr($button_price_text) ?></span>
                                    <span class="inline-price">
                                        <?php echo $room->calluna_get_min_price_html(); ?>
                                        <?php //echo esc_attr($price); ?>
                                    </span>
                            </div>     
                         </div>
                         <?php } ?>
                    </div>
                    <div class="title">
                        <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>"><h3><?php echo get_the_title() ?></h3></a>
                    </div>
                    <div class="excerpt">
                        <p><?php echo esc_attr($custom_excerpt) ?></p>
                    </div>
                    <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="calluna-button btn btn-primary mt35 <?php echo esc_attr($button_style)?>">
                        <?php echo esc_attr($button_text) ?>
                    </a>
                </div>    
            <?php endif; ?>    
				
            
			<?php endwhile; ?>

			</div>

			</div><div class="clearfix"></div>

		    <?php
		    wp_reset_postdata();

		endif;

        $calluna_room_grid_output = ob_get_contents();
		ob_end_clean();
		return $calluna_room_grid_output;

	}

add_shortcode('cl_room_grid', 'calluna_room_grid_shortcode');