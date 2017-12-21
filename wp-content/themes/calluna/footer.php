<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package calluna
 */

$copyright = get_theme_mod( 'footer_txt', 'Copyright 2017 by <a href="http://themetwins.com/best-hotel-wordpress-themes/" title="themetwins" target="_blank">themetwins</a>. Calluna Hotel Theme crafted with love.');

// WPML translations
$copyright = calluna_translate_theme_mod( 'footer_txt', $copyright );
?>

	</div>
	    <footer id="colophon" class="site-footer">
    	<div class="footer-image-wrapper" <?php if ( get_theme_mod( 'footer_bg_img' ) ) { ?> style="background: url(<?php echo esc_url( get_theme_mod( 'footer_bg_img')); ?>); background-size:cover;" <?php } ?>>
        	<?php if( get_theme_mod( 'calluna_footer_widgets_show', 'yes' ) == 'yes' && get_post_meta( $id, 'calluna_post_footer_widgets', true ) != 'hide' ) { ?>
        	<div class="top-footer-container">
            	<div class="container-fluid">
                	<div class="row">
                    	<div class="col-xs-12 col-sm-6 col-lg-3">
                        <?php if ( is_active_sidebar( 'footer-logo' ) ) { ?>
    						<?php dynamic_sidebar( 'footer-logo' ); ?>
                        <?php } ?>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-lg-3">
                        <?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
    						<?php dynamic_sidebar( 'footer-1' ); ?>
                        <?php } ?>
                      </div>
                      <div class="col-xs-12 col-sm-6 col-lg-3">
                        <?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
    						<?php dynamic_sidebar( 'footer-2' ); ?>
                        <?php } ?>
                      </div>
    				  <div class="col-xs-12 col-sm-6 col-lg-3">
                        <?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
    						<?php dynamic_sidebar( 'footer-3' ); ?>
                        <?php } ?>
                      </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php if( get_theme_mod( 'calluna_footer_bottom_show', 'yes' ) == 'yes' && get_post_meta( $id, 'calluna_post_footer_copyright', true ) != 'hide' ) { ?>
        	<div class="container-fluid">
                <div class="row" style="padding:35px 0px;">
                    <div class="col-xs-12">
                        <div class="site-info">
                        <?php echo $copyright ?>
                    </div><!-- .site-info -->
                    </div>
              </div>
            </div>
            <?php } ?>
        </div>
	</footer><!-- #colophon -->
    <!-- Go Top Links -->
	<a href="#" id="go-top"><i class="fa fa-angle-up"></i></a>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
