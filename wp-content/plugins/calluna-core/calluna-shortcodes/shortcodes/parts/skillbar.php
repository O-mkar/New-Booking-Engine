<?php

// Skillbars -------------------------------------------------------------------------- >	
function calluna_skillbar_shortcode( $atts ) {

	// Parse and extract shortcode attributes
	extract( shortcode_atts( array(
		'title'        => '',
		'percentage'   => '100',
		'color'        => '#967a50',
		'class'        => '',
		'show_percent' => 'true'
	), $atts ) );
	
	$title = esc_attr($title);
	
	// Define output var
	$output = '';
	
	// Enque scripts
	wp_enqueue_script( 'calluna-skillbar' );

	// Inline js
	if ( function_exists( 'vc_is_inline' ) && vc_is_inline() ) {

		$output .= '<script>
			jQuery(function($){
				$(document).ready(function(){
					$(".calluna-skillbar").each(function(){
						$(this).find(".calluna-skillbar-bar").animate({ width: $(this).attr("data-percent") }, 800 );
					});
				});
			});</script>';

	}
	
	// Open skillbar main wrapper
	$output .= '<div class="calluna-skillbar calluna-clearfix '. $class .'" data-percent="'. $percentage .'%">';

		// Display title
		if ( $title ) {
			$output .= '<div class="calluna-skillbar-title" style="background: '. $color .';"><span>'. $title .'</span></div>';
		}

		// Display bar
		$output .= '<div class="calluna-skillbar-bar" style="background: '. $color .';"></div>';

		// Display percentage
		if ( $show_percent == 'true' ) {
			$output .= '<div class="calluna-skill-bar-percent">'.$percentage.'%</div>';
		}

	// Close main wrapper
	$output .= '</div>';
	
	// Return output
	return $output;
}

add_shortcode( 'cl_skillbar', 'calluna_skillbar_shortcode' );