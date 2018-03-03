<?php
/**
 * Admin theme page
 *
 * @package Kahuna
 */

// Framework
require_once( get_template_directory() . "/cryout/framework.php" );

// Theme particulars
require_once( get_template_directory() . "/admin/defaults.php" );
require_once( get_template_directory() . "/admin/options.php" );
require_once( get_template_directory() . "/admin/demo.php" );
require_once( get_template_directory() . "/includes/tgmpa.php" );

// Custom CSS Styles for customizer
require_once( get_template_directory() . "/includes/custom-styles.php" );

// Get the theme options and make sure defaults are used if no values are set
if ( ! function_exists( 'kahuna_get_theme_options' ) ):
function kahuna_get_theme_options() {
	$options = wp_parse_args(
		get_option( 'kahuna_settings', array() ),
		kahuna_get_option_defaults()
	);
	return apply_filters( 'kahuna_theme_options_array', $options );
} // kahuna_get_theme_options()
endif;

if ( ! function_exists( 'kahuna_get_theme_structure' ) ):
function kahuna_get_theme_structure() {
	global $kahuna_big;
	return apply_filters( 'kahuna_theme_structure_array', $kahuna_big );
} // kahuna_get_theme_structure()
endif;

// load up theme options
$cryout_theme_settings = apply_filters( 'kahuna_theme_structure_array', $kahuna_big );
$cryout_theme_options = kahuna_get_theme_options();
$cryout_theme_defaults = kahuna_get_option_defaults();

// Hooks/Filters
add_action( 'admin_menu', 'kahuna_add_page_fn' );

// Add admin scripts
function kahuna_admin_scripts( $hook ) {
	global $kahuna_page;
	if( $kahuna_page != $hook ) return;

	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	wp_enqueue_style( 'kahuna-admin-style', get_template_directory_uri() . '/admin/css/admin.css', NULL, _CRYOUT_THEME_VERSION );
	wp_enqueue_script( 'kahuna-admin-js',get_template_directory_uri() . '/admin/js/admin.js', array('jquery-ui-dialog'), _CRYOUT_THEME_VERSION );
	$js_admin_options = array(
		'reset_confirmation' => esc_html( __( 'Reset Kahuna Settings to Defaults?', 'kahuna' ) ),
	);
	wp_localize_script( 'kahuna-admin-js', 'kahuna_admin_settings', $js_admin_options );
	}

// Create admin subpages
function kahuna_add_page_fn() {
	global $kahuna_page;
	$kahuna_page = add_theme_page( __( 'Kahuna Theme', 'kahuna' ), __( 'Kahuna Theme', 'kahuna' ), 'edit_theme_options', 'about-kahuna-theme', 'kahuna_page_fn' );
	add_action( 'admin_enqueue_scripts', 'kahuna_admin_scripts' );
} // kahuna_add_page_fn()

// Display the admin options page

function kahuna_page_fn() {

	$options = cryout_get_option();

	if (!current_user_can('edit_theme_options'))  {
		wp_die( __( 'Sorry, but you do not have sufficient permissions to access this page.', 'kahuna') );
	}

?>

<div class="wrap" id="main-page"><!-- Admin wrap page -->
	<div id="lefty">
	<?php if( isset($_GET['settings-loaded']) ) { ?>
		<div class="updated fade">
			<p><?php _e('Kahuna settings loaded successfully.', 'kahuna') ?></p>
		</div> <?php
	} ?>
	<?php
	// Reset settings to defaults if the reset button has been pressed
	if ( isset( $_POST['kahuna_reset_defaults'] ) ) {
		delete_option( 'kahuna_settings' ); ?>
		<div class="updated fade">
			<p><?php _e('Kahuna settings have been reset successfully.', 'kahuna') ?></p>
		</div> <?php
	} ?>

		<div id="admin_header">
			<img src="<?php echo get_template_directory_uri() . '/admin/images/logo-about-top.png' ?>" />
			<span class="version">
				<?php _e( 'Kahuna Theme', 'kahuna' ) ?> v<?php echo _CRYOUT_THEME_VERSION; ?> by
				<a href="https://www.cryoutcreations.eu" target="_blank">Cryout Creations</a><br>
				<?php do_action( 'cryout_admin_version' ); ?>
			</span>
		</div>

		<div id="admin_links">
			<a href="https://www.cryoutcreations.eu/wordpress-themes/kahuna" target="_blank"><?php _e( 'Read the Docs', 'kahuna' ) ?></a>
			<a href="https://www.cryoutcreations.eu/forums/f/wordpress/kahuna" target="_blank"><?php _e( 'Browse the Forum', 'kahuna' ) ?></a>
			<a href="https://www.cryoutcreations.eu/priority-support" target="_blank"><?php _e( 'Priority Support', 'kahuna' ) ?></a>
		</div>


		<br>
		<div id="description">
			<?php
				$theme = wp_get_theme();
			 	echo esc_html( $theme->get( 'Description' ) );
			?>
		</div>
		<br><br>

		<a class="button" href="customize.php" id="customizer"> <?php printf( __( 'Customize %s', 'kahuna' ), ucwords(_CRYOUT_THEME_NAME) ); ?> </a>

		<div id="kahuna-export" >
			<div>

			<h3 class="hndle"><?php _e( 'Manage Theme Settings', 'kahuna' ); ?></h3>

				<form action="" method="post" class="third">
					<input type="hidden" name="kahuna_reset_defaults" value="true" />
					<input type="submit" class="button" id="kahuna_reset_defaults" value="<?php _e( 'Reset to Defaults', 'kahuna' ); ?>" />
				</form>
			</div>
		</div><!-- export -->

	</div><!--lefty -->


	<div id="righty" >
		<div id="kahuna-donate" class="postbox donate">

			<div class="inside">
				<p>The job of the big kahuna is very important. The big kahuna makes important decisions, teaches, sings, composes, heals, treats and pretty much does anything you can think of. Without him everything would come crumbling down in the blink of an eye.</p>
				<p>And that's why the big kahuna gets to wear the bigwig and eat the big cheese, he gets to walk the top dog and go jogging in the big wheel. He's the kingpin and can only be compared to the great poobah or the head honcho. His enemies call him the muckety much but the rest of us he's simply known as the big kahuna.</p>
				<p>And now, thanks to us, he's at your service. You're welcome. Feel the need to repay us?</p>

				<div style="display:block;float:none;margin:0 auto;text-align:center;">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_donations">
						<input type="hidden" name="business" value="KYL26KAN4PJC8">
						<input type="hidden" name="item_name" value="Cryout Creations - Kahuna Theme">
						<input type="hidden" name="currency_code" value="EUR">
						<input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_SM.gif:NonHosted">
						<input type="image" src="<?php echo get_template_directory_uri() . '/admin/images/coffee.png' ?>" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>

			</div><!-- inside -->

		</div><!-- donate -->

		<div id="kahuna-news" class="postbox news" >
			<h3 class="hndle"><?php _e( 'Theme Updates', 'kahuna' ); ?></h3>
			<div class="panel-wrap inside">
			</div><!-- inside -->
		</div><!-- news -->

	</div><!--  righty -->
</div><!--  wrap -->

<?php
} // kahuna_page_fn()
