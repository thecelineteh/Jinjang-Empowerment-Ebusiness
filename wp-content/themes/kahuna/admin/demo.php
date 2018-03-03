<?php
/**
 * Adds random images to the demo preview
 *
 * @package kahuna
 */

// pseudo randomness array
$kahuna_demo_randomness = array( 6, 8, 1, 5, 2, 9, 7, 3, 4, 10 );
// current element index
$kahuna_demo_index = 0;

// Return URL of a random demo image
function kahuna_demo_image_src(){
	global $kahuna_demo_randomness;
	global $kahuna_demo_index;

	if ( $kahuna_demo_index >= count( $kahuna_demo_randomness ) ) $kahuna_demo_index=0; // reset when randomness array used up

	$filename = "{$kahuna_demo_randomness[$kahuna_demo_index]}.jpg";

	$kahuna_demo_index++;

	return get_template_directory_uri() . '/resources/images/demo/' . $filename;
} // kahuna_demo_image_src()

// Filter thumbnail image and return sample image if no thumbnail exists
function kahuna_demo_thumbnail( $input ) {
	if ( empty( $input ) ) {
		return kahuna_demo_image_src();
	}
	return $input;
} // kahuna_demo_thumbnail()

// Check if running on the demo
function kahuna_is_demo() {
	$current_theme = wp_get_theme();
	$theme_slug = $current_theme->Template;
	$active_theme = kahuna_get_wp_option( 'template' );
	return apply_filters( 'kahuna_is_demo', ( $active_theme != strtolower( $theme_slug ) && ! is_child_theme() ) );
} // kahuna_is_demo()

// Read WordPress options
function kahuna_get_wp_option( $opt_name ) {
	$alloptions = wp_cache_get( 'alloptions', 'options' );
	$alloptions = maybe_unserialize( $alloptions );
	return isset( $alloptions[ $opt_name ] ) ? maybe_unserialize( $alloptions[ $opt_name ] ) : false;
} // kahuna_get_wp_option()

// Apply the filter
if ( kahuna_is_demo() ) { add_filter( 'kahuna_preview_img_src', 'kahuna_demo_thumbnail' ); }

// FIN
