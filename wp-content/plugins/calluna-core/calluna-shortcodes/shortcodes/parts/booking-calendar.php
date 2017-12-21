<?php

// Booking Calendar ------------------------------------------------------------------------ >
function calluna_booking_calendar_shortcode() {

    $form_method = 'POST';
    $hotelier = get_theme_mod( 'hotelier', 'yes' );
    
    
	$button_text = get_theme_mod( 'button_text', 'Make a reservation' );
	$reservation_header = get_theme_mod( 'reservation_header', '' );
	$reservation_text = get_theme_mod( 'reservation_text', '' );
	$reservation_hint = get_theme_mod( 'reservation_hint', '' );
	// WPML translations
    $button_text = calluna_translate_theme_mod( 'button_text', $button_text );
    $reservation_header = calluna_translate_theme_mod( 'reservation_header', $reservation_header );
    $reservation_text = calluna_translate_theme_mod( 'reservation_text', $reservation_text );
    $reservation_hint = calluna_translate_theme_mod( 'reservation_hint', $reservation_hint );


	$button_link = esc_url( get_permalink( get_theme_mod( 'button_link', '0') ) );
	$external_link = get_theme_mod('external_link');
	if ($external_link) {
	    $button_link = $external_link;
	    $form_method = get_theme_mod('booking_form_method', 'GET');
	}
	
	$arrow_top = get_theme_mod('picker_arrows', 'yes');
	$button_style = get_theme_mod('button_style', 'style-1');
	
	/* Enqueue Scripts and styles */
	//wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('calluna-booking');
	wp_enqueue_style( 'datepicker' );
	
	// Code
	?>
	
	<?php ob_start(); ?>

    <?php if ($hotelier != 'no') { ?>
        <form method="get" action="<?php echo esc_url( AWE_function::get_check_available_page() ); ?>" class="apb-single-check-avb-form">
		<input type="hidden" name="from" id="from">
		<input type="hidden" name="to" id="to">
		<input type="hidden" name="room_num" value="1">
		<input type="hidden" name="room_type_id" value="0">
		<input type="hidden" name="room_adult[]" id="hfAdults" value="1">
		<input type="hidden" name="room_child[]" value="0">
		<input type="hidden" name="check_from" value="shortcode">
    <?php } else { ?>
        <form action="<?php echo $button_link; ?>" method="<?php echo esc_attr($form_method) ?>" id="calluna-booking-form">
		<?php if ($external_link) {
		    $from = get_theme_mod('external_param_from');
            $to = get_theme_mod('external_param_to');
            $guests = get_theme_mod('external_param_guests');
            $add1_name = get_theme_mod('external_param_add1_name');
            $add2_name = get_theme_mod('external_param_add2_name');
            $add1_value = get_theme_mod('external_param_add1_value');
            $add2_value = get_theme_mod('external_param_add2_value');
            ?>

		    <input type="hidden" name="<?php echo esc_attr($from);?>" id="from">
            <input type="hidden" name="<?php echo esc_attr($to);?>" id="to">
            <input type="hidden" name="<?php echo esc_attr($guests);?>" id="hfAdults" value="1">
            <?php if($add1_name != '') { ?>
                <input type="hidden" name="<?php echo esc_attr($add1_name);?>" id="add1" value="<?php echo esc_attr($add1_value);?>">
            <?php } ?>
            <?php if($add2_name != '') { ?>
                <input type="hidden" name="<?php echo esc_attr($add2_name);?>" id="add2" value="<?php echo esc_attr($add2_value);?>">
            <?php } ?>
		<?php }else { ?>
		    <input type="hidden" name="from" id="from">
            <input type="hidden" name="to" id="to">
            <input type="hidden" name="hfAdults" id="hfAdults" value="1">
            <input type="hidden" name="hfRoom" id="hfRoom" value="<?php echo get_the_ID(); ?>">
            <input type="hidden" name="hfType" id="hfType" value="<?php echo get_post_type(get_the_ID()); ?>">
		<?php }
    } ?>
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
							  <input type="submit" class="btn-primary check-avb-js <?php echo esc_attr($button_style); ?>" value="<?php echo esc_attr($button_text );?>">
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
add_shortcode( 'cl_booking_calendar', 'calluna_booking_calendar_shortcode' );