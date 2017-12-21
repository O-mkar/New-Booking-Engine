<?php

// Pricing Table -------------------------------------------------------------------------- >
 
/*main*/
function calluna_pricing_table_shortcode( $atts, $content = null  ) {

	// Extract and parse attributes
	extract( shortcode_atts( array(
		'class'	=> ''
	), $atts ) );

	// Return output
	return '<div class="calluna-pricing-table '. $class .'">' . do_shortcode($content) . '</div><div class="calluna-clear-floats"></div>';

}
add_shortcode( 'cl_pricing_table', 'calluna_pricing_table_shortcode' );

/*section*/
function calluna_pricing_shortcode( $atts, $content = null  ) {
	
	// Extract and parse attributes
	extract( shortcode_atts( array(
		'featured'				=> 'no',
		'plan'					=> 'Basic',
		'cost'					=> '$20',
		'per'					=> 'month',
		'button_url'			=> '',
		'button_text'			=> '',
		'button_style'			=> 'style-1',
		'button_size'			=> '',
		'button_target'			=> 'self',
		'button_rel'			=> 'nofollow',
		'class'					=> '',
		'button_icon_left'		=> '',
		'button_icon_right'		=> '',
	), $atts ) );
	
	// Sanitize data
	$featured_pricing    = $featured == 'yes' ? ' featured' : null;
	$button_url          = esc_url( $button_url );
  	$button_text = esc_attr($button_text);
	
	// Output
	$output ='';
	$output .= '<div class="calluna-pricing calluna-'. $featured_pricing .' calluna-column-'. $class .'">';

		// Heading
		if ( $plan || $cost || $per ) {

			$output .= '<div class="calluna-pricing-header">';

			// Plan
			if ( $plan ) {
				$output .= '<h4>'. $plan .'</h4>';
			}

			// Cost
			if ( $cost ) {
				$output .= '<div class="calluna-pricing-cost">'. $cost .'</div>';
			}

			// Per
			if ( $per ) {
				$output .= '<div class="calluna-pricing-per">'. $per .'</div>';
			}

			$output .= '</div>';

		}

		// Features/Content
		if ( $content ) {
			$output .= '<div class="calluna-pricing-content">';
				$output .= $content;
			$output .= '</div>';
		}

		// Button
		if ( $button_url && $button_text ) {
			
		    $button_target     = ( strpos( $button_target, 'blank' !== false ) ) ? ' target="_blank"' : null;
			$button_rel        = 'nofollow' == $button_rel ? ' rel="nofollow"' : null;
			$button_icon_left  = calluna_core_shortcodes_font_icon_class( $button_icon_left );
			$button_icon_right = calluna_core_shortcodes_font_icon_class( $button_icon_right );

			// Load required scripts
			if ( $button_icon_left || $button_icon_right ) {
				wp_enqueue_style( 'font-awesome' );
			}

			$output .= '<div class="calluna-pricing-button"><a href="'. $button_url .'" class="calluna-button btn btn-primary '. $button_size .' ' . $button_style . '" '. $button_target . $button_rel .'><span class="calluna-button-inner">';
				if ( $button_icon_left ) {
					$output .= '<span class="calluna-button-icon-left '. $button_icon_left .'"></span>';
				}
				$output .= $button_text;
				if ( $button_icon_right ) {
					$output .= '<span class="calluna-button-icon-right '. $button_icon_right .'"></span>';
				}
			$output .= '</span></a></div>';

		}

	$output .= '</div>';

	// Return output
	return $output;

}
add_shortcode( 'cl_pricing', 'calluna_pricing_shortcode' );