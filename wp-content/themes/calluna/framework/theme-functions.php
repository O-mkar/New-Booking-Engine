<?php
/**
 * Check if Hotelier is active
 */
if ( ! function_exists( 'calluna_is_hotelier_active' ) ) :
	function calluna_is_hotelier_active() {
		if ( class_exists('Hotelier') ) {
		    return true;
		}
	}
endif;

if (! function_exists('calluna_filter_change_room_type_slug')) {
	function calluna_filter_change_room_type_slug( $args ) {
		$args['rewrite'] = array( 'slug' => get_theme_mod('room_type_slug', 'room') );

		return $args;
	}
}

add_filter( 'hotelier_room_post_type_args', 'calluna_filter_change_room_type_slug' );

if (! function_exists('calluna_filter_change_event_type_slug')) {
	function calluna_filter_change_event_type_slug( $args ) {
		$args['rewrite'] = array( 'slug' => get_theme_mod('event_type_slug', 'event') );

		return $args;
	}
}

add_filter( 'calluna_post_type_event', 'calluna_filter_change_event_type_slug' );

if (! function_exists('calluna_filter_change_offer_type_slug')) {
    function calluna_filter_change_offer_type_slug( $args ) {
        $args['rewrite'] = array( 'slug' => get_theme_mod('offer_type_slug', 'offer') );

        return $args;
    }
}

add_filter( 'calluna_post_type_offer', 'calluna_filter_change_offer_type_slug' );