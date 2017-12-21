<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category calluna
 * @package  calluna
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( get_template_directory() . '/framework/cmb2/init.php' ) ) {
	require_once get_template_directory() . '/framework/cmb2/init.php';
	require_once get_template_directory() . '/framework/cmb-field-gallery/cmb-field-gallery.php';
} elseif ( file_exists( get_template_directory() . '/framework/CMB2/init.php' ) ) {
	require_once get_template_directory() . '/framework/CMB2/init.php';
	require_once get_template_directory() . '/framework/cmb-field-gallery/cmb-field-gallery.php';
}

add_action( 'cmb2_init', 'calluna_register_events_metabox');
/**
 * Hook in and add a event information metabox. Can only happen on the 'cmb2_init' hook.
 */
function calluna_register_events_metabox() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix_event = '_calluna_event_';	
	
	/**
	 * Event informations metabox
	 */
	$cmb_event = new_cmb2_box( array(
		'id'            => $prefix_event . 'metabox',
		'title'         => esc_html__( 'Event information', 'calluna-td' ),
		'object_types'  => array( 'event'), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
	
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event Date', 'calluna-td' ),
		'id'   => $prefix_event . 'date',
		'type' => 'text_date',
	) );
	
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event Time', 'calluna-td' ),
		'id'   => $prefix_event . 'time',
		'type' => 'text_time',
		'time_format' => 'H:i'
		// 'timezone_meta_key' => $prefix . 'timezone', // Optionally make this field honor the timezone selected in the select_timezone specified above
	) );
	
	$cmb_event->add_field( array(
		'name' => esc_html__( 'Event Location', 'calluna-td' ),
		'id'   => $prefix_event . 'location',
		'type' => 'text_medium',
	) );
	
	/**
	 * Event informations metabox
	 */
	$cmb_event_includes = new_cmb2_box( array(
		'id'            => $prefix_event . 'includes_metabox',
		'title'         => esc_html__( 'Included Details', 'calluna-td' ),
		'object_types'  => array( 'event'), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_event_includes_id = $cmb_event_includes->add_field( array(
		'id'          => $prefix_event . 'includes',
		'type'        => 'group',
		'description' => esc_html__( 'Generates reusable form entries', 'calluna-td' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Included detail {#}', 'calluna-td' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Entry', 'calluna-td' ),
			'remove_button' => esc_html__( 'Remove Entry', 'calluna-td' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_event_includes->add_group_field( $group_field_event_includes_id, array(
		'name'        => esc_html__( 'Description', 'calluna-td' ),
		'description' => esc_html__( 'Write the included detail', 'calluna-td' ),
		'id'          => 'detail',
		'type'        => 'textarea_small',
	) );
}

add_action( 'cmb2_init', 'calluna_register_offers_metabox');
/**
 * Hook in and add a offer information metabox. Can only happen on the 'cmb2_init' hook.
 */
function calluna_register_offers_metabox() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix_offer = '_calluna_offer_';
	$currency_symbol = get_theme_mod( 'currency', '$');	
	
	/**
	 * Offer informations metabox
	 */
	$cmb_offer = new_cmb2_box( array(
		'id'            => $prefix_offer . 'metabox',
		'title'         => esc_html__( 'Offer information', 'calluna-td' ),
		'object_types'  => array( 'offer'), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
	
	$cmb_offer->add_field( array(
		'name' => esc_html__( 'Price', 'calluna-td' ),
		'id'   => $prefix_offer . 'price',
		'type' => 'text_money',
		'before_field' => $currency_symbol, // override '$' symbol if needed
		// 'repeatable' => true,
	) );

    $cmb_offer->add_field( array(
        'name' => esc_html__( 'Individual Link to Offer Reservation', 'calluna-td' ),
        'id'   => $prefix_offer . 'link',
        'type' => 'text_url',
        // 'repeatable' => true,
    ) );
	
	/**
	 * Event informations metabox
	 */
	$cmb_offer_includes = new_cmb2_box( array(
		'id'            => $prefix_offer . 'includes_metabox',
		'title'         => esc_html__( 'Included Details', 'calluna-td' ),
		'object_types'  => array( 'offer'), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
	
	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_includes_id = $cmb_offer_includes->add_field( array(
		'id'          => $prefix_offer . 'includes',
		'type'        => 'group',
		'description' => esc_html__( 'Generates reusable form entries', 'calluna-td' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Included detail {#}', 'calluna-td' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Entry', 'calluna-td' ),
			'remove_button' => esc_html__( 'Remove Entry', 'calluna-td' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_offer_includes->add_group_field( $group_field_includes_id, array(
		'name'        => esc_html__( 'Description', 'calluna-td' ),
		'description' => esc_html__( 'Write the included detail', 'calluna-td' ),
		'id'          => 'detail',
		'type'        => 'textarea_small',
	) );
	
}

add_action( 'cmb2_init', 'calluna_register_rooms_metabox');
/**
 * Hook in and add a offer information metabox. Can only happen on the 'cmb2_init' hook.
 */
function calluna_register_rooms_metabox() {
	
	// Start with an underscore to hide fields from custom fields list
	$prefix_room = '_calluna_room_';
	
	/**
	 * Repeatable Field Groups for Amenities
	 */
	$cmb_room_amenities = new_cmb2_box( array(
		'id'           => $prefix_room . 'metabox_amenities',
		'title'        => esc_html__( 'Amenities', 'calluna-td' ),
		'object_types' => array( 'apb_room_type','room' ),
	) );
	
	$cmb_room_amenities->add_field( array(
		'name' => esc_html__( 'Amenities Description', 'calluna-td' ),
		'id'   => $prefix_room . 'amenities_description',
		'type' => 'textarea_small',
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_room_amenities->add_field( array(
		'id'          => $prefix_room . 'amenities',
		'type'        => 'group',
		'description' => esc_html__( 'Generates reusable form entries', 'calluna-td' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Amenity {#}', 'calluna-td' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Entry', 'calluna-td' ),
			'remove_button' => esc_html__( 'Remove Entry', 'calluna-td' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$cmb_room_amenities->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Name', 'calluna-td' ),
		'id'         => 'title',
		'type'       => 'text',
		// 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
	) );

	$cmb_room_amenities->add_group_field( $group_field_id, array(
		'name'        => esc_html__( 'Description', 'calluna-td' ),
		'description' => esc_html__( 'Write a short description for this entry', 'calluna-td' ),
		'id'          => 'description',
		'type'        => 'wysiwyg',
		'repeatable'  => true
	) );

    $cmb_room_map = new_cmb2_box( array(
        'id'            => $prefix_room . 'metabox_map',
        'title'         => esc_html__( 'Room Google Maps', 'calluna-td' ),
        'object_types'  => array( 'room'), // Post type

    ) );
    $cmb_room_map->add_field( array(
        'name'             => esc_html__( 'Map Type', 'calluna-td' ),
        'id'               => $prefix_room . 'map_type',
        'type'             => 'select',
        'show_option_none' => false,
        'default'	   => 'ROADMAP',
        'options'          => array(
            'ROADMAP' => esc_html__("Road Map", 'calluna-td'),
            'SATELLITE' => esc_html__("Satellite", 'calluna-td'),
            'HYBRID' => esc_html__("Hybrid", 'calluna-td'),
            'TERRAIN' => esc_html__("Terrain", 'calluna-shortcodes')
        ),
    ) );
    $cmb_room_map->add_field( array(
        'name'             => esc_html__( 'Map Style', 'calluna-td' ),
        'id'               => $prefix_room . 'map_style',
        'type'             => 'select',
        'show_option_none' => false,
        'default'	   => 'ROADMAP',
        'options'          => array(
            '1' => esc_html__( 'Shades of Grey', 'calluna-td' ),
            '2' => esc_html__( 'Greyscale', 'calluna-td' ),
            '3' => esc_html__( 'Light Gray', 'calluna-td' ),
            '4' => esc_html__( 'Midnight Commander', 'calluna-td' ),
            '5' => esc_html__( 'Blue water', 'calluna-td' ),
            '6' => esc_html__( 'Icy Blue', 'calluna-td' ),
            '7' => esc_html__( 'Bright and Bubbly', 'calluna-td' ),
            '8' => esc_html__( 'Pale Dawn', 'calluna-td' ),
            '9' => esc_html__( 'Paper', 'calluna-td' ),
            '10' => esc_html__( 'Blue Essence', 'calluna-td' ),
            '11' => esc_html__( 'Apple Maps-esque', 'calluna-td' ),
            '12' => esc_html__( 'Subtle Grayscale', 'calluna-td' ),
            '13' => esc_html__( 'Retro', 'calluna-td' ),
            '14' => esc_html__( 'Hopper', 'calluna-td' ),
            '15' => esc_html__( 'Red Hues', 'calluna-td' ),
            '16' => esc_html__( 'Ultra Light with labels', 'calluna-td' ),
            '17' => esc_html__( 'Unsaturated Browns', 'calluna-td' ),
            '18' => esc_html__( 'Light Dream', 'calluna-td' ),
            '19' => esc_html__( 'Neutral Blue', 'calluna-td' ),
            '20' => esc_html__( 'MapBox', 'calluna-td' )
        ),
    ) );
    $cmb_room_map->add_field( array(
        'name' => __( 'Height', 'calluna-td' ),
        'id'   => $prefix_room . 'map_height',
        'default'	   => '300',
        'type' => 'text'
    ) );
    $cmb_room_map->add_field( array(
        'name' => __( 'Latitude', 'calluna-td' ),
        'id'   => $prefix_room . 'map_lat',
        'type' => 'text'
    ) );
    $cmb_room_map->add_field( array(
        'name' => __( 'Longitude', 'calluna-td' ),
        'id'   => $prefix_room . 'map_lng',
        'type' => 'text'
    ) );
    $cmb_room_map->add_field( array(
        'name' => __( 'Zoom', 'calluna-td' ),
        'id'   => $prefix_room . 'map_zoom',
        'default'	   => '12',
        'type' => 'text'
    ) );
    $cmb_room_map->add_field( array(
        'name'             => esc_html__( 'Show Marker', 'calluna-td' ),
        'id'               => $prefix_room . 'map_marker',
        'type'             => 'select',
        'show_option_none' => false,
        'default'	   => 'yes',
        'options'          => array(
            'yes' => esc_html__("Yes", 'calluna-td'),
            'no' => esc_html__("No", 'calluna-td')
        ),
    ) );
	$cmb_room_map->add_field( array(
        'name' => __( 'API Key', 'calluna-td' ),
        'id'   => $prefix_room . 'map_api_key',
        'default'	   => '',
        'type' => 'text'
    ) );
	
}
