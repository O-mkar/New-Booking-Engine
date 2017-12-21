<?php
/**
 * Event Post Type Configuration file
 */

// Set global var
global $calluna_core_event_config;

// The class
class Calluna_Core_Event_Config {
	private $label;

	public function __construct() {

		// Update vars
		$this->label = get_theme_mod( 'event_labels' );
		$this->label = $this->label ? $this->label : esc_html_x( 'Events', 'Event Post Type Label', 'calluna-td' );


		// Adds the event post type
		add_action( 'init', array( $this, 'calluna_core_register_post_type' ), 0 );

		// Adds the event taxonomies
		add_action( 'init', array( $this, 'calluna_core_register_tags' ), 5 );
		add_action( 'init', array( $this, 'calluna_core_register_categories' ), 10 );

		// Adds columns in the admin view for taxonomies
		add_filter( 'manage_edit-event_columns', array( $this, 'calluna_core_edit_columns' ) );
		add_action( 'manage_event_posts_custom_column', array( $this, 'calluna_core_column_display' ), 10, 2 );

		// Allows filtering of posts by taxonomy in the admin view
		add_action( 'restrict_manage_posts', array( $this, 'calluna_core_tax_filters' ) );

		// Create Editor for altering the post type arguments
		add_action( 'admin_menu', array( $this, 'calluna_core_add_page' ) );
		add_action( 'admin_init', array( $this,'calluna_core_register_page_options' ) );
		add_action( 'admin_notices', array( $this, 'calluna_core_notices' ) );

		// Adds the event custom sidebar
		add_filter( 'widgets_init', array( $this, 'calluna_core_register_sidebar' ), 10 );
		add_filter( 'calluna_core_get_sidebar', array( $this, 'calluna_core_display_sidebar' ), 11 );
		
	}
	
	/**
	 * Register post type.
	 */
	public function calluna_core_register_post_type() {

		// Get values and sanitize
		$name           = $this->label;
		$singular_name  = get_theme_mod( 'event_singular_name' );
		$singular_name  = $singular_name ? $singular_name : esc_html__( 'Event', 'calluna-td' );
		$slug           = get_theme_mod( 'event_slug' );
		$slug           = $slug ? $slug : 'event';
		$menu_icon      = get_theme_mod( 'event_admin_icon' );
		$menu_icon      = $menu_icon ? $menu_icon : 'cart';
		$event_search   = get_theme_mod( 'event_search', true );
		$event_search   = ! $event_search ? true : false;

		// Labels
		$labels = array(
			'name' => $name,
			'singular_name' => $singular_name,
			'add_new' => esc_html__( 'Add New', 'calluna-td' ),
			'add_new_item' => esc_html__( 'Add New Event', 'calluna-td' ),
			'edit_item' => esc_html__( 'Edit Event', 'calluna-td' ),
			'new_item' => esc_html__( 'Add New Event', 'calluna-td' ),
			'view_item' => esc_html__( 'View Event', 'calluna-td' ),
			'search_items' => esc_html__( 'Search Events', 'calluna-td' ),
			'not_found' => esc_html__( 'No Events Found', 'calluna-td' ),
			'not_found_in_trash' => esc_html__( 'No Events Found In Trash', 'calluna-td' )
		);

		// Args
		$args = array(
			'labels' => $labels,
			'public' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'excerpt'
			),
			'capability_type' => 'post',
			'rewrite' => array(
				'slug' => $slug,
			),
			'has_archive' => false,
			'menu_icon' => 'dashicons-'. $menu_icon,
			'menu_position' => 20,
			'exclude_from_search' => $event_search,
		);

		// Apply filters
		$args = apply_filters( 'calluna_core_event_args', $args );

		// Register the post type
		register_post_type( 'event', $args );
		
		//add_filter( 'single_template', array( $this, 'calluna_core_register_event_template' ), 15 );

	}
	
	public function calluna_core_register_event_template($single_template) {
		global $post;

		if ($post->post_type == 'event') {
			$single_template = dirname( __FILE__ ) . '/single-event.php';
		}
		return $single_template;	
	}

	/**
	 * Register Event tags.
	 */
	public function calluna_core_register_tags() {

		// Define and sanitize options
		$name = get_theme_mod( 'event_tag_labels');
		$name = $name ? $name : esc_html__( 'Event Tags', 'calluna-td' );
		$slug = get_theme_mod( 'event_tag_slug' );
		$slug = $slug ? $slug : 'event-tag';

		// Define event tag labels
		$labels = array(
			'name' => $name,
			'singular_name' => $name,
			'menu_name' => $name,
			'search_items' => esc_html__( 'Search Event Tags', 'calluna-td' ),
			'popular_items' => esc_html__( 'Popular Event Tags', 'calluna-td' ),
			'all_items' => esc_html__( 'All Event Tags', 'calluna-td' ),
			'parent_item' => esc_html__( 'Parent Event Tag', 'calluna-td' ),
			'parent_item_colon' => esc_html__( 'Parent Event Tag:', 'calluna-td' ),
			'edit_item' => esc_html__( 'Edit Event Tag', 'calluna-td' ),
			'update_item' => esc_html__( 'Update Event Tag', 'calluna-td' ),
			'add_new_item' => esc_html__( 'Add New Event Tag', 'calluna-td' ),
			'new_item_name' => esc_html__( 'New Event Tag Name', 'calluna-td' ),
			'separate_items_with_commas' => esc_html__( 'Separate event tags with commas', 'calluna-td' ),
			'add_or_remove_items' => esc_html__( 'Add or remove event tags', 'calluna-td' ),
			'choose_from_most_used' => esc_html__( 'Choose from the most used event tags', 'calluna-td' ),
		);

		// Define event tag arguments
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => false,
			'rewrite' => array(
				'slug' => $slug,
			),
			'query_var' => true
		);

		// Apply filters for child theming
		$args = apply_filters( 'calluna_core_taxonomy_event_tag_args', $args );

		// Register the event tag taxonomy
		register_taxonomy( 'event_tag', array( 'event' ), $args );

	}

	/**
	 * Register Event category.
	 */
	public function calluna_core_register_categories() {

		// Define and sanitize options
		$name = get_theme_mod( 'event_cat_labels');
		$name = $name ? $name : esc_html__( 'Event Categories', 'calluna-td' );
		$slug = get_theme_mod( 'event_cat_slug' );
		$slug = $slug ? $slug : 'event-category';

		// Define event category labels
		$labels = array(
			'name' => $name,
			'singular_name' => $name,
			'menu_name' => $name,
			'search_items' => esc_html__( 'Search','calluna-td' ),
			'popular_items' => esc_html__( 'Popular', 'calluna-td' ),
			'all_items' => esc_html__( 'All', 'calluna-td' ),
			'parent_item' => esc_html__( 'Parent', 'calluna-td' ),
			'parent_item_colon' => esc_html__( 'Parent', 'calluna-td' ),
			'edit_item' => esc_html__( 'Edit', 'calluna-td' ),
			'update_item' => esc_html__( 'Update', 'calluna-td' ),
			'add_new_item' => esc_html__( 'Add New', 'calluna-td' ),
			'new_item_name' => esc_html__( 'New', 'calluna-td' ),
			'separate_items_with_commas' => esc_html__( 'Separate with commas', 'calluna-td' ),
			'add_or_remove_items' => esc_html__( 'Add or remove', 'calluna-td' ),
			'choose_from_most_used' => esc_html__( 'Choose from the most used', 'calluna-td' ),
		);

		// Define event category arguments
		$args = array(
			'labels' => $labels,
			'public' => true,
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical' => true,
			'rewrite' => array(
				'slug'  => $slug
			),
			'query_var' => true
		);

		// Apply filters for child theming
		$args = apply_filters( 'calluna_core_taxonomy_event_category_args', $args );

		// Register the event category taxonomy
		register_taxonomy( 'event_category', array( 'event' ), $args );

	}


	/**
	 * Adds columns to the WP dashboard edit screen.
	 */
	public static function calluna_core_edit_columns( $columns ) {
		$columns['event_date'] 		= esc_html__( 'Event Date', 'calluna-td' );
		$columns['event_time']      = esc_html__( 'Event Time', 'calluna-td' );
		$columns['event_category'] 	= esc_html__( 'Category', 'calluna-td' );
		$columns['event_tag']      	= esc_html__( 'Tags', 'calluna-td' );
		return $columns;
	}
	

	/**
	 * Adds columns to the WP dashboard edit screen.
	 */
	public static function calluna_core_column_display( $column, $post_id ) {

		switch ( $column ) :
			
			// Display the event date in the column view
			case 'event_date':

				echo date('Y/m/d', strtotime(get_post_meta($post_id, '_calluna_event_date', TRUE)));

			break;
			// Display the event time in the column view
			case 'event_time':

				echo date('g:i a', strtotime(get_post_meta($post_id, '_calluna_event_time', TRUE)));

			break;
			// Display the event categories in the column view
			case 'event_category':

				if ( $category_list = get_the_term_list( $post_id, 'event_category', '', ', ', '' ) ) {
					echo $category_list;
				} else {
					echo '&mdash;';
				}

			break;

			// Display the event tags in the column view
			case 'event_tag':

				if ( $tag_list = get_the_term_list( $post_id, 'event_tag', '', ', ', '' ) ) {
					echo $tag_list;
				} else {
					echo '&mdash;';
				}

			break;

		endswitch;

	}

	/**
	 * Adds taxonomy filters to the event admin page.
	 */
	public static function calluna_core_tax_filters() {
		global $typenow;

		// An array of all the taxonomyies you want to display. Use the taxonomy name or slug
		$taxonomies = array( 'event_category', 'event_tag' );

		// must set this to the post type you want the filter(s) displayed on
		if ( 'event' == $typenow ) {

			foreach ( $taxonomies as $tax_slug ) {
				$current_tax_slug = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
				$tax_obj = get_taxonomy( $tax_slug );
				$tax_name = $tax_obj->labels->name;
				$terms = get_terms($tax_slug);
				if ( count( $terms ) > 0) {
					echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
					echo "<option value=''>$tax_name</option>";
					foreach ( $terms as $term ) {
						echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
					}
					echo "</select>";
				}
			}
		}
	}

	/**
	 * Add sub menu page for the Event Editor.
	 */
	public function calluna_core_add_page() {
		add_submenu_page(
			'edit.php?post_type=event',
			esc_html__( 'Post Type Editor', 'calluna-td' ),
			esc_html__( 'Post Type Editor', 'calluna-td' ),
			'administrator',
			'caluna-event-editor',
			array( $this, 'calluna_core_create_admin_page' )
		);
	}

	/**
	 * Function that will register the event editor admin page.
	 */
	public function calluna_core_register_page_options() {
		register_setting( 'calluna_core_event_options', 'calluna_core_event_branding', array( $this, 'calluna_core_sanitize' ) );
	}

	/**
	 * Displays saved message after settings are successfully saved.
	 */
	public static function calluna_core_notices() {
		settings_errors( 'calluna_core_event_editor_page_notices' );
	}

	/**
	 * Sanitizes input and saves theme_mods.
	 */
	public static function calluna_core_sanitize( $options ) {

		// Save values to theme mod
		if ( ! empty ( $options ) ) {
			foreach( $options as $key => $value ) {
				if ( $value ) {
					set_theme_mod( $key, $value );
				} else {
					remove_theme_mod( $key );
				}
			}
		}

		// Add notice
		add_settings_error(
			'calluna_core_event_editor_page_notices',
			esc_attr( 'settings_updated' ),
			esc_html__( 'Settings saved.', 'calluna-td' ),
			'updated'
		);

		// Lets delete the options as we are saving them into theme mods
		$options = '';
		return $options;
	}

	/**
	 * Output for the actual Event Editor admin page.
	 */
	public function calluna_core_create_admin_page() { ?>
		<div class="wrap">
			<h2><?php esc_html_e( 'Post Type Editor', 'calluna-td' ); ?></h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'calluna_core_event_options' ); ?>
				<p><?php esc_html_e( 'If you change any slug\'s you must reset your permalinks to prevent 404 errors.', 'calluna-td' ); ?></p>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Admin Icon', 'calluna-td' ); ?></th>
						<td>
							<?php
							// Dashicons select
							$dashicons = array('admin-appearance','admin-collapse','admin-comments','admin-generic','admin-home','admin-media','admin-network','admin-page','admin-plugins','admin-settings','admin-site','admin-tools','admin-users','align-center','align-left','align-none','align-right','analytics','arrow-down','arrow-down-alt','arrow-down-alt2','arrow-left','arrow-left-alt','arrow-left-alt2','arrow-right','arrow-right-alt','arrow-right-alt2','arrow-up','arrow-up-alt','arrow-up-alt2','art','awards','backup','book','book-alt','businessman','calendar','camera','cart','category','chart-area','chart-bar','chart-line','chart-pie','clock','cloud','dashboard','desktop','dismiss','download','edit','editor-aligncenter','editor-alignleft','editor-alignright','editor-bold','editor-customchar','editor-distractionfree','editor-help','editor-indent','editor-insertmore','editor-italic','editor-justify','editor-kitchensink','editor-ol','editor-outdent','editor-paste-text','editor-paste-word','editor-quote','editor-removeformatting','editor-rtl','editor-spellcheck','editor-strikethrough','editor-textcolor','editor-ul','editor-underline','editor-unlink','editor-video','email','email-alt','exerpt-view','facebook','facebook-alt','feedback','flag','format-aside','format-audio','format-chat','format-gallery','format-image','format-links','format-quote','format-standard','format-status','format-video','forms','googleplus','groups','hammer','id','id-alt','image-crop','image-flip-horizontal','image-flip-vertical','image-rotate-left','image-rotate-right','images-alt','images-alt2','info','leftright','lightbulb','list-view','location','location-alt','lock','marker','menu','migrate','minus','networking','no','no-alt','performance','plus','service','post-status','pressthis','products','redo','rss','screenoptions','search','share','share-alt','share-alt2','share1','shield','shield-alt','slides','smartphone','smiley','sort','sos','star-empty','star-filled','star-half','tablet','tag','testimonial','translation','trash','twitter','undo','update','upload','vault','video-alt','video-alt2','video-alt3','visibility','welcome-add-page','welcome-comments','welcome-edit-page','welcome-learn-more','welcome-view-site','welcome-widgets-menus','wordpress','wordpress-alt','yes');
							$dashicons = array_combine( $dashicons, $dashicons ); ?>
							<select name="calluna_core_event_branding[event_admin_icon]">
								<option value=""><?php esc_html_e( 'Default', 'calluna-td' ); ?></option>
								<?php foreach ( $dashicons as $dashicon ) { ?>
									<option value="<?php echo esc_attr($dashicon); ?>" <?php selected( get_theme_mod( 'event_admin_icon' ), $dashicon, true ); ?>><?php echo esc_html($dashicon); ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Name', 'calluna-td' ); ?></th>
						<td><input type="text" name="calluna_core_event_branding[event_labels]" value="<?php echo get_theme_mod( 'event_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Singular Name', 'calluna-td' ); ?></th>
						<td><input type="text" name="calluna_core_event_branding[event_singular_name]" value="<?php echo get_theme_mod( 'event_singular_name' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Post Type: Slug', 'calluna-td' ); ?></th>
						<td><input type="text" name="calluna_core_event_branding[event_slug]" value="<?php echo get_theme_mod( 'event_slug' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Tags: Label', 'calluna-td' ); ?></th>
						<td><input type="text" name="calluna_core_event_branding[event_tag_labels]" value="<?php echo get_theme_mod( 'event_tag_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Tags: Slug', 'calluna-td' ); ?></th>
						<td><input type="text" name="calluna_core_event_branding[event_tag_slug]" value="<?php echo get_theme_mod( 'event_tag_slug' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Categories: Label', 'calluna-td' ); ?></th>
						<td><input type="text" name="calluna_core_event_branding[event_cat_labels]" value="<?php echo get_theme_mod( 'event_cat_labels' ); ?>" /></td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php esc_html_e( 'Categories: Slug', 'calluna-td' ); ?></th>
						<td><input type="text" name="calluna_core_event_branding[event_cat_slug]" value="<?php echo get_theme_mod( 'event_cat_slug' ); ?>" /></td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
	<?php }

	/**
	 * Registers a new custom event sidebar.
	 */
	public static function calluna_core_register_sidebar() {


		// Return if custom sidebar is disabled
		if ( ! get_theme_mod( 'event_custom_sidebar', true ) ) {
			return;
		}

		// Get post type object to name sidebar correctly
		$obj            = get_post_type_object( 'event' );
		$post_type_name = $obj->labels->name;

		// Register team_sidebar
		register_sidebar( array (
			'name'          => $post_type_name .' '. esc_html__( 'Sidebar', 'calluna-td' ),
			'id'            => 'sidebar-event',
			'before_widget' => '<aside id="%1$s" class="sidebar event widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h5 class="title">',
            'after_title' => '</h5>',
		) );
	}

	/**
	 * Alter main sidebar to display event sidebar.
	 */
	public static function calluna_core_display_sidebar( $sidebar ) {
		if ( get_theme_mod( 'event_custom_sidebar', true ) && ( is_singular( 'event' ) || calluna_core_is_event_tax() ) ) {
			$sidebar = 'event_sidebar';
		}
		return $sidebar;
	}
}
$calluna_core_event_config = new Calluna_Core_Event_Config;