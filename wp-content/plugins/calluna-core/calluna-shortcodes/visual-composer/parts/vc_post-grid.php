<?php

// VC Post Grid ----------------------------------------------------------------- >
function calluna_core_vc_post_grid_shortcode() {
	vc_map( array(
		'name'        => esc_html__( 'Post Grid', 'calluna-shortcodes' ),
		'base'        => 'cl_posts_grid',
		'description' => esc_html__( 'Custom post type grid', 'calluna-shortcodes' ),
		'category'    => esc_html__( 'Calluna', 'calluna-shortcodes' ),
		'icon'        => 'calluna_vc_icon',
		'params'      => array(
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Unique Id', 'calluna-shortcodes' ),
				'param_name'	=> 'unique_id',
				'description'	=> esc_html__( 'You can enter a unique ID here for styling purposes.', 'calluna-shortcodes' ),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Post Type', 'calluna-shortcodes' ),
				'param_name'  => 'post_type',
				'value'       => calluna_core_shortcodes_get_post_types(),
			),
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Taxonomy', 'calluna-shortcodes' ),
				'param_name'  => 'taxonomy',
				'value'       => calluna_core_shortcodes_get_taxonomies(),
			),
			array(
				'type'			=> 'textfield',
				'admin_label'	=> true,
				'heading'		=> esc_html__( 'Term Slug', 'calluna-shortcodes' ),
				'param_name'	=> 'term_slug',
				'description'	=> esc_html__( 'Enter the Term slug to get your posts from. This term must be a part of the taxonomy above. You can find your slug on your taxonomy dashboard. For regular posts that would be the Categories page.', 'calluna-shortcodes' ),
			),
			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Post Count', 'calluna-shortcodes' ),
				'param_name'  => 'count',
				'value'       => '10',
				'description' => esc_html__( 'How many items do you wish to show.', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Pagination', 'calluna-shortcodes' ),
				'param_name'	=> 'pagination',
				'description'	=> esc_html__( 'Note: Pagination will not work on your homepage.', 'calluna-shortcodes' ),
				'value'			=> array(
					 esc_html__( 'No', 'calluna-shortcodes' ) => 'false',
					 esc_html__( 'Yes', 'calluna-shortcodes' )  => 'true',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Columns', 'calluna-shortcodes' ),
				'param_name'	=> 'columns',
				'std'           => '3',
				'value'			=> array(
					 esc_html__( '1', 'calluna-shortcodes' )	=> '1',
					 esc_html__( '2', 'calluna-shortcodes' )	=> '2',
					 esc_html__( '3', 'calluna-shortcodes' )	=> '3',
					 esc_html__( '4', 'calluna-shortcodes' )	=> '4',
					 esc_html__( '5', 'calluna-shortcodes' )	=> '5',
					 esc_html__( '6', 'calluna-shortcodes' )	=> '6',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Order', 'calluna-shortcodes' ),
				'param_name'	=> 'order',
				'description'	=> sprintf( wp_kses(__( 'Designates the ascending or descending order. More at %s.', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> array(
					 esc_html__( 'DESC', 'calluna-shortcodes' )	=> 'DESC',
					 esc_html__( 'ASC', 'calluna-shortcodes' )	=> 'ASC',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Order By', 'calluna-shortcodes' ),
				'param_name'	=> 'orderby',
				'description'	=> sprintf( wp_kses(__( 'Select how to sort retrieved posts. More at %s.', 'calluna-shortcodes' ), array(  'a' => array( 'href' => array(), 'target' => array() ) ) ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>' ),
				'value'			=> calluna_core_shortcodes_order_by_array(),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Thumbnail Link', 'calluna-shortcodes' ),
				'param_name'	=> 'thumbnail_link',
				'value'			=> array(
					 esc_html__( 'Post', 'calluna-shortcodes' )     => 'post',
					 esc_html__( 'None', 'calluna-shortcodes' )		=> 'none',
					 esc_html__( 'Lightbox', 'calluna-shortcodes' ) => 'lightbox',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Thumbnail Crop', 'calluna-shortcodes' ),
				'param_name'	=> 'img_crop',
				'value'			=> array(
					 esc_html__( 'Yes', 'calluna-shortcodes' )  => 'true',
					 esc_html__( 'No', 'calluna-shortcodes' ) => 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Thumbnail Width', 'calluna-shortcodes' ),
				'param_name'	=> 'img_width',
				'description'	=> esc_html__( 'Enter a width in pixels.', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Thumbnail Height', 'calluna-shortcodes' ),
				'param_name'	=> 'img_height',
				'description'	=> esc_html__( 'Enter a height in pixels. Set to "9999" to disable vertical cropping and keep image proportions.', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Display Title', 'calluna-shortcodes' ),
				'param_name'	=> 'title',
				'value'			=> array(
					 esc_html__( 'Yes', 'calluna-shortcodes' )  => 'true',
					 esc_html__( 'No', 'calluna-shortcodes' ) => 'false',
				),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Display Excerpt', 'calluna-shortcodes' ),
				'param_name'	=> 'excerpt',
				'value'			=> array(
					 esc_html__( 'Yes', 'calluna-shortcodes' )  => 'true',
					 esc_html__( 'No', 'calluna-shortcodes' ) => 'false',
				),
			),
			array(
				'type'			=> 'textfield',
				'heading'		=> esc_html__( 'Excerpt Length', 'calluna-shortcodes' ),
				'param_name'	=> 'excerpt_length',
				'value'			=> '30',
				'description'	=> esc_html__( 'How many words do you want to display for your excerpt?', 'calluna-shortcodes' ),
			),
			array(
				'type'			=> 'dropdown',
				'heading'		=> esc_html__( 'Read More Link?', 'calluna-shortcodes' ),
				'param_name'	=> 'read_more',
				'value'			=> array(
					 esc_html__( 'Yes', 'calluna-shortcodes' )  => 'true',
					 esc_html__( 'No', 'calluna-shortcodes' ) => 'false',
				),
			),	
		)
	) );
}
add_action( 'vc_before_init', 'calluna_core_vc_post_grid_shortcode' );

?>