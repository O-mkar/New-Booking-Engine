<?php
/**
 * Hotelier specific functions.
 *
 */

/**
 * Disable default Hotelier CSS style
 */
if ( ! function_exists( 'calluna_disable_hotelier_style' ) ) :
	function calluna_disable_hotelier_style() {
		return false;
	}
endif;
add_filter( 'hotelier_enqueue_styles', 'calluna_disable_hotelier_style' );

/**
 * Extra div in room details.
 */
if ( ! function_exists( 'calluna_before_room_meta' ) ) :
	function calluna_before_room_meta() {
		echo '<div class="room-meta-wrapper">';
	}
endif;
add_action( 'hotelier_single_room_details', 'calluna_before_room_meta', 21 );

if ( ! function_exists( 'calluna_after_room_meta' ) ) :
	function calluna_after_room_meta() {
		echo '</div>';
	}
endif;
add_action( 'hotelier_single_room_details', 'calluna_after_room_meta', 51 );

/**
 * Hide room description from the room shortcodes/archive.
 */
remove_action( 'hotelier_archive_item_room', 'hotelier_template_archive_room_description', 20 );

/**
 * Show datepicker in page carousel.
 */
if ( ! function_exists( 'calluna_show_carousel_datepicker' ) ) :
	function calluna_show_carousel_datepicker() {
		echo do_shortcode( '[hotelier_datepicker]' );
	}
endif;
add_action( 'calluna_carousel_datepicker', 'calluna_show_carousel_datepicker', 10 );

/**
 * Register booking sidebar.
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'calluna_booking_sidebar' ) ) :
	function calluna_booking_sidebar() {
		register_sidebar( array(
			'name'          => esc_html__( 'Booking Sidebar', 'calluna-td' ),
			'id'            => 'calluna-booking-sidebar',
			'description'   => esc_html__( 'This sidebar is visible only in the booking pages.', 'calluna-td' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );
	}
endif;
add_action( 'widgets_init', 'calluna_booking_sidebar' );


