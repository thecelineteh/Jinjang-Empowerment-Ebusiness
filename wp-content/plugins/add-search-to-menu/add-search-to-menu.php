<?php
/**
 * Plugin Name: Add Search To Menu
 * Plugin URI:  http://freewptp.com/plugins/add-search-to-menu/
 * Description: The plugin displays search form in the navigation bar which can be configured from the admin area.
 * Version:     3.4
 * Author:      Vinod Dalvi
 * Author URI:  http://freewptp.com
 * License:     GPL2+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 * Text Domain: add-search-to-menu
 *
 *
 * Add Search To Menu is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Add Search To Menu is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Add Search To Menu. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */


/**
 * Includes necessary dependencies and starts the plugin.
 *
 * @package ASTM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exits if accessed directly.
}

if ( ! class_exists( 'Add_Search_To_Menu' ) ) {

	/**
	 * Main Add Search To Menu Class.
	 *
	 * @class Add_Search_To_Menu
	 */
	final class Add_Search_To_Menu {

		/**
		 * Stores plugin options.
		 */
		public $opt;

		/**
		 * Core singleton class
		 * @var self
		 */
		private static $_instance;

		/**
		 * Add Search To Menu Constructor.
		 */
		public function __construct() {
			$this->opt = get_option( 'add_search_to_menu' );
			$this->define_constants();
			$this->includes();
			$this->init_hooks();
		}

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
		 * Defines Add Search To Menu Constants.
		 */
		private function define_constants() {
			define( 'ASTM_VERSION', '3.2' );
			define( 'ASTM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
			define( 'ASTM_PLUGIN_FILE', __FILE__ );
		}

		/**
		 * Includes required core files used in admin and on the frontend.
		 */
		public function includes() {
			require_once ASTM_PLUGIN_DIR . 'includes/class-astm-activator.php';
			require_once ASTM_PLUGIN_DIR . 'includes/class-astm-deactivator.php';
			require_once ASTM_PLUGIN_DIR . 'includes/class-astm-i18n.php';

			if ( is_admin() ) {
				require_once ASTM_PLUGIN_DIR . 'admin/class-astm-admin.php';
			} else {
				require_once ASTM_PLUGIN_DIR . 'public/class-astm-public.php';
			}

			require_once ASTM_PLUGIN_DIR . 'includes/class-astm.php';
		}

		/**
		 * Hooks into actions and filters.
		 */
		private function init_hooks() {
			// Executes necessary actions on plugin activation and deactivation.
			register_activation_hook( ASTM_PLUGIN_FILE, array( 'ASTM_Activator', 'activate' ) );
			register_deactivation_hook( ASTM_PLUGIN_FILE, array( 'ASTM_Deactivator', 'deactivate' ) );
		}
	}
}

/**
 * Starts plugin execution.
 */
$astm = Add_Search_To_Menu::getInstance();
new ASTM_Loader( $astm );
