<?php
/**
 * Defines the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    ASTM
 * @subpackage ASTM/includes
 * @author     Free WPTP <freewptp@gmail.com>
 */

if ( ! class_exists( 'ASTM_i18n' ) ) {

	class ASTM_i18n {

		/**
		 * Core singleton class
		 * @var self
		 */
		private static $_instance;

		/**
		 * Gets the instance of this class.
		 *
		 * @return self
		 */
		public static function getInstance() {
			if ( ! ( self::$_instance instanceof self ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Loads the plugin text domain for translation.
		 *
		 * @since    1.0.0
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'add-search-to-menu', false, dirname( dirname( plugin_basename( ASTM_PLUGIN_FILE ) ) ) . '/languages/' );
		}
	}
}
