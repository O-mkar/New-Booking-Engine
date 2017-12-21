<?php
/**
 * Room rate name
 *
 * This template can be overridden by copying it to yourtheme/hotelier/room-list/content/rate/rate-name.php.
 *
 * @author  Benito Lopez <hello@lopezb.com>
 * @package Hotelier/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<h4 class="rate__room rate__room--listing"><?php echo esc_html( $variation->get_formatted_room_rate() ); ?></h4>
