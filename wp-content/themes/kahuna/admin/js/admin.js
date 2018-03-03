/**
 * Admin-side JS
 *
 * @package Kahuna
 */

jQuery(document).ready(function() {

	/* Theme settings save */
	jQuery('#kahuna-savesettings-button').on('click', function(e) {
		jQuery( "#kahuna-settings-dialog" ).dialog({
		  modal: true,
		  minWidth: 600,
		  buttons: {
			'Close': function() {
			  jQuery( this ).dialog( "close" );
			}
		  }
		});
		jQuery('#kahuna-themesettings-textarea').val(jQuery('#kahuna-export input#kahuna-themesettings').val());
		jQuery('#kahuna-settings-dialog strong').hide();
		jQuery('#kahuna-settings-dialog div.settings-error').remove();
		jQuery('#kahuna-settings-dialog strong:nth-child(1)').show();
	});

	/* Theme settings load */
	jQuery('#kahuna-loadsettings-button').on('click', function(e) {
		jQuery( "#kahuna-settings-dialog" ).dialog({
			modal: true,
			minWidth: 600,
			buttons: {
				'Load Settings': function() {
					theme_settings = encodeURIComponent(jQuery('#kahuna-themesettings-textarea').val());
					nonce = jQuery('#kahuna-settings-nonce').val();
					jQuery.post(ajaxurl, {
						action: 'cryout_loadsettings_action',
						kahuna_settings_nonce: nonce,
						kahuna_settings: theme_settings,
					}, function(response) {
						if (response=='OK') {
							jQuery('#kahuna-settings-dialog div.settings-error').remove();
							window.location = '?page=about-kahuna-theme&settings-loaded=true';
						} else {
							jQuery('#kahuna-settings-dialog div.settings-error').remove();
							jQuery('#kahuna-themesettings-textarea').after('<div class="settings-error">' + response + '</div>');
						}
					})
				}
			}
		});
		jQuery('#kahuna-themesettings-textarea').val('');
		jQuery('#kahuna-settings-dialog strong').hide();
		jQuery('#kahuna-settings-dialog strong:nth-child(2)').show();
	});

	/* Latest News Content */
    var data = {
        action: 'cryout_feed_action',
    };
	jQuery.post(ajaxurl, data, function(response) {
		jQuery("#kahuna-news .inside").html(response);
    });

	/* Confirm modal window on reset to defaults */
	jQuery('#kahuna_reset_defaults').click (function() {
		if (!confirm(kahuna_admin_settings.reset_confirmation)) { return false;}
	});

});/* document.ready */

/* FIN */
