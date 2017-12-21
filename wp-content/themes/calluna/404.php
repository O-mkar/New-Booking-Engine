<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package calluna
 */

get_header(); ?>

<?php
	$header_title_pos = get_theme_mod('header_title_pos', 'text-left');
	$color = get_theme_mod('header_bg_color', '#0C2149');
					$headerColorText = esc_html__( 'Page not found (404)', 'calluna-td' );
                  $shortcodeColor = '<div class="color-background" style="background-color:';
				  	$shortcodeColor .= $color;
					$shortcodeColor.= ';">';
					$shortcodeColor .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '"><span>' . esc_attr($headerColorText) . '</span><span class="separator"></span></h1>';
					$shortcodeColor .= '</div>';
				  	echo do_shortcode($shortcodeColor); 
				?>
	<div id="primary" class="content-area container-fluid">
		<main id="main" class="site-main">
            	<section class="error-404 not-found">
                	<div class="row">
                    	<div class="col-sm-12">
                    		<?php 
								$url = get_site_url();
								$find_h = '#^http(s)?://#';
								$find_w = '/^www\./';
								$replace = '';
								$output = preg_replace( $find_h, $replace, $url );
								$output = preg_replace( $find_w, $replace, $output ); 
							?>
                			<h2 class="title"><?php echo esc_html__('Search ','calluna-td') . $output; ?></h2>
                    	</div>
                        <div class="col-sm-6">
                        	<?php get_search_form(); ?>
                        </div>
                        
                    </div>
                </section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>