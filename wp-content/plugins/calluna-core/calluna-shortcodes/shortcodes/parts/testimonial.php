<?php

// Testimonial -------------------------------------------------------------------------- >
function calluna_testimonial_shortcode( $atts, $content = null  ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'by'      => '',
		'position' => '',
		'image' => '',
		'class'   => '',
		'fade_in' => 'false',
	), $atts ) );

	// Fade In
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'calluna-scroll-fade' );
		$fade_in_class = 'calluna-fadein';
	}

	// Output
	$output = '';
	$output .= '<div class="calluna-testimonial '. $class .' '. $fade_in_class .'">';
	if ( $image ) {
		$output .= '<div class="calluna-testimonial-author-image">' . wp_get_attachment_image( $image , 'thumbnail') . '</div>';	
	}
		$output .= '<div class="calluna-testimonial-content calluna-clearfix">'. wpautop( do_shortcode( $content ) );
		if ( $by ) {
			$output .= '<div class="calluna-testimonial-author">';
			$output .= $by;
			if ( $position ) {
			$separator = ', ';
			$output .= '<span>' . $separator . $position . '</span>';	
			}
			$output .= '</div>';
		}
	$output .= '</div></div>';

	// Return output
	return $output;

}
add_shortcode( 'cl_testimonial', 'calluna_testimonial_shortcode' );