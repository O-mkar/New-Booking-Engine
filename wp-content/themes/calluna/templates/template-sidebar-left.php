<?php
/* 
Template Name: Page with Left Sidebar
*/


get_header(); 
get_template_part( 'inc/pagetitle/pagetitle' ); ?>

		<div class="sidebar-left_wrapper">
            <div class="no-padding container-fluid">
            	<div class="row-eq-height row">
                	<div class="col-sm-12 col-md-4 col-lg-4 sidebar_wrapper">
                        <aside class="sidebar">
                        	<?php if ( is_active_sidebar( 'page-sidebar' ) ) { ?>
								<?php dynamic_sidebar( 'page-sidebar' ); ?>
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
<?php get_footer(); ?>