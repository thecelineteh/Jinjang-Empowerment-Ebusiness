<?php
/**
 * The default template for displaying content
 *
 * Used for full-width page template.
 *
 * @package Hestia
 * @since Hestia 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" class="section section-text">
		<div class="row">
			<div class="col-md-12">
				<?php
				$hestia_header_layout = get_theme_mod( 'hestia_header_layout', 'default' );
				if ( ( $hestia_header_layout !== 'default' ) && ! ( hestia_woocommerce_check() && ( is_product() || is_cart() || is_checkout() ) ) ) {
					hestia_show_header_content( 'page', $hestia_header_layout );
				}
				the_content();
				?>
			</div>
		</div>
	</article>
<?php
if ( is_paged() ) {
	?>
	<div class="section section-blog-info">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<?php
						hestia_wp_link_pages(
							array(
								'before'      => '<div class="text-center"> <ul class="nav pagination pagination-primary">',
								'after'       => '</ul> </div>',
								'link_before' => '<li>',
								'link_after'  => '</li>',
							)
						);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
