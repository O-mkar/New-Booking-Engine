<?php
/**
 * Template for displaying single offer posts.
 */

get_header(); ?>

<div id="primary" class="content-area">
		<main id="main" class="site-main content content-width offer">
        <?php
			/* get revolution slider from shortcode in custom field*/
			$header = get_post_meta($post->ID, '_calluna_header_select', true);
			$header_title_pos = get_theme_mod('header_title_pos', 'text-left');
			if($header == 'slider') {
				$slider = get_post_meta($post->ID, '_calluna_header_slider', true);
				echo do_shortcode($slider); 
			} 
			elseif($header == 'image') {
					$image = get_post_meta($post->ID, '_calluna_header_image', true);
					$image_attributes = wp_get_attachment_image_src( $image, 'full' );
					$headerImageText = get_the_title( $post->ID );
					if ($headerImageText == '')
					{
						$headerImageText = get_the_title();	
					}
					$shortcodeImage = '<div class="image-background" style="background: url(' . $image_attributes[0] . ');">';
				$shortcodeImage .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '">';
				$shortcodeImage .= '<span>' . esc_attr($headerImageText) . '</span><span class="separator"></span></h1></div>';
				echo do_shortcode($shortcodeImage); 
				}
			elseif($header == 'color') {
					$color = get_theme_mod('header_bg_color', '#0C2149');
					$headerColorText = get_the_title( $post->ID );
					if ($headerColorText == '')
					{
						$headerColorText = get_the_title();	
					}
                  $shortcodeColor = '<div class="color-background" style="background-color:';
				  	$shortcodeColor .= $color;
					$shortcodeColor.= ';">';
					$shortcodeColor .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '"><span>' . esc_attr($headerColorText) . '</span><span class="separator"></span></h1>';
					$shortcodeColor .= '</div>';
				  	echo do_shortcode($shortcodeColor); 
				}?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
			<?php get_template_part( 'content', 'single-offer' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
    

<?php get_footer(); ?>