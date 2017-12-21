<?php
/**
 * Register all shortcodes
 */

// Widget Support -------------------------------------------------------------------------- >
add_filter( 'widget_text', 'do_shortcode' );

// "Fix" Shortcodes -------------------------------------------------------------------------- >
function calluna_core_fix_shortcodes($content){   
	$array = array (
		'<p>['    => '[', 
		']</p>'   => ']', 
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter( 'the_content', 'calluna_core_fix_shortcodes' );

function calluna_core_remove_crappy_markup( $string )
{
    $patterns = array(
        '#^s*#',
        '#s*$#'
    );

    return preg_replace($patterns, '', $string);
}

// Include all shortcode parts
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/accordion.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/booking-calendar-new.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/button.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/callout.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/content-image.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/event-carousel.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/font-awesome-icon.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/google-map.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/heading.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/highlight.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/icon-box.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/image-gallery.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/offer-carousel.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/offer-price.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/post-grid.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/pricing.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/room-carousel.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/room-grid.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/room-price.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/single-booking-calendar.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/skillbar.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/tab.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/teaser.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/testimonial.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/time.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/toggle.php' );
require_once( CALLUNA_CORE_PATH . 'calluna-shortcodes/shortcodes/parts/wpml.php' );


