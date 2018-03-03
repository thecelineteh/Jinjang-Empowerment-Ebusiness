<?php
/**
 * Fires during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    ASTM
 * @subpackage ASTM/includes
 * @author     Free WPTP <freewptp@gmail.com>
 */

if ( ! class_exists( 'ASTM_Deactivator' ) ) {

	class ASTM_Deactivator {

		/**
		 * The code that runs during plugin deactivation.
		 *
		 * @since    1.0.0
		 */
		public static function deactivate() {
			$opt = get_option( 'add_search_to_menu' );

			if ( isset( $opt['dismiss_admin_notices'] ) ) {
				unset( $opt['dismiss_admin_notices'] );
				update_option( 'add_search_to_menu', $opt );
			}
		}
	}
}
