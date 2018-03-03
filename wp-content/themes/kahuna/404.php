<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Kahuna
 */

get_header(); ?>

	<div id="container" class="<?php echo kahuna_get_layout_class(); ?>">
		<main id="main" role="main" class="main">

			<header id="post-0" class="pad-container error404 not-found" <?php cryout_schema_microdata( 'element' ); ?>>
				<h1 class="entry-title" <?php cryout_schema_microdata( 'entry-title' ); ?>><?php _e( 'Not Found', 'kahuna' ); ?></h1>
					<p <?php cryout_schema_microdata( 'text' ); ?>><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'kahuna' ); ?></p>
					<?php get_search_form(); ?>
			</header>

		</main><!-- #main -->

		<?php kahuna_get_sidebar(); ?>
	</div><!-- #container -->

<?php get_footer(); ?>
