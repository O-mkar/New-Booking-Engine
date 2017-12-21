<?php

// Font Awesome Icons -------------------------------------------------------------------------- >
function calluna_fa_icon_shortcode( $atts, $content = null ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
			'unique_id'     => '',
			'icon'          => 'cloud',
			'style'         => 'circle',
			'float'         => 'left',
			'size'          => 'normal',
			'color'         => '',
			'background'    => '',
			'border_radius' => '',
			'fade_in'       => 'false',
			'url'           => '',
			'url_title'     => '',
	), $atts ) );
	
	// Load font awesome
	wp_enqueue_style( 'font-awesome' );
	
	$output = '';
	
	// FadeOut
	$fade_in_class = null;
	if ( $fade_in == 'true' ) {
		wp_enqueue_script( 'calluna-scroll-fade' );
		$fade_in_class = 'calluna-fadein';
	}
	
	// Sanitize icon
	$url       = esc_url( $url );
	$url_title = esc_attr( $url_title );
	$icon      = $icon == 'none' ? 'remove' : $icon;
	
	// Inline style
	$style_attr = '';

	if ( $color ) {
		$style_attr .= 'color:'. $color .';';
	}
	if ( $background ) {
		$style_attr .= 'background-color:'. $background .';';
	}
	if ( $border_radius ) {
		$style_attr .= 'border-radius:'. $border_radius .';';
	}
	if ( $style_attr ) {
		$style_attr = ' style="'. $style_attr .'"';
	}
	
	// Unique ID
	$unique_id = $unique_id ? ' id="'. $unique_id .'"' : null;
	
	if ( $url ) {
		$output .= '<a href="'. $url .'" title="'. $url_title .'" class="calluna-icon calluna-icon-'. $style.' calluna-icon-'. $size .' calluna-icon-float-'. $float .' '. $fade_in_class .'" '. $unique_id . $style_attr .' >';
		$output .= '<span class="'. calluna_core_shortcodes_font_icon_class( $icon ) .'"></span>';
		$output .= '</a>';
	} else {
		$output .= '<span class="calluna-icon calluna-icon-'. $style.' calluna-icon-'. $size .' calluna-icon-float-'. $float .' '. calluna_core_shortcodes_font_icon_class( $icon ) .' '. $fade_in_class .'"'. $unique_id . $style_attr .'"></span>';
	}
	
	// Return output
	return $output;

}
add_shortcode( 'cl_fa_icon', 'calluna_fa_icon_shortcode' );