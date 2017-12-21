<?php
/* 
Template Name: Page with Left Sidebar
*/

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php if( get_theme_mod( 'loader', 'no' ) == 'yes' ) { ?>
    <div id="loader" class="loader-style">
        <div class="loader-container">
            <div class="spinner">
                <div class="spinner-container"></div>
            </div>
        </div>
    </div>
<?php } ?>
<div id="page" class="hfeed site">
    <!-- Begin of content -->
    <div id="content" class="site-content">
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

</div>

<!-- Go Top Links -->
<a href="#" id="go-top"><i class="fa fa-angle-up"></i></a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
