<?php
/**
 * @package calluna
 */

$related_events_title = get_theme_mod('related_events_title', 'More Events Title');
// WPML translations
$related_events_title = calluna_translate_theme_mod( 'related_events_title', $related_events_title );

$related_events_text = get_theme_mod('related_events_text', 'More Events Text');
// WPML translations
$related_events_text = calluna_translate_theme_mod( 'related_events_text', $related_events_text );

$event_details_title = get_theme_mod('event_details_title', 'Details');
// WPML translations
$event_details_title = calluna_translate_theme_mod( 'event_details_title', $event_details_title );

$event_details_subtitle = get_theme_mod('event_details_subtitle', 'What\'s included');
// WPML translations
$event_details_subtitle = calluna_translate_theme_mod( 'event_details_subtitle', $event_details_subtitle );

$gallery_title = get_theme_mod( 'event_gallery_title', 'Gallery');
// WPML translations
$gallery_title = calluna_translate_theme_mod( 'event_gallery_title', $gallery_title );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $event_month = date_i18n('F', strtotime(get_post_meta($post->ID, "_calluna_event_date", true)));
		  $event_day = date('d', strtotime(get_post_meta($post->ID, "_calluna_event_date", true)));
	?>
	<div class="event-content no-padding container-fluid">
    	<!-- Content + booking -->
        	<div class="row row-eq-height">
                <div class="col-sm-12 col-lg-8 col-md-12 col-xs-12">
                    <div class="text-column row">
                    	<div class="col-xs-3 col-sm-2">
                        	<div class="event_date_wrapper">
                                <div class="event_grid_month">
                                    <?php echo esc_attr($event_month) ?>
                                </div>
                                <div class="event_grid_day">
                                    <?php echo esc_attr($event_day) ?>
                                </div>
                            </div>
                        </div>
                    	<div class="col-sm-10">
                        	<?php the_content(); ?> 
                        </div>
                        
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4 col-md-12 col-xs-12 accent-background">
                    <div class="booking-column">
                        <?php $includes = get_post_meta($post->ID,'_calluna_event_includes',true);?>
               			<?php if (! empty( $includes )) { ?>
                        <div class="includes_items_wrapper">
                            <h2><?php esc_html_e( $event_details_title ); ?></h2>
                            <label><?php esc_html_e( $event_details_subtitle ); ?></label>
                                <?php foreach($includes as $item)
                                    { ?>
                                            <p class="item-text">
                                                    <?php echo esc_attr($item['detail']);?>
                                            </p>
                                    <?php }?>
                          </div>
               			<?php }?>
                    </div>
                </div>
            </div>
            <!-- Gallery -->
            <?php $gallery_images = get_post_meta( $post->ID, '_calluna_gallery_select', true ); ?>
            <?php if ( ! empty( $gallery_images ) ) { ?>
        	<div class="row row-eq-height">
			  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 content_row vertical-align column-style-1" <?php if ( get_theme_mod( 'column_style1_background_img' ) ) { ?>
        	      style="background-image: url(<?php echo esc_url( get_theme_mod( 'column_style1_background_img')); ?>);"
            	<?php } ?> >
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
            <?php 
            $post_ID = get_the_ID();
			$custom_loop = new WP_Query(array(
				'post_type'      => 'event',
				'post__not_in' => array( $post_ID ),
			));
			?>
            
            <!-- Related Events -->
            <?php if ($custom_loop->have_posts() && get_theme_mod('related_events', 'yes') == 'yes') { ?>
                <div class="row row-eq-height reorder-xs">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 content_row carousel_column">
                   <?php echo do_shortcode('[cl_event_carousel items="2" max_items="6" featured_images="no"]'); ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4 vertical-align column-style-2" <?php if ( get_theme_mod( 'column_style2_background_img' ) ) { ?>
        	      style="background-image: url(<?php echo esc_url( get_theme_mod( 'column_style2_background_img')); ?>);"
            	<?php } ?>>
                    
                    <div class="desc_wrapper_right">
                        <h2><?php echo esc_attr($related_events_title); ?></h2>
                        <p class="teaser">
                            <?php echo esc_attr($related_events_text); ?>
                        </p>
                    </div>
                </div>
            </div>
        	<?php } ?>
            
	</div><!-- .entry-content -->

</article><!-- #post-## -->
