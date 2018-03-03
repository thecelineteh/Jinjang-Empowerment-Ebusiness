<?php
/**
 * The template for displaying the landing page/blog posts
 * The functions used here can be found in includes/landing-page.php
 *
 * @package Kahuna
 */

$kahuna_landingpage = cryout_get_option( 'kahuna_landingpage' );

if ( is_page() && ! $kahuna_landingpage ) { 
	include( get_page_template() );
	return true;
}

if ( 'posts' == get_option( 'show_on_front' ) ) {
	include( get_home_template() );
} else {

	get_header(); ?>

	<div id="container" class="kahuna-landing-page one-column">
		<main id="main" role="main" class="main">
		<?php

		if ( $kahuna_landingpage ) {
			kahuna_lpslider();
			kahuna_lpblocks();
			kahuna_lptext('one');
			kahuna_lpboxes(1);
			kahuna_lptext('two');
			kahuna_lpboxes(2);
			kahuna_lptext('three');
			kahuna_lpindex();
			kahuna_lptext('four');
		} else {
			kahuna_lpindex();
		}

		?>
		</main><!-- #main -->
		<?php if ( ! $kahuna_landingpage ) { kahuna_get_sidebar(); } ?>
	</div><!-- #container -->

	<?php get_footer();
} //else !posts
