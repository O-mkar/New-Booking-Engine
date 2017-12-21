<?php

// Image Gallery -------------------------------------------------------------------- >	
function calluna_image_gallery_shortcode($atts, $content = NULL) {

	extract(shortcode_atts(array(
			'images'      => '',
			'link_images' => 'none',
			'uniqid'      => uniqid()
		),
		$atts
	));
	
	wp_enqueue_script('prettyphoto'); // Already registered with Visual Composer
	wp_enqueue_style('prettyphoto'); // Already registered with Visual Composer
	
	?>
	<?php ob_start(); ?>
    <div class="image-gallery">
            <div id="<?php echo esc_attr($uniqid); ?>-carousel" class="carousel slide" data-ride="carousel">
            	<?php
					$args = array(
						'post_type'      => array('attachment'),
						'post_status'    => 'inherit',
						'posts_per_page' => -1,
						'orderby'        => 'post__in',
						'post__in'       => explode(',', $images)
					);
					$custom_loop = new WP_Query($args);
					$number = 0;
				?>
                <?php if ($custom_loop->have_posts()) { ?>
                	<div class="carousel-inner">
							<?php while ($custom_loop->have_posts()) {
								$custom_loop->the_post(); ?>
								<?php $bonk = get_the_ID(); ?>
                                <div class="item <?php echo esc_attr($number) == 0 ? 'active' : ''; ?>">
									<?php if ($link_images == 'none') { ?>
										<!-- Image -->
										<?php echo wp_get_attachment_image(get_the_ID(), 'full'); ?>
									<?php } ?>
									<?php if ($link_images == 'prettyphoto') { ?>
										<!-- Image -->
										<a href="<?php echo esc_url( wp_get_attachment_url(get_the_ID()) ); ?>" class="link_image prettyphoto" rel="prettyPhoto"><?php echo wp_get_attachment_image(get_the_ID(), 'full'); ?></a>
									<?php } ?>
									<?php if ($link_images == 'newtab') { ?>
										<!-- Image -->
										<a href="<?php echo esc_url( wp_get_attachment_url(get_the_ID())); ?>" target="_blank" class="link_image"><?php echo wp_get_attachment_image(get_the_ID(), 'full'); ?></a>
									<?php } ?>
                                </div>
                                
							<?php $number++; } // End while ?>
							<?php wp_reset_query(); ?>
                     </div>
                     <div class="gallery_button_wrapper">
                    <a class="left carousel-control" href="#<?php echo esc_attr($uniqid) ?>-carousel" data-slide="prev">
                    <span class="icon-left"></span>
                </a>
                </div>
                <div class="gallery_button_wrapper">
                    <a class="right carousel-control" href="#<?php echo esc_attr($uniqid) ?>-carousel" data-slide="next">
                    <span class="icon-right"></span>
                </a>
                </div>
					<?php } else { // No posts published
                    		esc_html_e( 'No data to display.', 'calluna-shortcodes' );
						} // End if ?>
                
           </div>
  		  </div>
	
	<?php
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
	?>
<?php
}

add_shortcode('cl_gallery', 'calluna_image_gallery_shortcode');