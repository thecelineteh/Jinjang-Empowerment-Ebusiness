<?php
/**
 *
 * The template for displaying pages
 *
 * Used in page.php and page tempaltes
 *
 * @package Kahuna
 */
?>
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="schema-image">
			<?php cryout_featured_hook(); ?>
		</div>
		<div class="article-inner">
			<header>
				<?php the_title( '<h1 class="entry-title singular-title" ' . cryout_schema_microdata( 'entry-title', 0 ) . '>', '</h1>' ); ?>
				<span class="entry-meta" >
					<?php edit_post_link( __( 'Edit', 'kahuna' ), '<span class="edit-link"><i class="icon-edit"></i> ', '</span>' ); ?>
				</span>
			</header>

			<?php cryout_singular_before_inner_hook();  ?>

			<div class="entry-content" <?php cryout_schema_microdata( 'text' ); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'kahuna' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

		</div><!-- .article-inner -->
		<?php cryout_singular_after_inner_hook();  ?>
	</article><!-- #post-## -->
	<?php comments_template( '/comments.php', true ); ?>

<?php endwhile; ?>
