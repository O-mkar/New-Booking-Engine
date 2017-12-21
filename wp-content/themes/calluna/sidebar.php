<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Morrison_Hotel
 */

if ( calluna_is_hotelier_active() && is_booking_page() ) : ?>

	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'calluna-booking-sidebar' ); ?>
	</aside><!-- #secondary -->

<?php else : ?>

	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar(); ?>
	</aside><!-- #secondary -->

<?php endif; ?>

    
