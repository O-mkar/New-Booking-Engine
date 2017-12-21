<?php

// Icon Box -------------------------------------------------------------------------- >
function calluna_icon_box_shortcode( $atts, $content = NULL ) {
        extract( shortcode_atts( array(
            'unique_id'                 => '',
            'font_size'                 => '',
            'background'                => '',
            'font_color'                => '',
            'border_radius'             => '',
            'style'                     => 'one',
            'image'                     => '',
            'image_width'               => '',
            'icon'                      => '',
            'icon_color'                => '',
            'icon_width'                => '',
            'icon_height'               => '',
            'icon_alternative_classes'  => '',
            'icon_size'                 => '',
            'icon_background'           => '',
            'icon_border_radius'        => '',
            'icon_bottom_margin'        => '',
            'heading'                   => '',
            'heading_type'              => 'h2',
            'heading_color'             => '',
            'heading_size'              => '',
            'heading_weight'            => '',
            'heading_letter_spacing'    => '',
            'heading_transform'         => '',
            'heading_bottom_margin'     => '',
            'container_left_padding'    => '',
            'container_right_padding'   => '',
            'url'                       => '',
            'url_target'                => '',
            'url_rel'                   => '',
            'css_animation'             => '',
            'padding'                   => '',
            'margin_bottom'             => '',
            'el_class'                  => '',
            'alignment'                 => '',
            'background'                => '',
            'background_image'          => '',
            'background_image_style'    => 'strech',
            'border_color'              => '',
        ), $atts ) );

        // Turn output buffer on
        ob_start();
    
        // Set default vars
        $output = $container_background = '';

        // Seperate icons into a couple groups for styling/html purposes
        $standard_boxes = array( 'one', 'two', 'three', 'seven' );
        $clickable_boxes = array( 'four', 'five', 'six' ); 

        // Main Classes
        $add_classes = 'calluna-icon-box clr calluna-icon-box-'. $style;
        if ( $css_animation ) {
            $css_animation_class = 'wpb_animate_when_almost_visible wpb_'. $css_animation .'';
            $add_classes .= ' '. $css_animation_class;
        }
        if ( $url ) {
            $add_classes .= ' calluna-icon-box-with-link';
        }
        if ( $el_class ) {
            $add_classes .= ' '. $el_class;
        }
        if ( $alignment ) {
            $add_classes .= ' align-'. $alignment;
        } else {
            $add_classes .= ' align-center';
        }
        if ( $icon_background ) {
            $add_classes .= ' with-background';
        }
        
        // Container Style
        $inline_style = '';
        if ( $border_radius && in_array( $style, array( 'four', 'five', 'six' ) ) ) {
            $inline_style .= 'border-radius:'. $border_radius .';';
        }
        if ( $font_size ) {
            $inline_style .= 'font-size:'. intval( $font_size ).'px;';
        }
        if ( $font_color ) {
            $inline_style .= 'color:'. $font_color .';';
        }
        if ( 'four' == $style && $border_color ) {
            $inline_style .= 'border-color:'. $border_color .';';
        }
        if ( 'six' == $style && $icon_background && '' === $background ) {
            $inline_style .= 'background-color:'. $icon_background .';';
        }
        if ( $background && in_array( $style, $clickable_boxes ) ) {
            $inline_style .= 'background-color:'. $background .';';
        }
        if ( $background_image && in_array( $style, $clickable_boxes ) ) {
            $background_image = wp_get_attachment_url( $background_image );
            $inline_style .= 'background-image:url('. $background_image .');';
            $add_classes .= ' calluna-background-'. $background_image_style;
        }
        if ( 'six' == $style && $icon_color ) {
            $inline_style .= 'color:'. $icon_color .';';
        }
        if ( 'one' == $style && $container_left_padding ) {
            $inline_style .= 'padding-left:'. intval( $container_left_padding ) .'px;';
        }
        if ( 'seven' == $style && $container_right_padding ) {
            $inline_style .= 'padding-right:'. intval( $container_right_padding ) .'px;';
        }
        if ( $margin_bottom ) {
            $inline_style .= 'margin-bottom:'. intval( $margin_bottom ) .'px;';
        }
        if ( $padding && in_array( $style, array( 'four', 'five', 'six' ) ) ) {
            $inline_style .= 'padding:'. $padding .'';
        }
        if ( '' != $inline_style ) {
            $inline_style = ' style="' . $inline_style . '"';
        } ?>

        <div class="<?php echo $add_classes ?>"<?php echo $inline_style ?>>
            <?php
            /*** URL ***/
            if ( $url ) {
                // Link classes
                $add_classes = 'calluna-icon-box-'. $style .'-link';
                //Link Style
                $inline_style = '';
                if ( 'six' == $style ) {
                    $inline_style .= 'color:'. $icon_color .'';
                }
                if ( '' != $inline_style ) {
                    $inline_style = ' style="' . esc_attr( $inline_style ) . '"';
                }
                // Link target
                if ( 'local' == $url_target ) {
                    $url_target = '';
                    $add_classes .= ' local-scroll-link';
                } elseif ( '_blank' == $url_target ) {
                    $url_target = 'target="_blank"';
                } else {
                    $url_target = '';
                }
                if ( $url_rel ) {
                    $url_rel = ' rel="'. $url_rel .'"';
                } ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr($heading); ?>" class="<?php echo $add_classes ?>" <?php echo esc_attr($url_target); ?> <?php echo esc_attr($url_rel); ?><?php echo $inline_style ?>>
            <?php }
            /*** Image ***/
            if ( $image ){
                $image_url = wp_get_attachment_url( $image );
                if ( $image_width ) {
                    $image_width = 'style="width:'. intval( $image_width ) .'px;"';
                } ?>
                <img class="calluna-icon-box-<?php echo esc_attr($style); ?>-img-alt" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($heading); ?>" <?php echo $image_width; ?> />
            <?php
            }
            /*** Icon ***/
            elseif ( $icon ) {
                // Icon Style
                $inline_style = '';
                if( $icon_bottom_margin && in_array( $style, array( 'two', 'three', 'four', 'five', 'six' ) ) ) {
                    $inline_style .= 'margin-bottom:' . intval( $icon_bottom_margin ) .'px;';
                }
                if ( $icon_color ) {
                    $inline_style .= 'color:' . $icon_color . ';';
                }
                if ( $icon_width ) {
                    $inline_style .= 'width:'. intval( $icon_width ) .'px;';
                }
                if ( $icon_height ) {
                    $inline_style .= 'height:'.  intval( $icon_height ) .'px;line-height:'.  intval( $icon_height ) .'px;';
                }
                if ( $icon_size ) {
                    $inline_style .= 'font-size:' . intval( $icon_size ) . 'px;';
                }
                if ( $icon_border_radius ) {
                    $inline_style .= 'border-radius:' . $icon_border_radius . ';';
                }
                if ( $icon_background ) {
                    $inline_style .= 'background-color: ' . $icon_background . ';';
                }
                if ( '' != $inline_style ) {
                    $inline_style = ' style="' . $inline_style . '"';
                }
                // Icon Classes
                $add_classes = 'calluna-icon-box-'. $style .'-icon calluna-icon-box-icon';
                if ( $icon_background ) {
                    $add_classes .= ' calluna-icon-box-icon-with-bg';
                }
                if ( $icon_width || $icon_height ) {
                    $add_classes .= ' no-padding';
                } ?>
                <div class="<?php echo $add_classes ?>" <?php echo $inline_style ?>>
                    <?php
                    // Custom icon
                    if ( '' != $icon_alternative_classes ) { ?>
                        <span class="<?php echo $icon_alternative_classes ?>"></span>
                    <?php } else { ?>
                        <span class="fa fa-<?php echo esc_attr($icon); ?>"></span>
                    <?php } ?>
                </div>
            <?php }
            /** Heading ***/
            if ( $heading ) {
                // Heading Classes
                $add_classes ='';
                if ( $heading_weight ) {
                    $add_classes .= 'font-weight-'. $heading_weight . ' ';
                }
                if ( $heading_transform ) {
                    $add_classes .= 'text-transform-'. $heading_transform;
                }
                // Heading Style
                $inline_style = '';
                if ( '' != $heading_color ) {
                    $inline_style .= 'color:'. $heading_color .';';
                }
                if ( '' != $heading_size ) {
                    $heading_size = intval( $heading_size );
                    $inline_style .= 'font-size:'. $heading_size .'px;';
                }
                if ( '' != $heading_letter_spacing ) {
                    $inline_style .= 'letter-spacing:'. $heading_letter_spacing .';';
                }
                if ( $heading_bottom_margin ) {
                    $inline_style .= 'margin-bottom:'. intval( $heading_bottom_margin ) .'px;';
                }
                if ( '' != $inline_style ) {
                    $inline_style = ' style=' . $inline_style . '';
                } ?>
                <<?php echo esc_attr($heading_type); ?> class="calluna-icon-box-<?php echo esc_attr($style); ?>-heading <?php echo $add_classes ?>"<?php echo $inline_style ?>>
                    <?php echo esc_attr($heading); ?>
                </<?php echo esc_attr($heading_type); ?>>
            <?php
            }
            // Close link
            if ( $url && in_array( $style, $standard_boxes ) ) { ?>
                </a>
            <?php }
            // Display if content isn't empty
            if ( $content ) { ?>
                <div class="calluna-icon-box-<?php echo esc_attr($style); ?>-content clr">
                    <?php echo apply_filters( 'the_content', $content ); ?>
                </div>
            <?php }
            // Close link
            if ( $url && in_array( $style, $clickable_boxes ) ) { ?>
                </a>
            <?php } ?>
        </div>
        
        <?php
        // Return outbut buffer
        return ob_get_clean();
    }
add_shortcode( 'cl_icon_box', 'calluna_icon_box_shortcode' );