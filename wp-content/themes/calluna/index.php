<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package calluna
 */

get_header(); ?>

<?php get_template_part( 'inc/pagetitle/pagetitle-blog' ); ?>

<div class="no-padding container-fluid">
<div class="row row-eq-height">
	<?php $sidebar_pos = get_theme_mod( 'blog_position_sidebar', 'right' );
    if($sidebar_pos == 'right')
	{ ?>
	<div class="col-xs-12 col-md-8">
    	<div id="primary" class="content-area">
            <main id="main" class="site-main main-content">
               <?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
        
                        <?php get_template_part( 'content', get_post_format() ); ?>
        
                    <?php endwhile; // end of the loop. ?>
                  
                  	<?php calluna_paging_nav();
				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );
				endif;
				?>
    
            </main><!-- #main -->
		</div><!-- #primary -->
    </div>
    <div class="col-xs-12 col-md-4 sidebar_wrapper">
    	<aside class="sidebar">
        	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
				<?php dynamic_sidebar( 'blog' ); ?>
            <?php } ?>   
        </aside>
    </div>	
				
	<?php }elseif ($sidebar_pos == 'left') { ?>
		<div class="sidebar-left_wrapper">
	<div class="col-xs-12 col-md-4 sidebar_wrapper">
    	<aside class="sidebar">
        	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
				<?php dynamic_sidebar( 'blog' ); ?>
            <?php } ?>  
        </aside>
    </div>
    <div class="col-xs-12 col-md-8">
    	<div id="primary" class="content-area">
            <main id="main" class="site-main main-content">
                <?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
        
                        <?php get_template_part( 'content', get_post_format() ); ?>
        
                    <?php endwhile; // end of the loop. ?>
                  
                    <?php calluna_paging_nav();
				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );
				endif;
				?>
            </main><!-- #main -->
		</div><!-- #primary -->
    </div>
    </div>
	<?php }
	else
	{ ?>
	<div class="col-xs-12 col-md-12">
    	<div id="primary" class="content-area">
            <main id="main" class="site-main main-content">
                <?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
        
                        <?php get_template_part( 'content', get_post_format() ); ?>
        
                    <?php endwhile; // end of the loop. ?>
                  
                    <?php calluna_paging_nav();
				// If no content, include the "No posts found" template.
				else :
					get_template_part( 'content', 'none' );
				endif;
				?>
            </main><!-- #main -->
		</div><!-- #primary -->
    </div>
	<?php } ?>
	
	
</div>
</div>
<?php get_footer(); ?>
