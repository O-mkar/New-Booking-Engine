<?php

function calluna_content_image_shortcode( $atts, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'image' => '',
				'layout' => 'box-left'
			), $atts
		)
	);

	if( 'offscreen-left' == $layout ){

		$output = '
			<section class="image-edge">
			    <div class="col-md-6 col-sm-4 p0">
			    	'. wp_get_attachment_image( $image, 'full', 0, array('class' => 'mb-xs-24') ) .'
			    </div>
			    <div class="container">
			        <div class="col-md-5 col-md-offset-1 col-sm-7 col-sm-offset-1 v-align-transform right">
			            '. do_shortcode($content) .'
			        </div>
			    </div>
			</section>
		';

	} elseif( 'offscreen-right' == $layout ) {

		$output = '
			<section class="image-edge">
			    <div class="col-md-6 col-sm-4 p0 col-md-push-6 col-sm-push-8">
			        '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'mb-xs-24') ) .'
			    </div>
			    <div class="container">
			        <div class="col-md-5 col-md-pull-0 col-sm-7 col-sm-pull-4 v-align-transform">
			            '. do_shortcode($content) .'
			        </div>
			    </div>
			</section>
		';

	} elseif( 'shadow-left' == $layout ) {

		$output = '
			<section>
			    <div class="container">
			        <div class="row v-align-children">
			            <div class="col-md-7 col-sm-6 text-center mb-xs-24">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'cast-shadow') ) .'
			            </div>
			            <div class="col-md-4 col-md-offset-1 col-sm-5 col-sm-offset-1">
			                '. do_shortcode($content) .'
			            </div>
			        </div>
			    </div>
			</section>
		';

	} elseif( 'shadow-right' == $layout ) {

		$output = '
			<section>
			    <div class="container">
			        <div class="row v-align-children">
			            <div class="col-md-4 col-sm-5 mb-xs-24">
			                '. do_shortcode($content) .'
			            </div>
			            <div class="col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-1 text-center">
			                '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'cast-shadow') ) .'
			            </div>
			        </div>
			    </div>
			</section>
		';

	} elseif( 'box-left' == $layout ) {

		$output = '
			<section class="image-square left">
			    <div class="col-md-6 image">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			        </div>
			    </div>
			    <div class="col-md-6 col-md-offset-1 content">
			        '. do_shortcode($content) .'
			    </div>
			</section>
		';

	} elseif( 'box-right' == $layout ) {

		$output = '
			<section class="image-square right">
			    <div class="col-md-6 image">
			        <div class="background-image-holder">
			            '. wp_get_attachment_image( $image, 'full', 0, array('class' => 'background-image') ) .'
			        </div>
			    </div>
			    <div class="col-md-6 content">
			        '. do_shortcode($content) .'
			    </div>
			</section>
		';

	}

	return $output;
}
add_shortcode( 'cl_content_image', 'calluna_content_image_shortcode' );