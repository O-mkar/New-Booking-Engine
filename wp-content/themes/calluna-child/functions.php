<?php

// enqueue the parent theme stylesheet
function calluna_child_enqueue_styles() {
	wp_enqueue_style( 'calluna-main', get_template_directory_uri() . '/css/theme.min.css', array()  );
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('calluna-main')  );
}
add_action( 'wp_enqueue_scripts', 'calluna_child_enqueue_styles');