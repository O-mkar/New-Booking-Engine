<?php
/**
 * @package calluna
 */

$related_offers_title = get_theme_mod('related_offers_title', 'More Offers Title');
// WPML translations
$related_offers_title = calluna_translate_theme_mod( 'related_offers_title', $related_offers_title );

$related_offers_text = get_theme_mod('related_offers_text', 'More Offers Text');
// WPML translations
$related_offers_text = calluna_translate_theme_mod( 'related_offers_text', $related_offers_text );

$price_text = get_theme_mod( 'offer_price_text', 'Price per person');
// WPML translations
$price_text = calluna_translate_theme_mod( 'offer_price_text', $price_text );

$button_text = get_theme_mod( 'offer_button_text', 'Offer reservation' );
// WPML translations
$button_text = calluna_translate_theme_mod( 'offer_button_text', $button_text );

$offer_details_title = get_theme_mod('offer_details_title', 'Details');
// WPML translations
$offer_details_title = calluna_translate_theme_mod( 'offer_details_title', $offer_details_title );

$offer_details_subtitle = get_theme_mod('offer_details_subtitle', 'What\'s included');
// WPML translations
$offer_details_subtitle = calluna_translate_theme_mod( 'offer_details_subtitle', $offer_details_subtitle );

$gallery_title = get_theme_mod( 'offer_gallery_title', 'Gallery');
// WPML translations
$gallery_title = calluna_translate_theme_mod( 'offer_gallery_title', $gallery_title );


?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="offer-content no-padding container-fluid">
    	<!-- Content + booking -->
        	<div class="row row-eq-height">
                <div class="col-sm-12 col-lg-8 col-md-12 col-xs-12">
                    <div class="text-column">
                        	<?php the_content(); ?> 
                    </div>
             	</div>
                <div class="col-sm-12 col-lg-4 col-md-12 col-xs-12 accent-background">
                    <div class="booking-column">
                        <?php $includes = get_post_meta($post->ID,'_calluna_offer_includes',true);?>
               			<?php if (! empty( $includes )) { ?>
                        <div class="includes_items_wrapper">
                            <h2><?php esc_html_e( $offer_details_title ); ?></h2>
                            <label><?php esc_html_e( $offer_details_subtitle ); ?></label>
                                <?php foreach($includes as $item)
                                    { ?>
                                            <p class="item-text">
                                                    <?php echo esc_attr($item['detail']);?>
                                            </p>
                                    <?php }?>
                          </div>
               			<?php }?>
                        <?php 
							$price = get_post_meta($post->ID,'_calluna_offer_price',true);
						?>
                        <?php if (! empty( $price )) { ?>
                            <div class="offer_price">
                                <span><?php echo esc_attr($price_text) ?></span>
							  	<?php 
									$currency_symbol = get_theme_mod( 'currency', '$');
									if (get_theme_mod('currency_pos', 'before') == 'before') {
										echo esc_attr($currency_symbol) . esc_attr($price);	
									}
									else {
										echo esc_attr($price) . esc_attr($currency_symbol);	
									}
								?>
                            </div>
                        <?php }?>
                        <div class="btn-primary-container offer" style="position:relative;">
                            <?php $button_link = get_post_meta( $post->ID, '_calluna_offer_link', true);
                            if($button_link == '') {
                                $button_link = get_permalink(get_theme_mod('offer_button_link'));
                            }
                            ?>
                            <a href="<?php echo esc_url( $button_link ); ?>" class="btn-primary"><?php echo esc_attr($button_text) ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gallery -->
            <?php $gallery_images = get_post_meta( $post->ID, '_calluna_gallery_select', true ); ?>
               <?php if ( ! empty( $gallery_images ) ) { ?>
                <div class="row row-eq-height">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 content_row vertical-align column-style-1" <?php if ( get_theme_mod( 'column_style1_background_img' ) ) { ?>
        	      style="background-image: url(<?php echo esc_url( get_theme_mod( 'column_style1_background_img')); ?>);"
            	<?php } ?>>
                        <div class="desc_wrapper_left">
                            <h2><?php esc_html_e( $gallery_title ); ?></h2>
							  <p class="teaser">
								  <?php echo esc_attr(get_post_meta($post->ID,'_calluna_gallery_description',true) );?>
							  </p>
                        </div>
                    </div>
				  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 content_row">
                       <div id="bootstrap-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php foreach ($gallery_images as $key=>$image) : ?>
                                    <div class="item <?php echo esc_attr($key) == 0 ? 'active' : ''; ?>">
                                        <?php $image_big_src = wp_get_attachment_image_src($image, 'full'); ?>
                                        <a href="<?php echo esc_url( $image_big_src[0] ); ?>" class="link_image lightbox" data-lightbox-gallery="gallery-<?php esc_attr_e($post->ID); ?>"><?php echo wp_get_attachment_image($image, 'large'); ?></a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="gallery_button_wrapper">
                                <a class="left carousel-control" href="#bootstrap-carousel" data-slide="prev">
                                <span class="icon-left"></span>
                            </a>
                            </div>
                            <div class="gallery_button_wrapper">
                                <a class="right carousel-control" href="#bootstrap-carousel" data-slide="next">
                                <span class="icon-right"></span>
                            </a>
                            </div>
                        </div>
                   </div>
                </div>
        	<?php }?>
        	<!-- Related Offers -->
            <?php 
            $post_ID = get_the_ID();
			$custom_loop = new WP_Query(array(
				'post_type'      => 'offer',
				'post__not_in' => array( $post_ID ),
			));
			?>
            <?php if ($custom_loop->have_posts() && get_theme_mod('related_offers', 'yes') == 'yes') { ?>
                <div class="row row-eq-height reorder-xs">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 content_row carousel_column">
                   <?php if (get_theme_mod('related_offers_cat','') != '') {
                       $offer_cat = get_theme_mod('related_offers_cat','');
                       $term = get_term_by('name', $offer_cat, 'category');
                       echo $term->term_id;
                       echo do_shortcode('[cl_offer_carousel items="2" max_items="6" featured_images="yes" parent_cat="'. $term->term_id .'"]');
                   } else {
                    echo do_shortcode('[cl_offer_carousel items="2" max_items="6" featured_images="yes"]'); 
                   }
                    
                   ?>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 vertical-align column-style-2" <?php if ( get_theme_mod( 'column_style2_background_img' ) ) { ?>
        	      style="background-image: url(<?php echo esc_url( get_theme_mod( 'column_style2_background_img')); ?>);"
            	<?php } ?>>
                    <div class="desc_wrapper_right">
                        <h2><?php echo esc_attr($related_offers_title ); ?></h2>
                        <p class="teaser">
                            <?php echo esc_attr($related_offers_text); ?>
                        </p>
                    </div>
                </div>
          </div>
            <?php } ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->