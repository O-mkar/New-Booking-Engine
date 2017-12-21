<?php get_header();

$booking_teaser_text = get_theme_mod('booking_teaser_text', 'Book your trip!');
// WPML translations
$booking_teaser_text = calluna_translate_theme_mod( 'booking_teaser_text', $booking_teaser_text );

?>

<div style="position:relative">
  <?php get_template_part( 'inc/pagetitle/pagetitle' ); ?>
  
  <?php if ( get_theme_mod('booking_teaser_show', 'yes') == 'yes' && 'page' == get_option( 'show_on_front')) { ?>
	   <div class="container-fluid" style="position:absolute; width:100%; bottom:0;">
  	<div class="row">
      <div class="hidden-xs col-sm-12 pull-right booking">
        <a href="#" id="booking-teaser">
            <span><?php echo esc_attr($booking_teaser_text); ?></span>
        </a>
      </div>        
    </div>
  </div>
  <?php } ?>
</div>
<?php if('posts' == get_option( 'show_on_front' )) : ?>
	<div class="no-padding container-fluid">
    <div class="row row-eq-height">
    	<?php $sidebar_pos = get_theme_mod( 'position_sidebar', 'right' );
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
					
		<?php }
		else 
		{ ?>
		<div class="sidebar-left_wrapper">
		<div class="col-xs-12 col-md-4 sidebar_wrapper">
        	<aside class="sidebar">
            	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
					<?php dynamic_sidebar( 'blog' ); ?>
                <?php } ?>  
            </aside>
        </div>
        <div class="col-xs-12 col-md-8 content_row">
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
		<?php } ?>
		
    	
    </div>
	</div>
<?php else : ?>
<div id="primary" class="content-area container-fluid">
    <main class="main-content content-width">
    	<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'front-page' ); ?>
        <?php endwhile; // end of the loop. ?>
    </main>
</div>
<?php endif; ?>

<?php get_footer(); ?>