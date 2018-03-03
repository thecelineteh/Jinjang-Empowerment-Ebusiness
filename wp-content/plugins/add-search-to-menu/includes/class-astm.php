<?php
/**
 * The class is the core plugin responsible for including and
 * instantiating all of the code that composes the plugin.
 *
 * The class includes an instance to the plugin
 * Loader which is responsible for coordinating the hooks that exist within the
 * plugin.
 *
 * @since    1.0.0
 * @package ASTM
 */

if ( ! class_exists( 'ASTM_Loader' ) ) {

	class ASTM_Loader {

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
		 * Instantiates the plugin by setting up the core properties and loading
		 * all necessary dependencies and defining the hooks.
		 *
		 * The constructor uses internal functions to import all the
		 * plugin dependencies, and will leverage the Add_Search_To_Menu for
		 * registering the hooks and the callback functions used throughout the plugin.
		 */
		public function __construct( $astm = null ) {
			$this->opt = ( null !== $astm ) ? $astm->opt : get_option( 'add_search_to_menu' );
			$this->set_locale();

			if ( is_admin() ) {
				$this->admin_hooks();
			} else {
				$this->public_hooks();
			}
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
		 * Defines the locale for this plugin for internationalization.
		 *
		 * Uses the ASTM_i18n class in order to set the domain and to register the hook
		 * with WordPress.
		 *
		 * @since    1.0.0
		 * @access   private
		 */
		private function set_locale() {
			$astm_i18n = ASTM_i18n::getInstance();
			add_action( 'plugins_loaded', array( $astm_i18n, 'load_plugin_textdomain' ) );
		}

		/**
		 * Defines the hooks and callback functions that are used for setting up the plugin's admin options.
		 *
		 * @access    private
		 */
		private function admin_hooks() {
			$admin = ASTM_Admin::getInstance();

			if ( ! isset( $this->opt['dismiss_admin_notices'] ) || ! $this->opt['dismiss_admin_notices'] ) {
				add_action( 'all_admin_notices', array( $admin, 'setup_notice' ) );
			}

			add_action( 'plugin_action_links', array( $admin, 'plugin_settings_link' ), 10, 2 );
			add_action( 'admin_menu', array( $admin, 'admin_menu_setup' ) );
			add_action( 'wp_ajax_nopriv_dismiss_notice', array( $admin, 'dismiss_notice' ) );
			add_action( 'wp_ajax_dismiss_notice', array( $admin, 'dismiss_notice' ) );
			add_action( 'admin_enqueue_scripts', array( $admin, 'admin_script_style' ) );
			add_action( 'admin_init', array( $admin, 'settings_init' ) );
		}

		/**
		 * Defines the hooks and callback functions that are used for executing plugin functionality
		 * in the front end of site.
		 *
		 * @access    private
		 */
		private function public_hooks() {
			$public = ASTM_Public::getInstance();
			add_action( 'wp_enqueue_scripts', array( $public, 'enqueue_script_style' ) );

			$display_in_header = isset( $this->opt['add_search_to_menu_display_in_header'] ) ? $this->opt['add_search_to_menu_display_in_header'] : 0;
			$site_cache = isset( $this->opt['astm_site_uses_cache'] ) ? $this->opt['astm_site_uses_cache'] : 0;
			$display_in_mobile_menu = $display_in_header && wp_is_mobile() ? true : false;

			if ( $display_in_mobile_menu || $site_cache ) {
				add_filter( 'wp_head', array( $public, 'search_in_header' ), 99 );
			}

			if ( ! $display_in_mobile_menu || $site_cache ) {
				add_filter( 'wp_nav_menu_items', array( $public, 'search_menu_item' ), 99, 2 );
			}

			if ( isset( $this->opt['add_search_to_menu_posts'] ) && ( ! isset( $this->opt['add_search_to_menu_gcse'] ) || '' == $this->opt['add_search_to_menu_gcse'] ) ) {
				add_action( 'pre_get_posts', array( $public, 'search_filter' ) );
			}

			add_action( 'wp_footer', array( $public, 'custom_css' ) );
		}
	}
}
