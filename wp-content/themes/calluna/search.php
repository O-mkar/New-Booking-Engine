<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package calluna
 */

get_header(); ?>

<?php
	$header_title_pos = get_theme_mod('header_title_pos', 'text-left');
	$color = get_theme_mod('header_bg_color', '#0C2149');
					$headerColorText = get_search_query();
					if ($headerColorText == ''){
						$headerColorText = esc_html__( 'Search', 'calluna-td' );
					}
                  $shortcodeColor = '<div class="color-background" style="background-color:';
				  	$shortcodeColor .= $color;
					$shortcodeColor.= ';">';
					$shortcodeColor .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '"><span>' . esc_attr($headerColorText) . '</span><span class="separator"></span></h1>';
					$shortcodeColor .= '</div>';
				  	echo do_shortcode($shortcodeColor); 
				?>
    <div class="no-padding container-fluid">
    	<div class="row row-eq-height">
    	<?php $sidebar_pos = get_theme_mod( 'blog_position_sidebar', 'right' );
        if($sidebar_pos == 'right')
		{ ?>
		<div class="col-sm-12 col-md-8 col-lg-8 content_row">
        	<div id="primary" class="content-area">
                <main id="main" class="site-main">
				
				<?php if ( have_posts() ) : ?>
        
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
        
                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'content', 'search' );
                        ?>
        
                    <?php endwhile; ?>
        
                    <?php calluna_paging_nav(); ?>
        
                <?php else : ?>
        
                    <?php get_template_part( 'content', 'none' ); ?>
        
                <?php endif; ?>

		</main><!-- #main -->
			</div><!-- #primary -->
        </div>
        <div class="col-sm-12 col-md-4 col-lg-4 sidebar_wrapper">
        	<div class="sidebar">
            	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
					<?php dynamic_sidebar( 'blog' ); ?>
                <?php } ?>   
            </div>
        </div>	
					
		<?php }elseif ($sidebar_pos == 'left') { ?>
		    <div class="col-sm-12 col-md-4 col-lg-4 sidebar_wrapper">
        	<div class="sidebar">
            	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
					<?php dynamic_sidebar( 'blog' ); ?>
                <?php } ?>   
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-8">
        	<div id="primary" class="content-area">
                <main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>
        
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
        
                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'content', 'search' );
                        ?>
        
                    <?php endwhile; ?>
        
                    <?php calluna_paging_nav(); ?>
        
                <?php else : ?>
        
                    <?php get_template_part( 'content', 'none' ); ?>
        
                <?php endif; ?>

		</main><!-- #main -->
			</div><!-- #primary -->
        </div>
		<?php }
		else 
		{ ?>
		
        <div class="col-sm-12 col-md-12 col-lg-12">
        	<div id="primary" class="content-area">
                <main id="main" class="site-main">

				<?php if ( have_posts() ) : ?>
        
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
        
                        <?php
                            /* Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'content', 'search' );
                        ?>
        
                    <?php endwhile; ?>
        
                    <?php calluna_paging_nav(); ?>
        
                <?php else : ?>
        
                    <?php get_template_part( 'content', 'none' ); ?>
        
                <?php endif; ?>

		        </main><!-- #main -->
			</div><!-- #primary -->
        </div>
		<?php } ?>
    </div>
    </div>
<?php get_footer(); ?>
