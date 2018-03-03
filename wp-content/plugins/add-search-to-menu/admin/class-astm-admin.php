<?php
/**
 * The class defines all functionality for the dashboard of the plugin.
 *
 * @package ASTM
 * @since    1.0.0
 */

if ( ! class_exists( 'ASTM_Admin' ) ) {

	class ASTM_Admin {

		/**
		 * Stores plugin options.
		 */
		public $opt;

		/**
		 * Stores network activation status.
		 */
		private $networkactive;

		/**
		 * Core singleton class
		 * @var self
		 */
		private static $_instance;

		/**
		 * Initializes this class.
		 *
		 */
		public function __construct() {
			$astm = Add_Search_To_Menu::getInstance();
			$this->opt = ( null !== $astm ) ? $astm->opt : get_option( 'add_search_to_menu' );
			$this->networkactive = ( is_multisite() && array_key_exists( plugin_basename( ASTM_PLUGIN_FILE ), (array) get_site_option( 'active_sitewide_plugins' ) ) );
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
		 * Loads plugin javascript and stylesheet files in the admin area.
		 */
		function admin_script_style(){
			wp_register_script( 'add-search-to-menu-scripts', plugins_url( '/admin/js/add-search-to-menu-admin.js', ASTM_PLUGIN_FILE ), array( 'jquery' ), ASTM_VERSION, true  );
			wp_localize_script( 'add-search-to-menu-scripts', 'add_search_to_menu', array(
				'ajax_url' => admin_url( 'admin-ajax.php' )
			) );
			wp_enqueue_script( 'add-search-to-menu-scripts' );
		}

		/**
		 * Adds a link to the settings page in the plugins list.
		 *
		 * @param array  $links array of links for the plugins, adapted when the current plugin is found.
		 * @param string $file  the filename for the current plugin, which the filter loops through.
		 *
		 * @return array $links
		 */
		function plugin_settings_link( $links, $file ) {
			if ( false !== strpos( $file, 'add-search-to-menu' ) ) {
				$mylinks = array(
					'<a href="http://freewptp.com/forum/wordpress-plugins-forum/add-search-to-menu/">' . esc_html__( 'Get Support', 'add-search-to-menu' ) . '</a>',
					'<a href="options-general.php?page=add_search_to_menu">' . esc_html__( 'Settings', 'add-search-to-menu' ) . '</a>'
				);
				$links = array_merge( $mylinks, $links );
			}
			return $links;
		}

		/**
		 * Displays plugin configuration notice in admin area.
		 */
		function setup_notice(){
			if (  0 === strpos( get_current_screen()->id, 'settings_page_add_search_to_menu' ) ) {
				return;
			}

			$hascaps = $this->networkactive ? is_network_admin() && current_user_can( 'manage_network_plugins' ) : current_user_can( 'manage_options' );

			if ( $hascaps ) {
				$url = is_network_admin() ? network_site_url() : site_url( '/' );
				echo '<div class="notice notice-info is-dismissible add-search-to-menu"><p>' . sprintf( __( 'To configure <em>Add Search To Menu plugin</em> please visit its <a href="%1$s">configuration page</a> and to get plugin support contact us on <a href="%2$s" target="_blank">plugin support forum</a> or <a href="%3$s" target="_blank">contact us page</a>.', 'add-search-to-menu'), $url . 'wp-admin/options-general.php?page=add_search_to_menu', 'http://freewptp.com/forum/wordpress-plugins-forum/add-search-to-menu/', 'http://freewptp.com/contact/' ) . '</p></div>';
			}
		}

		/**
		 * Handles plugin notice dismiss functionality using AJAX.
		 */
		function dismiss_notice() {
			if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				$this->opt['dismiss_admin_notices'] = 1;
				update_option( 'add_search_to_menu', $this->opt );
			}
			die();
		}

		/**
		 * Registers plugin admin menu item.
		 */
		function admin_menu_setup(){
			add_submenu_page( 'options-general.php', __( 'Add Search To Menu Settings', 'add-search-to-menu' ), __( 'Add Search To Menu', 'add-search-to-menu' ), 'manage_options', 'add_search_to_menu', array( $this, 'admin_page_screen' ) );
		}

		/**
		 * Renders the settings page for this plugin.
		 */
		function admin_page_screen() {
			include_once( 'partials/admin-page.php' );
		}

		/**
		 * Registers plugin settings.
		 */
		function settings_init(){
			add_settings_section( 'add_search_to_menu_section', __( 'Add Search To Menu Settings', 'add-search-to-menu' ),  array( $this, 'settings_section_desc'), 'add_search_to_menu' );

			add_settings_field( 'add_search_to_menu_locations', __( 'Add Search to Menu : ', 'add-search-to-menu' ),  array( $this, 'menu_locations' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_posts', __( 'Search Post Types : ', 'add-search-to-menu' ),  array( $this, 'post_posts' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_style', __( 'Search Form Style : ', 'add-search-to-menu' ),  array( $this, 'form_style' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_title', __( 'Search Menu Title : ', 'add-search-to-menu' ),  array( $this, 'menu_title' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_classes', __( 'Search Menu Classes : ', 'add-search-to-menu' ),  array( $this, 'menu_classes' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_gcse', __( 'Google CSE : ', 'add-search-to-menu' ),  array( $this, 'google_cse' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_display_in_header', __( 'Mobile Display : ', 'add-search-to-menu' ),  array( $this, 'display_in_header' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_close_icon', __( 'Close Icon: ', 'add-search-to-menu' ),  array( $this, 'close_icon' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'add_search_to_menu_css', __( 'Custom CSS : ', 'add-search-to-menu' ),  array( $this, 'custom_css' ), 'add_search_to_menu', 'add_search_to_menu_section' );
			add_settings_field( 'do_not_load_plugin_files', __( 'Do not load plugin files : ', 'add-search-to-menu' ),  array( $this, 'plugin_files' ), 'add_search_to_menu', 'add_search_to_menu_section' );

			register_setting( 'add_search_to_menu', 'add_search_to_menu' );
		}

		/**
		 * Displays plugin description text.
		 */
		function settings_section_desc(){
			echo '<p>' . esc_html__( 'Configure the Add Search To Menu plugin settings here.', 'add-search-to-menu' ) . '</p>';
		}

		/**
		 * Displays choose menu locations field.
		 */
		function menu_locations() {
			$html = '';
			$menus = get_registered_nav_menus();

			if ( ! empty( $menus ) ){

				foreach ( $menus as $location => $description ) {

					$check_value = isset( $this->opt['add_search_to_menu_locations'][ $location ] ) ? $this->opt['add_search_to_menu_locations'][ $location ] : 0;
					$html .= '<input type="checkbox" id="add_search_to_menu_locations' . esc_attr( $location ) . '" name="add_search_to_menu[add_search_to_menu_locations][' . esc_attr( $location ) . ']" value="' . esc_attr( $location ) . '" ' . checked( $location, $check_value, false ) . '/>';
					$html .= '<label for="add_search_to_menu_locations' . esc_attr( $location ) . '"> ' . esc_html( $description ) . '</label><br />';
				}
			} else {
				$html = __( 'No navigation menu registered on your site.', 'add-search-to-menu' );
			}
			echo $html;
		}

		/**
		 * Displays choose post types field.
		 */
		function post_posts() {
			$html = '';
			$args = array( 'exclude_from_search' => false );

			$posts = get_post_types( $args );

			if ( ! empty( $posts ) ){

				foreach ( $posts as $key => $post ) {

					$check_value = isset( $this->opt['add_search_to_menu_posts'][$key] ) ? $this->opt['add_search_to_menu_posts'][ $key ] : 0;
					$html .= '<input type="checkbox" id="add_search_to_menu_posts' . esc_attr( $key ) . '" name="add_search_to_menu[add_search_to_menu_posts][' . esc_attr( $key ) . ']" value="' . esc_attr( $key ) . '" ' . checked( $key, $check_value, false ) . '/>';
					$html .= '<label for="add_search_to_menu_posts' . esc_attr( $key ) . '"> ' . esc_html( $post ) . '</label><br />';
				}
			} else {
				$html = __( 'No post types registered on your site.', 'add-search-to-menu' );
			}
			echo $html;

		}

		/**
		 * Displays form style field.
		 */
		function form_style() {
			$styles = array(
				'default'		  => __( 'Default', 'add-search-to-menu' ),
				'dropdown'		  => __( 'Dropdown', 'add-search-to-menu' ),
				'sliding'		  => __( 'Sliding', 'add-search-to-menu' ),
				'full-width-menu' => __( 'Full Width', 'add-search-to-menu' )
			);

			if ( empty( $this->opt ) || ! isset( $this->opt['add_search_to_menu_style'] ) ) {
				$this->opt['add_search_to_menu_style'] = 'default';
				update_option( 'add_search_to_menu', $this->opt );
			}

			$html = '';
			$check_value = isset( $this->opt['add_search_to_menu_style'] ) ? $this->opt['add_search_to_menu_style'] : 'default';

			foreach ( $styles as $key => $style ) {

				$html .= '<input type="radio" id="add_search_to_menu_style' . esc_attr( $key ) . '" name="add_search_to_menu[add_search_to_menu_style]" value="' . esc_attr( $key ) . '" ' . checked( $key, $check_value, false ) . '/>';
				$html .= '<label for="add_search_to_menu_style' . esc_attr( $key ) . '"> ' . esc_html( $style ) . '</label><br />';
			}
			echo $html;
		}

		/**
		 * Displays search menu title field.
		 */
		function menu_title() {
			$this->opt['add_search_to_menu_title'] = isset( $this->opt['add_search_to_menu_title'] ) ? $this->opt['add_search_to_menu_title'] : '';
			$html = '<input type="text" id="add_search_to_menu_title" name="add_search_to_menu[add_search_to_menu_title]" value="' . esc_attr( $this->opt['add_search_to_menu_title'] ) . '" size="50" />';
			$html .= '<br /><label for="add_search_to_menu_title" style="font-size: 10px;">' . esc_html__( "If title field is not set then instead of title the search icon displays in navigation menu.", 'add-search-to-menu' ) . '</label>';
			echo $html;
		}

		/**
		 * Displays search menu classes field.
		 */
		function menu_classes() {
			$this->opt['add_search_to_menu_classes'] = isset( $this->opt['add_search_to_menu_classes'] ) ? $this->opt['add_search_to_menu_classes'] : 'astm-search-menu';
			$html = '<input type="text" id="add_search_to_menu_classes" name="add_search_to_menu[add_search_to_menu_classes]" value="' . esc_attr( $this->opt['add_search_to_menu_classes'] ) . '" size="50" />';
			$html .= '<br /><label for="add_search_to_menu_classes" style="font-size: 10px;">' . esc_html__( "Add classes seperated by space.", 'add-search-to-menu' ) . '</label>';
			echo $html;
		}

		/**
		 * Displays google cse field.
		 */
		function google_cse() {
			$this->opt['add_search_to_menu_gcse'] = isset( $this->opt['add_search_to_menu_gcse'] ) ? $this->opt['add_search_to_menu_gcse'] : '';
			$html = '<input type="text" id="add_search_to_menu_gcse" name="add_search_to_menu[add_search_to_menu_gcse]" value="' . esc_attr( $this->opt['add_search_to_menu_gcse'] ) . '" size="50" />';
			$html .= '<br /><label for="add_search_to_menu_gcse" style="font-size: 10px;">' . esc_html__( "Add only Google CSE search form code in the above text box that will replace default search form.", 'add-search-to-menu' ) . '</label>';
			echo $html;
		}

		/**
		 * Displays display in header field.
		 */
		function display_in_header() {
			$check_value = isset( $this->opt['add_search_to_menu_display_in_header'] ) ? $this->opt['add_search_to_menu_display_in_header'] : 0;
			$html = '<input type="checkbox" id="add_search_to_menu_display_in_header" name="add_search_to_menu[add_search_to_menu_display_in_header]" value="add_search_to_menu_display_in_header" ' . checked( 'add_search_to_menu_display_in_header', $check_value, false ) . ' />';
			$html .= '<label for="add_search_to_menu_display_in_header"> ' . esc_html__( 'Display Search Form in Header on Mobile Devices', 'add-search-to-menu' ) . '</label>';
			$html .= '<br /><label for="add_search_to_menu_display_in_header" style="font-size: 10px;margin: 5px 0 10px;display: inline-block;">' . esc_html__( "It doesn not work with caching as this functionality uses WordPress wp_is_mobile function.", 'add-search-to-menu' ) . '</label>';
			$check_value = isset( $this->opt['astm_site_uses_cache'] ) ? $this->opt['astm_site_uses_cache'] : 0;
			$html .= '<br /><input type="checkbox" id="astm_site_uses_cache" name="add_search_to_menu[astm_site_uses_cache]" value="astm_site_uses_cache" ' . checked( 'astm_site_uses_cache', $check_value, false ) . ' />';
			$html .= '<label for="astm_site_uses_cache"> ' . esc_html__( 'This site uses Cache', 'add-search-to-menu' ) . '</label>';
			$html .= '<br /><label for="astm_site_uses_cache" style="font-size: 10px;">' . esc_html__( "Use this option to hide search form using CSS code and display it in site header on mobile devices.", 'add-search-to-menu' ) . '</label>';
			echo $html;
		}

		/**
		 * Displays search form close icon field.
		 */
		function close_icon() {
			$check_value = isset( $this->opt['add_search_to_menu_close_icon'] ) ? $this->opt['add_search_to_menu_close_icon'] : 0;
			$html = '<input type="checkbox" id="add_search_to_menu_close_icon" name="add_search_to_menu[add_search_to_menu_close_icon]" value="add_search_to_menu_close_icon" ' . checked( 'add_search_to_menu_close_icon', $check_value, false ) . ' />';
			$html .= '<label for="add_search_to_menu_close_icon"> ' . esc_html__( 'Display Search Form Close Icon', 'add-search-to-menu' ) . '</label>';
			echo $html;
		}

		/**
		 * Displays custom css field.
		 */
		function custom_css() {
			$this->opt['add_search_to_menu_css'] = isset( $this->opt['add_search_to_menu_css'] ) ? $this->opt['add_search_to_menu_css'] : '';
			$html = '<textarea rows="4" cols="53" id="add_search_to_menu_css" name="add_search_to_menu[add_search_to_menu_css]" >' . esc_attr( $this->opt['add_search_to_menu_css'] ) . '</textarea>';
			$html .= '<br /><label for="add_search_to_menu_css" style="font-size: 10px;">' . esc_html__( "Add custom css code if any to style search form.", 'add-search-to-menu' ) . '</label>';
			echo $html;
		}

		/**
		 * Displays do not load plugin files field.
		 */
		function plugin_files() {
			$styles = array(
				'plugin-css-file' => __( 'Plugin CSS File', 'add-search-to-menu' ),
				'plugin-js-file'  => __( 'Plugin JavaScript File', 'add-search-to-menu' )

			);

			$html = '';
			foreach ( $styles as $key => $file ) {

				$check_value = isset( $this->opt['do_not_load_plugin_files'][ $key] ) ? $this->opt['do_not_load_plugin_files'][ $key ] : 0;
				$html .= '<input type="checkbox" id="do_not_load_plugin_files' . esc_attr( $key ) . '" name="add_search_to_menu[do_not_load_plugin_files][' . esc_attr( $key ) . ']" value="' . esc_attr( $key ) . '" ' . checked( $key, $check_value, false ) . '/>';
				$html .= '<label for="do_not_load_plugin_files' . esc_attr( $key ) . '"> ' . esc_html( $file ) . '</label>';

				if ( 'plugin-css-file' == $key ) {
					$html .= '<br /><label for="add_search_to_menu_title" style="font-size: 10px;">' . esc_html__( 'If checked, you have to add following plugin file code into your theme CSS file.', 'add-search-to-menu' ) . '</label>';
					$html .= '<br /><a target="_blank" href="' . plugins_url( '/public/css/add-search-to-menu.css', ASTM_PLUGIN_FILE ) . '"/a>' . plugins_url( '/public/css/add-search-to-menu.css', ASTM_PLUGIN_FILE ) . '</a>';
					$html .= '<br /><br />';
				} else {
					$html .= '<br /><label for="add_search_to_menu_title" style="font-size: 10px;">' . esc_html__( "If checked, you have to add following plugin file code into your theme JavaScript file.", 'add-search-to-menu' ) . '</label>';
					$html .= '<br /><a target="_blank" href="' . plugins_url( '/public/js/add-search-to-menu.js', ASTM_PLUGIN_FILE ) . '"/a>' . plugins_url( '/public/js/add-search-to-menu.js', ASTM_PLUGIN_FILE ) . '</a>';
				}
			}
			echo $html;
		}
	}
}
