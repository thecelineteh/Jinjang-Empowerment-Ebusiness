<?php
/**
 *
 * The template for displaying author biography
 *
 * Used in single.php and arhive.php (author archives only)
 *
 * @package Kahuna
 */
?>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
<section id="author-info" <?php cryout_schema_microdata( 'author' ); ?>>

		<div id="author-avatar" <?php cryout_schema_microdata( 'image' );?>>
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'kahuna_author_bio_avatar_size', 80 ), '', '', array( 'extra_attr' => cryout_schema_microdata( 'url', 0) ) ); ?>
		</div><!-- #author-avatar -->

		<div id="author-description"  <?php cryout_schema_microdata( 'author-description' ); ?>>

			<h3 class="page-title">
				<?php echo ' <span' . cryout_schema_microdata( 'author-name', 0) . '>' . esc_attr( get_the_author() ) . '</span>'; ?>
			</h3>
			<span><?php the_author_meta( 'description' ); ?></span>

			<?php if ( is_single() ) { ?>
				<div id="author-link">
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"  <?php cryout_schema_microdata( 'author-url' ); ?>>
						<?php printf( __( 'View all posts by ', 'kahuna' ) . '%s', get_the_author() ); ?>
					</a>
				</div><!-- #author-link	-->
			<?php } ?>

		</div><!-- #author-description -->

</section><!-- #author-info -->
<?php endif; ?>
