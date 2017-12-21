<?php
/**
 * The Template for displaying all single posts.
 *
 * @package calluna
 */

get_header(); ?>
<?php get_template_part( 'inc/pagetitle/pagetitle-single' ); ?>

<div class="no-padding container-fluid">
<div class="row-eq-height row">
	<?php $sidebar_pos = get_theme_mod( 'post_position_sidebar', 'right' );
    if($sidebar_pos == 'right')
	{ ?>
	<div class="col-xs-12 col-md-8">
    	<div id="primary" class="content-area">
            <main id="main" class="site-main">
			<?php while ( have_posts() ) : the_post(); ?>
			  <?php if( get_post_format() == 'quote' ) : ?>
			  <?php get_template_part( 'content', 'quote'); ?>
			  <?php elseif( get_post_format() == 'gallery' ) : ?>
			  <?php get_template_part( 'content', 'gallery' ); ?>
              <?php elseif( get_post_format() == 'link' ) : ?>
			  <?php get_template_part( 'content', 'link' ); ?>
              <?php elseif( get_post_format() == 'video' ) : ?>
			  <?php get_template_part( 'content', 'video' ); ?>
			  <?php else : ?>
			  <?php get_template_part( 'content', 'single' ); ?>
			  <?php endif; ?>
            <?php endwhile; // end of the loop. ?>
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
	elseif ($sidebar_pos == 'left') { ?>
		<div class="col-xs-12 col-md-4 sidebar-left_wrapper">
    	<aside class="sidebar">
        	<?php if ( is_active_sidebar( 'blog' ) ) { ?>
				<?php dynamic_sidebar( 'blog' ); ?>
            <?php } ?>   
        </aside>
    </div>
    <div class="col-xs-12 col-md-8">
    	<div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			  <?php if( get_post_format() == 'quote' ) : ?>
			  <?php get_template_part( 'content', 'quote'); ?>
			  <?php elseif( get_post_format() == 'gallery' ) : ?>
			  <?php get_template_part( 'content', 'gallery' ); ?>
              <?php elseif( get_post_format() == 'link' ) : ?>
			  <?php get_template_part( 'content', 'link' ); ?>
              <?php elseif( get_post_format() == 'video' ) : ?>
			  <?php get_template_part( 'content', 'video' ); ?>
			  <?php else : ?>
			  <?php get_template_part( 'content', 'single' ); ?>
			  <?php endif; ?>
            <?php endwhile; // end of the loop. ?>
        </main><!-- #main -->
		</div><!-- #primary -->
    </div>
	<?php }else
	{ ?>
    <div class="col-xs-12 col-md-12">
    	<div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			  <?php if( get_post_format() == 'quote' ) : ?>
			  <?php get_template_part( 'content', 'quote'); ?>
			  <?php elseif( get_post_format() == 'gallery' ) : ?>
			  <?php get_template_part( 'content', 'gallery' ); ?>
              <?php elseif( get_post_format() == 'link' ) : ?>
			  <?php get_template_part( 'content', 'link' ); ?>
              <?php elseif( get_post_format() == 'video' ) : ?>
			  <?php get_template_part( 'content', 'video' ); ?>
			  <?php else : ?>
			  <?php get_template_part( 'content', 'single' ); ?>
			  <?php endif; ?>
            <?php endwhile; // end of the loop. ?>
        </main><!-- #main -->
		</div><!-- #primary -->
    </div>
	<?php } ?>
</div>
</div>
<?php get_footer(); ?>