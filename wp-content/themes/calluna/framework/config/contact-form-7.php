<?php
//disable jquery js and css from contact form 7
add_filter( 'wpcf7_load_js', '__return_true' );
add_filter( 'wpcf7_load_css', '__return_false' );

/* Add e-mail confirmation to contact form */
add_filter( 'wpcf7_validate_email*', 'calluna_email_confirmation_validation_filter', 20, 2 );
function calluna_email_confirmation_validation_filter( $result, $tag ) {
    $tag = new WPCF7_Shortcode( $tag );
 
    if ( 'email-confirm' == $tag->name ) {
        $your_email = isset( $_POST['email'] ) ? trim( $_POST['email'] ) : '';
        $your_email_confirm = isset( $_POST['email-confirm'] ) ? trim( $_POST['email-confirm'] ) : '';
 
        if ( $your_email != $your_email_confirm ) {
            $result->invalidate( $tag, "Are you sure this is the correct address?" );
        }
    }
 
    return $result;
}

add_filter( 'wpcf7_support_html5', '__return_true' );

//add Html5 fallback for datepicker and number selector for contact form
add_filter( 'wpcf7_support_html5_fallback', '__return_false' );

//add custom dropdown box for selected room to reservation form
function calluna_add_post_type_list_to_contact_form ( $tag, $unused ) {  
  
    $options = (array) $tag['options'];
	foreach ( $options as $option ) {
		if ( preg_match( '%^posttype:([-0-9a-zA-Z_]+)$%', $option, $matches ) ) {
		$post_type = $matches[1];
		}
	}
	//check if post_type is set
	if(!isset($post_type)) {
		return $tag;
	}
	$args= array(
		'post_type' => 'room',
		'order'		 => 'ASC',
		'orderby'   => 'menu_order',
        'posts_per_page' => -1,
		'suppress_filters' => false,
	);
	$plugins = get_posts($args); 
  
    if ( ! $plugins )  
        return $tag;

	// get the existing WPCF7_Pipe objects
	$befores = $tag['pipes']->collect_befores();
	$afters = $tag['pipes']->collect_afters();

	// add the existing WPCF7_Pipe objects to the new pipes array
	$pipes_new = array();
	for ($i=0; $i < count($befores); $i++) {
		$pipes_new[] = $befores[$i] . '|' . $afters[$i];
	}

    foreach ( $plugins as $plugin ) {  
        $tag['raw_values'][] = $plugin->post_title;
        $tag['values'][] = $plugin->ID;
        $tag['labels'][] = $plugin->post_title;
        $pipes_new[] = $plugin->ID . '|' . $plugin->post_title;
    }

    // setup all the WPCF7_Pipe objects
    $tag['pipes'] = new WPCF7_Pipes($pipes_new);

    return $tag;  
}  
add_filter( 'wpcf7_form_tag', 'calluna_add_post_type_list_to_contact_form', 10, 2);

//add correct button style from customizer to contact form 7
add_filter('wpcf7_form_elements','calluna_wpcf7_form_elements');
function calluna_wpcf7_form_elements( $content ) {
	// global $wpcf7_contact_form;
	
	$rl_pfind = '/btn btn-primary/';
	$rl_preplace = 'btn btn-primary ' . get_theme_mod('button_style', 'style-1');
	$content = preg_replace( $rl_pfind, $rl_preplace, $content);

	return $content;	
}

?>