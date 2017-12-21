<?php
/**
 * Template for displaying single offer posts.
 */

get_header(); ?>
<?php get_template_part( 'inc/pagetitle/pagetitle-single' ); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main content content-width offer">
    
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'single-offer' ); ?>

	<?php endwhile; // end of the loop. ?>

	</main><!-- #main -->
</div><!-- #primary -->
    

<?php get_footer(); ?>