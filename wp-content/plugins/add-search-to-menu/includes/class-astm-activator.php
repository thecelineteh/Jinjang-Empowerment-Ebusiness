<?php
/**
 * Fires during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    ASTM
 * @subpackage ASTM/includes
 * @author     Free WPTP <freewptp@gmail.com>
 */

if ( ! class_exists( 'ASTM_Activator' ) ) {

	class ASTM_Activator {

		/**
		 * The code that runs during plugin activation.
		 *
		 * @since    1.0.0
		 */
		public static function activate() {
			$opt = get_option( 'add_search_to_menu' );

			if ( ! isset( $opt['add_search_to_menu_locations'] ) ) {
				$menus = get_registered_nav_menus();
				if ( ! empty( $menus ) ) {
					$menu_keys = array_keys($menus);
					$opt['add_search_to_menu_locations'][ $menu_keys[0] ] = $menu_keys[0];
					update_option( 'add_search_to_menu', $opt );
				}
			}

			if ( ! isset( $opt['add_search_to_menu_posts'] ) ) {
				$args = array( 'exclude_from_search' => false );
				$posts = get_post_types( $args );
				$post_keys = array_keys( $posts );
				foreach ( $post_keys as $post_key ) {
					$opt['add_search_to_menu_posts'][ $post_key ] = $post_key;
				}
				update_option( 'add_search_to_menu', $opt );
			}
		}
	}
}
