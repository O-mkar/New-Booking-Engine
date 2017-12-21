<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package calluna
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function calluna_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'calluna_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function calluna_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'calluna_body_classes' );



/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function calluna_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'calluna_setup_author' );

/**
 * Register theme mods for translations
 *
 */
function calluna_register_theme_mod_strings() {
    return apply_filters( 'calluna_register_theme_mod_strings', array(
        'booking_teaser_text' => 'Book your trip!',
        'footer_txt' => 'Copyright 2015 by themetwins. Calluna Hotel Theme crafted with love.',
        'button_text' => 'Make a reservation',
        'reservation_header' => '',
        'reservation_text' => '',
        'reservation_hint' => '',
        'related_events_title' => 'More Events',
        'related_events_text' => 'More Events Details',
        'event_gallery_title' => 'Gallery',
        'event_details_title' => 'Details',
        'event_details_subtitle' => 'What\'s included',
        'related_offers_title' => 'Other Offers',
        'related_offers_text' => 'Other Offers Details',
        'room_header_title' => 'Information',
        'room_details_tab_title' => 'Details',
        'room_extras_tab_title' => 'Optional Extras',
        'room_availability_tab_title' => 'Date Available',
        'room_price_text' => 'starting at',
        'room_button_text' => 'starting at',
        'room_amenities_title' => 'Amenities',
        'room_gallery_title' => 'Gallery',
        'offer_price_text' => 'Price per person',
        'offer_button_text' => 'Offer reservation',
        'offer_gallery_title' => 'Gallery',
        'offer_details_title' => 'Details',
        'offer_details_subtitle' => 'What\'s included'
    ) );
}

/**
 * Provides translation support for WPML
 */
function calluna_translate_theme_mod( $id, $content ) {

    // Return false if no content is found
    if ( ! $content ) {
        return false;
    }

    // WPML translation
    if ( function_exists( 'icl_t' ) && $id ) {
        $content = icl_t( 'Theme Mod', $id, $content );
    }

	// Return the content
	return $content;

}


/* ------------------------------------------------------------------------ */
/* Custom Excerpts
/* ------------------------------------------------------------------------ */

// Custom Excerpt Length
function calluna_custom_excerpt($limit=50) {
    return strip_shortcodes(wp_trim_words(get_the_content(), $limit, '... <a class="more-link" href="'. get_permalink() .'">' . __('Continue reading', 'calluna-td') . '</a>'));
}

//Overwrite next and prev post link
function calluna_add_class_next_post_link($html){
    $html = str_replace('</a>','<i class="icon-right"></i></a>',$html);
    return $html;
}
add_filter('next_post_link','calluna_add_class_next_post_link',10,1);

function calluna_add_class_previous_post_link($html){
    $html = str_replace('">','"><i class="icon-left"></i>',$html);
    return $html;
}
add_filter('previous_post_link','calluna_add_class_previous_post_link',10,1);

/* ------------------------------------------------------------------------ */
/* Helper - expand allowed tags()
/* Source: https://gist.github.com/adamsilverstein/10783774
/* ------------------------------------------------------------------------ */
function calluna_allowed_tags() {
	$my_allowed = wp_kses_allowed_html( 'post' );
	// iframe
	$my_allowed['iframe'] = array(
		'src'             => array(),
		'height'          => array(),
		'width'           => array(),
		'frameborder'     => array(),
		'allowfullscreen' => array(),
	);
	return $my_allowed;
}
