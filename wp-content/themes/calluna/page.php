<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package calluna
 */

get_header();

get_template_part( 'inc/pagetitle/pagetitle' ); ?>
<?php
// Check if Hotelier is active and if the booking and listing page have a sidebar
if ( calluna_is_hotelier_active() && ( is_booking() || is_listing() ) ) { ?>
	
	<div class="sidebar-left_wrapper">
        <div class="no-padding container-fluid">
        	<div class="row-eq-height row">
            	<div class="col-sm-12 col-md-4 col-lg-4 sidebar_wrapper">
                    <aside class="sidebar">
                    	<?php if ( is_active_sidebar( 'calluna-booking-sidebar' ) ) { ?>
							<?php dynamic_sidebar( 'calluna-booking-sidebar' ); ?>
                        <?php } ?>  
                    </aside>
                </div>	
    			<div class="col-sm-12 col-md-8 col-lg-8">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                        <?php while ( have_posts() ) : the_post(); ?>
                          <?php get_template_part( 'content', 'page-sidebar' ); ?>
                        <?php endwhile; // end of the loop. ?>
            
                    	</main><!-- #main -->
                    </div><!-- #primary -->
        		</div>
    		</div>
        </div>
    </div>
	
<?php }else { ?>
	<div id="primary" class="content-area container-fluid">
		<main id="main" class="site-main main-content content-width">
	        <?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'content', 'page' ); ?>
	
			<?php endwhile; // end of the loop. ?>
			
			 <?php calluna_paging_nav(); ?>
			 
			<?php else : ?>
	    
	            <?php get_template_part( 'content', 'none' ); ?>
	    
	            <?php endif; ?>
	
		</main><!-- #main -->
	</div><!-- #primary -->
<?php }

get_footer(); ?>
