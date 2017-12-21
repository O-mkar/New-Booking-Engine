<?php

// Buttons -------------------------------------------------------------------------- >
function calluna_button_shortcode( $atts, $content = null ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'style'         => 'style-1',
		'url'           => '#',
		'title'         => esc_html__( 'Button', 'calluna-shortcodes' ),
		'target'        => 'self',
		'size'          => 'normal',
		'rel'           => '',
		'class'         => '',
		'icon_left'     => '',
		'icon_right'    => '',
		'fade_in'       => '',
		'align'         => '',
	), $atts ) );

	//Set Vars
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'calluna-scroll-fade' );
		$fade_in_class = 'calluna-fadein';
	}

	// Sanitize
	$url        = esc_url($url);
	$title      = $title ? esc_attr( $title ) : '';
	$rel        = ( $rel !== 'none' ) ? ' rel="'.$rel.'"' : null;
	$icon_left  = calluna_core_shortcodes_font_icon_class( $icon_left );
	$icon_right = calluna_core_shortcodes_font_icon_class( $icon_right );

	// Load required scripts
	if ( $icon_left || $icon_right ) {
		wp_enqueue_style( 'font-awesome' );
	}
	// Display Button
	if ( $url && $title ) {

		$output= null;
		$output .= '<a href="' . $url . '" class="calluna-button btn btn-primary '. $size .' ' . $style . ' '. $class .' '. $fade_in_class .' '. $align .'" target="_'.$target.'" title="'. $title .'"'. $rel .'>';
			$output .= '<span class="calluna-button-inner">';
				if ( $icon_left ) {
					$output .= '<span class="calluna-button-icon-left '. $icon_left .'"></span>';
				}
				$output .= $title;
				if ( $icon_right ) {
					$output .= '<span class="calluna-button-icon-right '. $icon_right .'"></span>';
				}
			$output .= '</span>';
		$output .= '</a>';
		return $output;

	} else {

		return '<p>'. esc_html__( 'Please enter a valid URL and title for your button.', 'calluna-shortcodes' ) .'</p>';

	}

}
add_shortcode( 'cl_button', 'calluna_button_shortcode' );