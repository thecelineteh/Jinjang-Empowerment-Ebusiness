/**
 * Dismisses plugin notices.
 */
( function( $ ) {
	'use strict';
	$( document ).ready( function() {
		$( '.notice.is-dismissible.add-search-to-menu .notice-dismiss' ).on( 'click', function() {

			$.ajax( {
				url: add_search_to_menu.ajax_url,
				data: {
					action: 'dismiss_notice'
				}
			} );

		} );
	} );
} )( jQuery );
