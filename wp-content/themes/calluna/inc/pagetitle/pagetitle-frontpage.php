<?php
/* get revolution slider from shortcode in custom field*/
$header = get_post_meta(get_the_ID(), '_calluna_header_select', true);
$header_title_pos = get_theme_mod('header_title_pos', 'text-left');
if($header == 'slider') {
	$slider = get_post_meta(get_the_ID(), '_calluna_header_slider', true);
	echo do_shortcode($slider); 
} 
elseif($header == 'image') {
	$image = get_post_meta(get_the_ID(), '_calluna_header_image', true);
	$image_attributes = wp_get_attachment_image_src( $image, 'full' );
	$headerImageText = get_post_meta(get_the_ID(), '_calluna_header_text', true);
	if ($headerImageText == '')
	{
	    if('posts' == get_option( 'show_on_front' )) : 
		    $headerImageText = esc_html__('Recent Posts', 'calluna-td');
		else :
		    $headerImageText = get_the_title();
		endif;	
	}
	$shortcodeImage = '<div class="image-background" style="background: url(' . esc_url( $image_attributes[0] ) . ');">';
    $shortcodeImage .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '">';
    $shortcodeImage .= '<span>' . esc_attr($headerImageText) . '</span><span class="separator"></span></h1></div>';
    echo do_shortcode($shortcodeImage); 
}
elseif($header == 'color' || $header == '') {
	$color = get_post_meta(get_the_ID(), '_calluna_header_color', true);
	$color = ($color != '') ? ' style = "background-color:' .$color . ';"' : '';
	$headerColorText = get_post_meta(get_the_ID(), '_calluna_header_text', true);
	if ($headerColorText == '')
	{
	    if('posts' == get_option( 'show_on_front' )) : 
		    $headerColorText = esc_html__('Recent Posts', 'calluna-td');
		else :
		    $headerColorText = get_the_title();
		endif;
	}
    $shortcodeColor = '<div class="color-background"' . $color . '>';
	$shortcodeColor .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '"><span>' . esc_attr($headerColorText) . '</span><span class="separator"></span></h1>';
	$shortcodeColor .= '</div>';
  	echo do_shortcode($shortcodeColor); 
}