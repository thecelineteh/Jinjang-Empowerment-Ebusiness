<?php
/**
 * TGMPA init
 *
 * @package Kahuna
 */

/* TGM_Plugin_Activation class is included in the framework. */
add_action( 'tgmpa_register', 'kahuna_register_required_plugins' );

/*This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10. */
function kahuna_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'               => 'Cryout Serious Slider', // The plugin name.
			'slug'               => 'cryout-serious-slider', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '0.6', // If set, the active plugin must be this version or higher. 
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
		array(
			'name'               => 'Force Regenerate Thumbnails', // The plugin name.
			'slug'               => 'force-regenerate-thumbnails', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '2.0.0', // If set, the active plugin must be this version or higher. 
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 */
	$config = array(
		'id'           => 'kahuna',                // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'kahuna-addons',		   // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table

		'strings'      => array(
			'page_title'                      => __( 'Kahuna Suggested Plugins', 'kahuna' ),
			'menu_title'                      => __( 'Kahuna Addons', 'kahuna' ),
			/* translators: %s: plugin name. */
			'installing'                      => __( 'Installing Plugin: %s', 'kahuna' ),
			/* translators: %s: plugin name. */
			'updating'                        => __( 'Updating Plugin: %s', 'kahuna' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'kahuna' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'kahuna'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). */
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'kahuna'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following plugin should be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins should be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'kahuna'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). */
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'kahuna'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'kahuna'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). */
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'kahuna'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'kahuna'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'kahuna'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'kahuna'
			),
			'return'                          => __( 'Return to Suggested Plugins Installer', 'kahuna' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'kahuna' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'kahuna' ),
			/* translators: 1: plugin name. */
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'kahuna' ),
			/* translators: 1: plugin name. */
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'kahuna' ),
			/* translators: 1: dashboard link. */
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'kahuna' ),
			'dismiss'                         => __( 'Dismiss this notice', 'kahuna' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'kahuna' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'kahuna' ),

			'nag_type'                        => 'notice-info', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
			
	);

	tgmpa( $plugins, $config );
}

// FIN