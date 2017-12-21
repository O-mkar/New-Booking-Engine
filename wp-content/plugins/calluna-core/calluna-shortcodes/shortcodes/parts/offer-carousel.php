<?php
// Offer Carousel -------------------------------------------------------------------- >
function calluna_offer_carousel_shortcode($atts, $content = NULL) {

		extract(shortcode_atts(array(
            'items'			=> '3',
            'order'			=> 'ASC',
            'orderby'		=> 'price',
            'max_items'       => '8',
			'categories' 	=> 'all',
			'featured_images' => 'yes',
			'img_crop'		=> 'true',
			'img_width'		=> '420',
			'img_height'	=> '171',
			'excerpt_length' => '30'
		), $atts));

		global $post;

        $post_ID = get_the_ID();
		$args = array(
			'post_type' => 'offer',
			'posts_per_page' => $max_items,
			'post__not_in' => array( $post_ID ),
			'order'          => $order,
			'orderby'        => $orderby,
			'post_status'    => 'publish',

		);
        if($orderby == 'price') {
            $args['orderby'] = 'meta_value_num';
            $args['meta_key'] = '_calluna_offer_price';
        }
		if($categories != 'all'){
			$str = $categories;
			$arr = explode(',', $str); // string to array

			$args['tax_query'][] = array(
				'taxonomy'  => 'offer_category',
				'field'   => 'slug',
				'terms'   => $arr
			);
		}

        wp_enqueue_style('calluna-carousel-style');
		wp_enqueue_script('calluna-carousel');

        ob_start();

		$wp_query = new WP_Query($args); ?>
		<?php if( $wp_query->have_posts() ) : ?>
			<div class="calluna-offer2-carousel">
			<div class="offer2-carousel owl-carousel owl-theme" data-items="<?php echo esc_attr( $items ); ?>">

            <?php
			while ( $wp_query->have_posts() ) : $wp_query->the_post();

		  		$featured_img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
				$featured_img     = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );

	  			if ( has_excerpt( $post->ID ) ) {
                    $custom_excerpt = $post->post_excerpt;
                }
                else {
                    $custom_excerpt = wp_trim_words( strip_shortcodes( $post->post_content ), $excerpt_length);
                }

				// Crop featured images if necessary
				if ( $img_crop == 'true' ) {
					$thumbnail_hard_crop = $img_height == '9999' ? false : true;
					$featured_img = calluna_shortcodes_img_resize( $featured_img_url, $img_width, $img_height, $thumbnail_hard_crop );
				}
                ?>
				<div class="event-item">
                    <?php
                    if ( has_post_thumbnail( $post->ID ) && $featured_images != 'no' ) { ?>

                    <div class="event-image-button-wrapper">
                        <a href="<?php echo esc_url(get_permalink()) ?>" title="<?php echo esc_attr(get_the_title()) ?>" class="event-pic">
                            <img src="<?php echo esc_url($featured_img)?>" alt="<?php echo esc_attr(get_the_title()) ?>" />
                        </a>
                    </div>

                    <?php } ?>
                    <div class="event-title-wrapper clearfix">
                        <div class="offer_title">
                            <h3>
                                <a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </div>
                    <div class="event-excerpt">
                        <p><?php echo esc_attr($custom_excerpt) ?></p>
                    </div>
                    <?php // WPML translations
                        $pre_text = get_theme_mod( 'offer_price_text', 'Price per person');
                        $pre_text = calluna_translate_theme_mod( 'offer_price_text', $pre_text );
                    ?>
                    <div class="offer_price"><span><?php echo esc_attr($pre_text); ?></span>
                    <?php
                        $currency_symbol = get_theme_mod( 'currency', '$');
                        $price = get_post_meta( get_the_ID(), '_calluna_offer_price', true );
                        if (get_theme_mod('currency_pos', 'before') == 'before') {
                            echo esc_attr($currency_symbol) . esc_attr($price);
                        }
                        else {
                            echo esc_attr($price) . esc_attr($currency_symbol);
                        }
                    ?>
                    </div>
				</div>

			<?php endwhile; ?>

			</div>

			</div><div class="clearfix"></div>

		    <?php
		    wp_reset_postdata();

		endif;

        $calluna_offer_carousel_output = ob_get_contents();
		ob_end_clean();
		return $calluna_offer_carousel_output;

	}

add_shortcode('cl_offer_carousel', 'calluna_offer_carousel_shortcode');