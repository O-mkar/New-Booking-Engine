<?php

// Booking Datepicker ------------------------------------------------------------------------ >
function calluna_datepicker_shortcode() {
	
	$button_text = get_theme_mod( 'button_text', 'Make a reservation' );
	$reservation_header = get_theme_mod( 'reservation_header', '' );
	$reservation_text = get_theme_mod( 'reservation_text', '' );
	$reservation_hint = get_theme_mod( 'reservation_hint', '' );
	// WPML translations
    $button_text = calluna_translate_theme_mod( 'button_text', $button_text );
    $reservation_header = calluna_translate_theme_mod( 'reservation_header', $reservation_header );
    $reservation_text = calluna_translate_theme_mod( 'reservation_text', $reservation_text );
    $reservation_hint = calluna_translate_theme_mod( 'reservation_hint', $reservation_hint );
    
    $arrow_top = get_theme_mod('picker_arrows', 'yes');
	$button_style = get_theme_mod('button_style', 'style-1');
    
    $checkin  = HTL()->session->get( 'checkin' ) ? HTL()->session->get( 'checkin' ) :  null;
	$checkout = HTL()->session->get( 'checkout' ) ? HTL()->session->get( 'checkout' ) : null;
    
	// extensions can hook into here to add their own pages
	$datepicker_form_url = apply_filters( 'hotelier_datepicker_form_url', HTL()->cart->get_room_list_form_url() );
	
	/* Enqueue Scripts and styles */
	//wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('calluna-datepicker');
	wp_enqueue_style( 'datepicker' );
	
	?>
	<?php ob_start(); ?>
	<form name="hotelier_datepicker" method="post" id="hotelier-datepicker" action="<?php echo esc_url($datepicker_form_url) ?>" class="datepicker-form" enctype="multipart/form-data">
		<input type="hidden" id="checkin" class="datepicker-input datepicker-input--checkin" name="checkin">
		<input type="hidden" id="checkout" class="datepicker-input datepicker-input--checkout" name="checkout">
		<input type="hidden" name="guests" id="guests" value="1">
		<div id="datePicker" class="row arr_row">
			<div class="col-xs-4">
				<p class="title"><?php esc_html_e( 'ARRIVING', 'calluna-shortcodes' ); ?></p>
				<?php if ($arrow_top == 'yes') { ?>
				<div class="arrow-up"></div>
				<?php } ?>
				<div id="von" class="dateField">
					<p class="month">11</p>
					<p class="day">09</p>
					<div class="border">
						<span class="arrow"></span>
					</div>
					<div id="vondatepicker"></div>
				</div>
			</div>
			<div class="col-xs-4 dep_row">
				<p class="title"><?php esc_html_e( 'DEPARTING', 'calluna-shortcodes' ); ?></p>
				<?php if ($arrow_top == 'yes') { ?>
				<div class="arrow-up"></div>
				<?php } ?>
				<div id="bis" class="dateField">
					<p class="month">11</p>
					<p class="day">09</p>
					<div class="border">
						<span class="arrow"></span>
					</div>
					<div id="bisdatepicker"></div>
				</div>
			</div>
			<div class="col-xs-4 guest_row">
				<p class="title"><?php esc_html_e( 'GUESTS', 'calluna-shortcodes' ); ?></p>
				<?php if ($arrow_top == 'yes') { ?>
				<div class="arrow-up"></div>
				<?php } ?>
				<div id="gaste" class="dateField">
					<div class="topborder">
						<span class="arrow"></span>
					</div>
					<p id="gasteCount" class="day">1</p>
					<div class="bottomborder">
						<span class="arrow"></span>
					</div>
					<div class="guests">
						<div class="title"><?php esc_html_e( 'Guests', 'calluna-shortcodes' ); ?></div>
						<ul id="gasteSelect">
							<?php 
							$guest_num = get_theme_mod('guest_count', 4);
							if ($guest_num >= 5) {
							$count = 0;
							for ($i = 1; $i <= $guest_num; $i++) { 
							$count++; 
							if ($i == 1) { ?>
							<li class="active col-<?php echo esc_attr($count); ?>"><?php echo esc_attr($i); ?></li>
							<?php } else { ?>
							<li class="col-<?php echo esc_attr($count); ?>"><?php echo esc_attr($i); ?></li>
							<?php }
							if($count == 2) {
							$count = 0;
							}
							}
							} else {
							for ($i = 1; $i <= $guest_num; $i++) {
							if ($i == 1) { ?>
							<li class="active"><?php echo esc_attr($i); ?></li>
							<?php } else { ?>
							<li><?php echo esc_attr($i); ?></li>
							<?php }
							}
							}?>
						</ul>					  		
					</div>
				</div>  
			</div>
		</div>
		<div class="booking-button row">
			<div class="col-xs-12">
				<div class="booking-button_wrapper">
					<div class="btn-primary-container calendar" style="position:relative;">
						<input type="submit" name="hotelier_datepicker_button" id="datepicker-button" class="btn-primary <?php echo esc_attr($button_style); ?>" value="<?php echo esc_attr($button_text );?>">
					</div>
				</div>
				<div class="reservation_wrapper">
					<span class="reservation_header">
						<?php if ($reservation_header) { ?><?php echo esc_attr($reservation_header); ?><?php } ?>
					</span>
					<span class="reservation_text">
						<?php if ($reservation_text) { ?><?php echo esc_attr($reservation_text); ?><?php } ?>
					</span>
					<span class="reservation_hint">
						<?php if ($reservation_hint) { ?><?php echo esc_attr($reservation_hint); ?><?php } ?>
					</span>
				</div>
			</div>
		</div>
    </form>
    
<?php
	$calluna_calendar_output = ob_get_contents();
	ob_end_clean();
	return $calluna_calendar_output;
}
add_shortcode( 'cl_datepicker', 'calluna_datepicker_shortcode' );