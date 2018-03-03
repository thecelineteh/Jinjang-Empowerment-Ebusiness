<?php
/**
 * The template for displaying all single posts and attachments.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

get_header();
$hestia_header_layout = get_theme_mod( 'hestia_header_layout', 'default' );
if ( ( $hestia_header_layout !== 'classic-blog' ) || ( ( hestia_woocommerce_check() && ( is_cart() || is_checkout() ) ) ) ) { ?>
	<div id="primary" class="<?php echo hestia_boxed_layout_header(); ?> page-header header-small">
		<?php
		if ( ( hestia_woocommerce_check() && ! is_cart() && ! is_checkout() && $hestia_header_layout !== 'no-content' ) || ! hestia_woocommerce_check() ) {
			hestia_show_header_content( 'page' );
		}
		hestia_output_wrapper_header_background( false );
		?>
	</div>
	<?php
}
?>
</header>
<div class="<?php echo hestia_layout(); ?>">
	<?php
	$class_to_add = '';
	if ( hestia_woocommerce_check() && ! is_cart() ) {
		$class_to_add = 'blog-post-wrapper';
	}
	?>
	<div class="blog-post <?php esc_attr( $class_to_add ); ?>">
		<div class="container">
			<?php
			if ( hestia_woocommerce_check() && ( is_cart() || is_checkout() ) ) {
			?>
			<div class="row">
				<div class="col-sm-12">
					<h1 class="hestia-title"><?php single_post_title(); ?></h1>
				</div>
			</div>
			<?php
			}

			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>
	<?php get_footer(); ?>
