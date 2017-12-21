<?php /* Template Name: Reservation Form */ ?>
<?php get_header(); ?>

<script type="text/javascript">
jQuery(function(){
	var ajaxurl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
            jQuery('#calluna_room').change(function(){
                    var $roomId=jQuery('#calluna_room').val();

                    // call ajax
                     jQuery("#room_params").empty();
                        jQuery.ajax({
                            url:ajaxurl,
                            type:'POST',
                            data:'action=my_special_action&room_Id=' + $roomId,

                             success:function(results)
                                 {
                jQuery("#room_params").append(results);
                                        }
                                   });
                          }
                                    );
});

</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		//disable default google chrom datepicker
		if (navigator.userAgent.indexOf('Chrome') != -1) {
			jQuery('input[type=date]').on('click', function(event) {
				event.preventDefault();
			});
		}
		var $arrivalDate;
		var $departureDate;
		var $guests = 1;
		
		var $_POST = <?php echo json_encode($_POST); ?>;
		
		var $arrivalDate = $_POST['checkin'];
		var $departureDate = $_POST['checkout'];
		var $guests = $_POST['guests'];
		var $room = $_POST['hfRoom'];
		var $type = $_POST['hfType'];
		
      	var $arrivalDatepicker = jQuery( "#arrival" );
		$arrivalDatepicker.datepicker({
			dateFormat: "yy-mm-dd"
		});
		$arrivalDatepicker.datepicker('setDate', $arrivalDate);
		
		var $departureDatepicker = jQuery( "#departure" );
		$departureDatepicker.datepicker({
			dateFormat: "yy-mm-dd"
		});
		$departureDatepicker.datepicker('setDate', $departureDate);
		
		jQuery("#adults").val($guests);

		if ($type == 'room') {
            jQuery('#calluna_room').val($room);

            var ajaxurl = '<?php echo esc_url( admin_url('admin-ajax.php') ); ?>';

            jQuery.ajax({
                url:ajaxurl,
                type:'POST',
                data:'action=my_special_action&room_Id=' + $room,

                success:function(results)
                {
                    jQuery("#room_params").empty();
                    jQuery("#room_params").append(results);
                }
            });
        };
		
	});
</script>

<div id="primary" class="content-area">
		<main id="main" class="site-main main-content">
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
						$headerImageText = get_the_title();	
					}
					$shortcodeImage = '<div class="image-background" style="background: url(' . $image_attributes[0] . ');">';
				$shortcodeImage .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '">';
				$shortcodeImage .= '<span>' . esc_attr($headerImageText) . '</span><span class="separator"></span></h1></div>';
				echo do_shortcode($shortcodeImage); 
				}
				elseif($header == 'color') {
					$color = get_theme_mod('header_bg_color', '#0C2149');
					$headerColorText = get_post_meta(get_the_ID(), '_calluna_header_text', true);
					if ($headerColorText == '')
					{
						$headerColorText = get_the_title();	
					}
                  $shortcodeColor = '<div class="color-background" style="background-color:';
				  	$shortcodeColor .= $color;
					$shortcodeColor.= ';">';
					$shortcodeColor .= '<h1 class="header_text_wrapper ' . esc_attr($header_title_pos) . '"><span>' . esc_attr($headerColorText) . '</span><span class="separator"></span></h1>';
					$shortcodeColor .= '</div>';
				  	echo do_shortcode($shortcodeColor); 
				}?>
                
                
           
               <?php while ( have_posts() ) : the_post(); ?>
               		<div class="no-padding container-fluid">
					<div class="row-eq-height row">
					    <?php $sidebar_pos = get_theme_mod( 'position_sidebar', 'right' );
                        if($sidebar_pos == 'right')
                		{ ?>
           			<div class="col-sm-12 col-md-8 col-lg-8">
							<?php get_template_part( 'content', 'page' ); ?>
						</div>
                      <div class="col-sm-12 col-md-4 col-lg-4 reservation_sidebar">
                			<?php get_sidebar('reservation'); ?>
              			</div>
              			<?php }
                		else 
                		{ ?>
                		<div class="col-sm-12 col-md-4 col-lg-4 reservation_sidebar">
                			<?php get_sidebar('reservation'); ?>
              			</div>
              			<div class="col-sm-12 col-md-8 col-lg-8">
							<?php get_template_part( 'content', 'page' ); ?>
						</div>
                		<?php } ?>
                   </div>
                   	</div>
				 <?php endwhile; // end of the loop. ?>
			

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>