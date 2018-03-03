<?php
/**
 * The template for displaying Search results pages.
 *
 * @package Kahuna
 */

get_header(); ?>

	<div id="container" class="<?php echo kahuna_get_layout_class(); ?>">
		<main id="main" role="main" class="main">
			<?php cryout_before_content_hook(); ?>

			<?php if ( have_posts() ) : ?>

				<header class="page-header content-search pad-container" <?php cryout_schema_microdata( 'element' ); ?>>
					<h1 class="page-title" <?php cryout_schema_microdata( 'entry-title' ); ?>>
						<?php printf( __( 'Search Results for: %s', 'kahuna' ), '<strong>' . get_search_query() . '</strong>' ); ?>
					</h1>
					<?php get_search_form(); ?>
				</header>

				<div id="content-masonry" class="content-masonry" <?php cryout_schema_microdata( 'blog' ); ?>>
					<?php /* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'content/content', get_post_format() );
					endwhile;
					?>
				</div><!--content-masonry-->
				<?php

				kahuna_pagination();

			else :

				get_template_part( 'content/content', 'notfound' );
				?><div id="content-masonry"></div><?php

			endif; ?>

			<?php cryout_after_content_hook(); ?>
		</main><!-- #main -->

		<?php kahuna_get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>
