<?php
// Prevent loading this file directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Group' ) ) {
	/**
	 * Extension main class.
	 */
	class RWMB_Group {
		/**
		 * Indicate that the meta box is saved or not.
		 * This variable is used inside group field to show child fields.
		 *
		 * @var bool
		 */
		public static $saved = false;

		/**
		 * Add hooks to meta box.
		 */
		public function init() {
			// Hook to 'init' with priority 5 to make sure all actions are registered before Meta Box 4.9.0 runs.
			add_action( 'init', array( $this, 'load_files' ), 5 );

			add_action( 'rwmb_before', array( $this, 'set_saved' ) );
			add_action( 'rwmb_after', array( $this, 'unset_saved' ) );
		}

		/**
		 * Load field group class.
		 */
		public function load_files() {
			if ( class_exists( 'RWMB_Field' ) && ! class_exists( 'RWMB_Group_Field' ) ) {
				require_once dirname( __FILE__ ) . '/class-rwmb-group-field.php';
			}
		}

		/**
		 * Check if current meta box is saved.
		 * This variable is used inside group field to show child fields.
		 *
		 * @param object $obj Meta Box object.
		 */
		public function set_saved( $obj ) {
			self::$saved = $obj->is_saved();
		}

		/**
		 * Unset 'saved' variable, to be ready for next meta box.
		 */
		public function unset_saved() {
			self::$saved = false;
		}
	}

	$group = new RWMB_Group;
	$group->init();
}
