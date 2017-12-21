<?php
// Offer price for visual composer grid
function vc_calluna_offer_price_render() {
	$currency_symbol = get_theme_mod('currency', '$');
	$pre_text = get_theme_mod( 'offer_price_text', 'Price per person');
	// WPML translations
    $pre_text = calluna_translate_theme_mod( 'offer_price_text', $pre_text );
  	$pre_text .= ' ';
	
	if (get_theme_mod('currency_pos', 'before') == 'before') {
								return '<div class="offer_price"><span>'. esc_attr($pre_text) . '</span>' . esc_attr($currency_symbol) . '{{ post_data:_calluna_offer_price }}</div>'; 	
								}
								else {
									return '<div class="offer_price"><span>'. esc_attr($pre_text) . '</span>{{ post_data:_calluna_offer_price }}'. esc_attr($currency_symbol) . '</div>'; 
								}
}

add_shortcode( 'vc_calluna_offer_price', 'vc_calluna_offer_price_render' );

// Offer price -------------------------------------------------------------------------- >	
function calluna_offer_price_shortcode( $atts, $content = null ) {
  	?>
	  
	<?php ob_start(); ?>
       		<?php $price = get_post_meta(get_the_ID(),'_calluna_offer_price',true);?>
                        <?php if (! empty( $price )) { ?>
                            <div class="offer_price">
							  	<?php $pre_text = get_theme_mod( 'offer_price_text', 'Price per person');
							  	// WPML translations
                                $pre_text = calluna_translate_theme_mod( 'offer_price_text', $pre_text );
							  	$pre_text .= ' '; ?>
                            	<span><?php echo esc_attr($pre_text) ?></span>
                                <?php 
									$currency_symbol = get_theme_mod( 'currency', '$');
									if (get_theme_mod('currency_pos', 'before') == 'before') {
										echo esc_attr($currency_symbol). esc_attr($price);	
									}
									else {
										echo esc_attr($price) . esc_attr($currency_symbol);	
									}
								?>
                            </div>
                        <?php }?>
		<?php
		$calluna_offer_price_output = ob_get_contents();
		ob_end_clean();
		return $calluna_offer_price_output;

}
add_shortcode( 'cl_offer_price', 'calluna_offer_price_shortcode' );