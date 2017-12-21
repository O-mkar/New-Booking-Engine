<?php
/**
 * Init Visual Composer Settings and map shortcodes
 *
 */

//Add shortcodes to visual composer grid editor
add_filter( 'vc_grid_item_shortcodes', 'calluna_add_grid_shortcodes' );
function calluna_add_grid_shortcodes( $shortcodes ) {
  $shortcodes['vc_calluna_offer_price'] = array(
	 'name' => esc_html__( 'Calluna Offer Price', 'calluna-shortcodes' ),
	 'base' => 'vc_calluna_offer_price',
	 'category' => esc_html__( 'Calluna', 'calluna_td' ),
	 'description' => esc_html__( 'Show the offer price', 'calluna-shortcodes' ),
	 'post_type' => Vc_Grid_Item_Editor::postType(),
  );
 
 
   return $shortcodes;
}

 
function calluna_core_shortcodes_vc_init() {
	
	/* ------------------------------------------------------------------------------- */
	/* VC Parameters
	/* ------------------------------------------------------------------------------- */
	
	/* Number ------------------------------------------------------------------------ */

	function calluna_core_shortcodes_number_settings_field($settings, $value) {
		$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
		$type       = isset($settings['type']) ? $settings['type'] : '';
		$min        = isset($settings['min']) ? $settings['min'] : '';
		$max        = isset($settings['max']) ? $settings['max'] : '';
		$suffix     = isset($settings['suffix']) ? $settings['suffix'] : '';
		$class      = isset($settings['class']) ? $settings['class'] : '';
		$output     = '<input type="number" min="' . $min . '" max="' . $max . '" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="' . $value . '" style="max-width:100px; margin-right: 10px;" />' . $suffix;
		return $output;
	}

	if (function_exists('vc_add_shortcode_param')) {
		vc_add_shortcode_param('number', 'calluna_core_shortcodes_number_settings_field');
	}
	
	/* Label for Booking Calendar--------------------------------------------------------- */

	function calluna_core_label_settings_field($settings, $value) {
		$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
		$type       = isset($settings['type']) ? $settings['type'] : '';
		$output     = '<label class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '"  style="max-width:100px; margin-right: 10px;">'. esc_html__( "After adding the calendar you can change the text and link for the reservation button and some additional texts with the theme customizer in the booking calendar section.", 'calluna-shortcodes' ). '</label>';
		return $output;
	}

	if (function_exists('vc_add_shortcode_param')) {
		vc_add_shortcode_param('label', 'calluna_core_label_settings_field');
	}
	
	/* Offer Category Dropdown --------------------------------------------------- */

	function calluna_core_offer_cats_settings_field($settings, $value) {
		$cats_output = '<div class="offer_categories">'
			. '<select name="' . $settings['param_name']
			. '" class="wpb_vc_param_value wpb-select dropdown '
			. $settings['param_name'] . ' ' . $settings['type'] . '_field">'
			. '<option value="">All Categories</option>';
		/* Get categories */
		$terms = get_terms('offer_category', array(
			'orderby'    => 'name',
			'hide_empty' => TRUE
		));
		foreach ($terms as $term) {
			$cats_output .= '<option value="' . $term->term_id . '"';
			if ($term->term_id == $value) {
				$cats_output .= 'selected="selected"';
			}
			$cats_output .= '>' . $term->name . '</option>';
		}
		$cats_output .= '</select>'
			. '</div>';
		return $cats_output;
	}

	if (function_exists('vc_add_shortcode_param')) {
		vc_add_shortcode_param('offer_cats', 'calluna_core_offer_cats_settings_field');
	}
	
	/* Event Category Dropdown --------------------------------------------------- */

	function calluna_core_event_cats_settings_field($settings, $value) {
		$cats_output = '<div class="event_categories">'
			. '<select name="' . $settings['param_name']
			. '" class="wpb_vc_param_value wpb-select dropdown '
			. $settings['param_name'] . ' ' . $settings['type'] . '_field">'
			. '<option value="">All Categories</option>';
		/* Get categories */
		$terms = get_terms('event_category', array(
			'orderby'    => 'name',
			'hide_empty' => TRUE
		));
		foreach ($terms as $term) {
			$cats_output .= '<option value="' . $term->term_id . '"';
			if ($term->term_id == $value) {
				$cats_output .= 'selected="selected"';
			}
			$cats_output .= '>' . $term->name . '</option>';
		}
		$cats_output .= '</select>'
			. '</div>';
		return $cats_output;
	}

	if (function_exists('vc_add_shortcode_param')) {
		vc_add_shortcode_param('event_cats', 'calluna_core_event_cats_settings_field');
	}
	
	//Font Awesome Icon Param ------------------------------------------------------------- >
	function calluna_core_shortcodes_font_awesome_icon_field( $settings, $value ) {
        $return = '<div class="my_param_block">
            <div class="calluna-font-awesome-icon-preview"></div>
            <input placeholder="' . esc_html__( "Type in an icon name or select one from below", 'calluna-shortcodes' ) . '" name="' . $settings['param_name'] . '"'
        . ' data-param-name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput ' . $settings['param_name'].' '.$settings['type'].'_field" type="text" value="'. $value .'" style="width: 100%; vertical-align: top; margin-bottom: 10px" />';
        $return .= '<div class="calluna-font-awesome-icon-select-window">
                    <span class="fa fa-times" style="color:red;" data-name="clear"></span>';
                        $icons = calluna_core_shortcodes_font_icons_array();
                        foreach ( $icons as $icon ) {
                            if ( '' != $icon ) {
                                if ( $value == $icon ) {
                                    $active = 'active';
                                } else {
                                    $active = '';
                                }
                                $return .= '<span class="fa fa-'. $icon .' '. $active .'" data-name="'. $icon .'"></span>';
                            }
                        }
        $return .= '</div></div><div style="clear:both;"></div>';
        return $return;
    }
    if (function_exists('vc_add_shortcode_param')) {
		vc_add_shortcode_param('font_awesome_icon', 'calluna_core_shortcodes_font_awesome_icon_field', CALLUNA_CORE_URL .'calluna-shortcodes/shortcodes/js/calluna-icon-type.min.js');
	}

}
add_action( 'vc_before_init', 'calluna_core_shortcodes_vc_init' );

// Map Shortcodes ----------------------------------------------------------------------->

require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_booking-calendar.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_button.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_callout.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_content-image.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_event-carousel.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_font-awesome-icon.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_google-map.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_heading.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_highlight.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_icon-box.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_image-gallery.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_offer-carousel.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_post-grid.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_pricing.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_room-carousel.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_room-grid.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_skillbar.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_teaser.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_testimonial.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_time.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_weather.php' );
require_once( plugin_dir_path( __FILE__ ) . '/parts/vc_wpml.php' );

//Add custom css to Visual Composer Admin
function calluna_core_shortcodes_vc_admin_css() {
	if ( class_exists( 'Vc_Manager' ) ) {
		wp_enqueue_style( 'calluna-shortcodes-vc', CALLUNA_CORE_URL. 'calluna-shortcodes/visual-composer/css/calluna-shortcodes-vc.css',array(),null );
	}
}
add_action( 'admin_enqueue_scripts', 'calluna_core_shortcodes_vc_admin_css' );