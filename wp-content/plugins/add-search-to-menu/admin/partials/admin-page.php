<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package ASTM
 */
?>
<div class="wrap">
	<form id="add_search_to_menu_options" action="options.php" method="post">
		<?php
			settings_fields( 'add_search_to_menu' );
			do_settings_sections( 'add_search_to_menu' );
			submit_button( 'Save Options', 'primary', 'add_search_to_menu_options_submit' );
		?>
		<div id="after-submit">
			<p>
				<?php esc_html_e( 'Like Add Search To Menu?', 'add-search-to-menu' ); ?> <a href="https://wordpress.org/support/plugin/add-search-to-menu/reviews/?filter=5#new-post" target="_blank"><?php esc_html_e( 'Give us a rating', 'add-search-to-menu' ); ?></a>
			</p>
			<p>
				<?php esc_html_e( 'Need Help or Have Suggestions?', 'add-search-to-menu' ); ?> <?php esc_html_e( 'contact us on', 'add-search-to-menu' ); ?> <a href="http://freewptp.com/forum/wordpress-plugins-forum/add-search-to-menu/" target="_blank"><?php esc_html_e( 'Plugin support forum', 'add-search-to-menu' ); ?></a> <?php esc_html_e( 'or', 'add-search-to-menu' ); ?> <a href="http://freewptp.com/contact/" target="_blank"><?php esc_html_e( 'Contact us page', 'add-search-to-menu' ); ?></a>
			</p>
			<p>
				<?php esc_html_e( 'Access Plugin Documentation on', 'add-search-to-menu' ); ?> <a href="http://freewptp.com/plugins/add-search-to-menu/" target="_blank">http://freewptp.com/plugins/add-search-to-menu/</a>
			</p>
		</div>
	 </form>
</div>
