<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();

/**
 * Don't display page header if header layout is set as classic blog.
 */
$hestia_header_layout = get_theme_mod( 'hestia_header_layout', 'default' );
if ( $hestia_header_layout !== 'classic-blog' ) {
	hestia_display_page_header( 'post' );
} ?>

</header>
<div class="<?php echo hestia_layout(); ?>">
	<div class="blog-post blog-post-wrapper">
		<div class="container">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'single' );
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>
</div>
<?php do_action( 'hestia_blog_related_posts' ); ?>
<div class="footer-wrapper">
	<?php get_footer(); ?>
