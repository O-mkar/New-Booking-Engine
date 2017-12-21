<?php

// Room price -------------------------------------------------------------------------- >	
function calluna_room_price_shortcode( $atts, $content = null ) {
  	?>
	  
	<?php ob_start(); ?>
       		<?php 
       			global $room;
       			
       			$price = $room->calluna_get_min_price_html();?>
                        <?php if (! empty( $price )) { ?>
                            <div class="offer_price">
                            	<?php $pre_text = get_theme_mod( 'room_price_text', 'starting at');
                            	// WPML translations
                                $pre_text = calluna_translate_theme_mod( 'room_price_text', $pre_text );
								$pre_text .= ' ';
							  	?>
                            	<span><?php echo esc_attr($pre_text) ?></span>
                                <?php
									echo $price;
								?>
                            </div>
                        <?php }?>
		<?php
		$calluna_room_price_output = ob_get_contents();
		ob_end_clean();
		return $calluna_room_price_output;

}
add_shortcode( 'cl_room_price', 'calluna_room_price_shortcode' );