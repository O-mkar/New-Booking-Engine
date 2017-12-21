<?php
/* ------------------------------------------------------------------------------- */
/* Master Slider Calluna Skin
/* ------------------------------------------------------------------------------- */
 
function calluna_masterslider_skins( $slider_skins ) {

	$slider_skins[] = array( 'class' => 'ms-skin-calluna', 'label' => 'Calluna' );
 
	return $slider_skins;
}
 
add_filter( 'masterslider_skins', 'calluna_masterslider_skins' );

function calluna_masterslider_enqueue_styles( $enqueue_styles ) {
 
    $enqueue_styles[] = array(
        'src'     => get_template_directory_uri() . '/css/ms-skin-calluna.css' ,
        'deps'    => array(),
        'version' => '1.0'
    );
     
    return $enqueue_styles;
}
 
add_filter( 'masterslider_enqueue_styles', 'calluna_masterslider_enqueue_styles' );