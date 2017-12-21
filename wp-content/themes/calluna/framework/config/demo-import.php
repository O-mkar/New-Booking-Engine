<?php
function calluna_demo_import_files() {
	return array(
		array(
			'import_file_name'             => 'Calluna Demo Import',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'samples/calluna-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'samples/calluna-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'samples/calluna-settings.dat',
			'import_preview_image_url'     => 'http://ttdemo.wpengine.com/wp-content/uploads/2015/12/screenshot_luxury.jpg',
		),
		array(
			'import_file_name'             => 'Cityhotel Demo Import',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'samples/cityhotel-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'samples/cityhotel-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'samples/cityhotel-settings.dat',
			'import_preview_image_url'     => 'http://ttdemo.wpengine.com/wp-content/uploads/2015/12/screenshot_city.jpg',
		),
		array(
			'import_file_name'             => 'Snowvalley Demo Import',
			'local_import_file'            => trailingslashit( get_template_directory() ) . 'samples/snowvalley-content.xml',
			'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'samples/snowvalley-widgets.wie',
			'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'samples/snowvalley-settings.dat',
			'import_preview_image_url'     => 'http://ttdemo.wpengine.com/wp-content/uploads/2015/12/screenshot_snowvalley.jpg',
		)
	);
}
add_filter( 'pt-ocdi/import_files', 'calluna_demo_import_files' );

function calluna_after_demo_import_setup($selected_import) {
	
	// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main', 'nav_menu' );
		$mobile_menu = get_term_by( 'name', 'Footer', 'nav_menu' );
	
		set_theme_mod( 'nav_menu_locations', array(
				'main_menu'         => $main_menu->term_id,
				'responsive_menu'   => $mobile_menu->term_id
			)
		);
	
		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Homepage 1' );
		$blog_page_id  = get_page_by_title( 'Blog' );
	
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );
		update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'calluna_after_demo_import_setup' );