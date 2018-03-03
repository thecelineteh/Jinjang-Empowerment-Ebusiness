<?php
/**
 * This class defines all plugin functionality for the site front.
 *
 * @package ASTM
 * @since    1.0.0
 */

if ( ! class_exists( 'ASTM_Public' ) ) {

	class ASTM_Public {

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
		 * Initializes this class and stores the plugin options.
		 */
		public function __construct() {
			$astm = Add_Search_To_Menu::getInstance();
			$this->opt = ( null !== $astm ) ? $astm->opt : get_option( 'add_search_to_menu' );
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
		 * Enqueues search menu style and script files.
		 */
		function enqueue_script_style(){
			if ( ! isset( $this->opt['do_not_load_plugin_files']['plugin-css-file'] ) ){
				wp_enqueue_style( 'add-search-to-menu-styles', plugins_url( '/public/css/add-search-to-menu.css', ASTM_PLUGIN_FILE ), array(), ASTM_VERSION );
			}

			if ( ! isset( $this->opt['do_not_load_plugin_files']['plugin-js-file'] ) && ( isset( $this->opt['add_search_to_menu_style'] ) && $this->opt['add_search_to_menu_style'] != 'default' ) ) {
				wp_enqueue_script( 'add-search-to-menu-scripts', plugins_url( '/public/js/add-search-to-menu.js', ASTM_PLUGIN_FILE ), array( 'jquery' ), ASTM_VERSION, true  );
			}
		}

		/**
		 * Displays search form in the navigation bar in the front end of site.
		 */
		function search_menu_item( $items, $args ) {
			if ( isset( $this->opt['add_search_to_menu_locations'] ) && isset( $this->opt['add_search_to_menu_locations'][ $args->theme_location ] ) ) {

				if ( isset( $this->opt['add_search_to_menu_gcse'] ) && $this->opt['add_search_to_menu_gcse'] != ''  ) {
					$items .= '<li class="gsc-cse-search-menu">' . $this->opt['add_search_to_menu_gcse'] . '</li>';
				} else {
					$search_class = isset( $this->opt['add_search_to_menu_classes'] ) ? $this->opt['add_search_to_menu_classes'].' astm-search-menu ' : 'astm-search-menu ';
					$search_class .= isset( $this->opt['add_search_to_menu_style'] ) ? $this->opt['add_search_to_menu_style'] : 'default';
					$title = isset( $this->opt['add_search_to_menu_title'] ) ? $this->opt['add_search_to_menu_title'] : '';
					$items .= '<li class="' . esc_attr( $search_class ) . '">';

					if ( isset( $this->opt['add_search_to_menu_style'] ) && $this->opt['add_search_to_menu_style'] != 'default' ) {

						$items .= '<a title="' . esc_attr( $title ) . '" href="#">';

						if ( '' == $title ) {
							$items .= '<svg width="20" height="20" class="search-icon" role="img" viewBox="2 9 20 5">
							<path class="search-icon-path" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>';
						} else {
							$items .= $title;
						}
						$items .= '</a>';
					}
					$items .= get_search_form( false );

					if ( isset( $this->opt['add_search_to_menu_close_icon'] ) && $this->opt['add_search_to_menu_close_icon'] ) {
						$items .= '<div class="search-close"></div>';
					}

					$items .= '</li>';
				}
			}
			return $items;
		}

		/**
		 * Displays search form in mobile header in the front end of site.
		 */
		function search_in_header() {
			$items = '';

			if ( isset( $this->opt['add_search_to_menu_gcse'] ) && $this->opt['add_search_to_menu_gcse'] != ''  ) {
				$items .= '<li class="gsc-cse-search-menu">' . $this->opt['add_search_to_menu_gcse'] . '</li>';
			} else {
				$search_class = isset( $this->opt['add_search_to_menu_classes'] ) ? $this->opt['add_search_to_menu_classes'].' astm-search-menu ' : 'astm-search-menu ';
				$search_class .= isset( $this->opt['add_search_to_menu_style'] ) ? $this->opt['add_search_to_menu_style'] : 'default';
				$title = isset( $this->opt['add_search_to_menu_title'] ) ? $this->opt['add_search_to_menu_title'] : '';
				$items .= '<div class="astm-search-menu-wrapper"><div>';
				$items .= '<span class="' . esc_attr( $search_class ) . '">';

				if ( $this->opt['add_search_to_menu_style'] != 'default' ){

					$items .= '<a title="' . esc_attr( $title ) . '" href="#">';

					if ( '' == $title ) {
						$items .= '<svg width="20" height="20" class="search-icon" role="img" viewBox="2 9 20 5">
						<path class="search-icon-path" d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>';
					} else {
						$items .= $title;
					}

					$items .= '</a>';
				}
				$items .= get_search_form( false );

				if ( isset( $this->opt['add_search_to_menu_close_icon'] ) && $this->opt['add_search_to_menu_close_icon'] ) {
					$items .= '<div class="search-close"></div>';
				}

				$items .= '</span></div></div>';
			}

			echo $items;
		}

		/**
		 * Filters search results.
		 */
		function search_filter( $query ) {
			if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
				  $query->set( 'post_type', $this->opt['add_search_to_menu_posts'] );
			}
		}

		/**
		 * Adds custom CSS code in the site front end.
		 */
		function custom_css() {
			if ( isset( $this->opt['add_search_to_menu_css'] ) && $this->opt['add_search_to_menu_css'] != '' ) {
				echo '<style type="text/css" media="screen">';
				echo '/* Add search to menu custom CSS code */';
				echo wp_specialchars_decode( esc_html( $this->opt['add_search_to_menu_css'] ), ENT_QUOTES );
				echo '</style>';
			}
		}
	}
}
