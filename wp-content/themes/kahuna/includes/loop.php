<?php
/**
 * Functions used in the main loop
 *
 * @package Kahuna
 */

/**
 * Sets the post excerpt length to the number of words set in the theme settings
 */
function kahuna_excerpt_length_words( $length ) {
	if ( is_admin() ) {
		return $length;
	}

	return absint( cryout_get_option( 'kahuna_excerptlength' ) );
}
add_filter( 'excerpt_length', 'kahuna_excerpt_length_words' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function kahuna_custom_excerpt_more() {
	if ( ! is_attachment() ) {
		 echo wp_kses_post( kahuna_continue_reading_link() );
	}
}
add_action( 'cryout_post_excerpt_hook', 'kahuna_custom_excerpt_more', 10 );

/**
 * Returns a "Continue Reading" link for excerpts
 */
function kahuna_continue_reading_link() {
	$kahuna_excerptcont = cryout_get_option( 'kahuna_excerptcont' );
	return '<a class="continue-reading-link" href="'. esc_url( get_permalink() ) . '"><span>' . wp_kses_post( $kahuna_excerptcont ). '<i class="icon-continue-reading"></i></span></a>';
}
add_filter( 'the_content_more_link', 'kahuna_continue_reading_link' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and kahuna_continue_reading_link().
 */
function kahuna_auto_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return wp_kses_post( cryout_get_option( 'kahuna_excerptdots' ) );
}
add_filter( 'excerpt_more', 'kahuna_auto_excerpt_more' );

/**
 * Adds a "Continue Reading" link to post excerpts created using the <!--more--> tag.
 */
function kahuna_more_link( $more_link, $more_link_text ) {
	$kahuna_excerptcont = cryout_get_option( 'kahuna_excerptcont' );
	$new_link_text = $kahuna_excerptcont;
	if ( preg_match( "/custom=(.*)/", $more_link_text, $m ) ) {
		$new_link_text = $m[1];
	}
	$more_link = str_replace( $more_link_text, $new_link_text, $more_link );
	$more_link = str_replace( 'more-link', 'continue-reading-link', $more_link );
	return $more_link;
}
add_filter( 'the_content_more_link', 'kahuna_more_link', 10, 2 );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 * Galleries are styled by the theme in style.css.
 */
function kahuna_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'kahuna_remove_gallery_css' );

/**
 * Posted in category
 */
if ( ! function_exists( 'kahuna_posted_category' ) ) :
function kahuna_posted_category() {
	if ( 'post' !== get_post_type() ) return;
	$kahuna_meta_category = cryout_get_option( 'kahuna_meta_category' );

	if ( $kahuna_meta_category && get_the_category_list() ) {
		echo '<span class="bl_categ"' . cryout_schema_microdata( 'category', 0 ) . '>
					<i class="icon-category icon-metas" title="' . esc_attr__( "Categories", "kahuna" ) . '"></i><span class="category-metas"> '
					 . get_the_category_list( ' <span class="sep">/</span> ' ) .
				'</span></span>';
	}
} // kahuna_posted_category()
endif;

/**
 * Posted by author
 */
if ( ! function_exists( 'kahuna_posted_author' )) :
function kahuna_posted_author() {
	if ( 'post' !== get_post_type() ) return;
	$kahuna_meta_author = cryout_get_option( 'kahuna_meta_author' );

	if ( $kahuna_meta_author ) {
		echo sprintf(
			'<span class="author vcard"' . cryout_schema_microdata( 'author', 0 ) . '>
				<i class="icon-author icon-metas" title="' . esc_attr__( "Author", "kahuna" ) . '"></i>
				<a class="url fn n" rel="author" href="%1$s" title="%2$s"' . cryout_schema_microdata( 'author-url', 0 ) . '>
					<em' .  cryout_schema_microdata( 'author-name', 0 ) . '>%3$s</em>
				</a>
			</span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'kahuna' ), get_the_author() ),
			get_the_author()
		);
	}
} // kahuna_posted_author
endif;

/**
 * Posted by author for single posts
 */
if ( ! function_exists( 'kahuna_posted_author_single' )) :
function kahuna_posted_author_single() {
	$kahuna_meta_author = cryout_get_option( 'kahuna_meta_author' );
	$kahuna_meta_date = cryout_get_option( 'kahuna_meta_date' );
	global $post;
	$author_id = $post->post_author;

	if ( $kahuna_meta_author ) {
		echo sprintf(
			'<span class="author vcard"' . cryout_schema_microdata( 'author', 0 ) . '>' .
				get_avatar( $author_id ) .
				'<a class="url fn n" rel="author" href="%1$s" title="%2$s"' . cryout_schema_microdata( 'author-url', 0 ) . '>
					<em' .  cryout_schema_microdata( 'author-name', 0 ) . '>%3$s</em>
				</a> ' .
			'</span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID', 	$author_id ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'kahuna' ), get_the_author_meta( 'display_name', $author_id) ),
			get_the_author_meta( 'display_name', $author_id)
		);
	}
} // kahuna_posted_author_single
endif;

/**
 * Posted date/time, tags
 */
if ( ! function_exists( 'kahuna_posted_date' ) ) :
function kahuna_posted_date() {
	if ( 'post' !== get_post_type() ) return;
	$kahuna_meta_date = cryout_get_option( 'kahuna_meta_date' );
	$kahuna_meta_time = cryout_get_option( 'kahuna_meta_time' );

	// Post date/time
	if ( $kahuna_meta_date || $kahuna_meta_time ) {
		$date = ''; $time = '';
		if ( $kahuna_meta_date ) { $date = get_the_date(); }
		if ( $kahuna_meta_time ) { $time = esc_attr( get_the_time() ); }
		?>

		<span class="onDate date" >
				<i class="icon-date icon-metas" title="<?php esc_attr_e( "Date", "kahuna" ) ?>"></i>
				<time class="published" datetime="<?php echo get_the_time( 'c' ) ?>" <?php cryout_schema_microdata( 'time' ) ?>>
					<?php echo $date . ( ( $kahuna_meta_date && $kahuna_meta_time ) ? ', ' : '' ) . $time ?>
				</time>
				<time class="updated" datetime="<?php echo get_the_modified_time( 'c' )  ?>" <?php cryout_schema_microdata( 'time-modified' ) ?>><?php echo get_the_modified_date();?></time>
		</span>
		<?php
	}

}; // kahuna_posted_date()
endif;

if ( ! function_exists( 'kahuna_posted_tags' ) ) :
function kahuna_posted_tags() {
	if ( 'post' !== get_post_type() ) return;
	$kahuna_meta_tag  = cryout_get_option( 'kahuna_meta_tag' );
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ' / ' );
	if ( $kahuna_meta_tag && $tag_list ) { ?>
		<span class="tags" <?php cryout_schema_microdata( 'tags' ) ?>>
				<i class="icon-tag icon-metas" title="<?php esc_attr_e( 'Tagged', 'kahuna' ) ?>"></i>&nbsp;<?php echo $tag_list ?>
		</span>
		<?php
	}
}//kahuna_posted_tags()
endif;

/**
 * Post edit link for editors
 */
if ( ! function_exists( 'kahuna_posted_edit' ) ) :
function kahuna_posted_edit() {
	edit_post_link( __( 'Edit', 'kahuna' ), '<span class="edit-link icon-metas"><i class="icon-edit icon-metas"></i> ', '</span>' );
}; // kahuna_posted_edit()
endif;

/**
 * Post format meta
 */
if ( ! function_exists( 'kahuna_meta_format' ) ) :
function kahuna_meta_format() {
	if ( 'post' !== get_post_type() ) return;
	$format = get_post_format();
	if ( is_sticky() ) echo '<span class="entry-sticky">' . __('Featured', 'kahuna') . '</span>';
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format"><a href="%1$s"><i class="icon-%2$s" title="%3$s"></i> %2$s</a></span>',
			esc_url( get_post_format_link( $format ) ),
			$format,
			get_post_format_string( $format )
		);
	}
} //kahuna_meta_format()
endif;

/**
 * Post format info
 */
function kahuna_meta_infos() {

	add_action( 'cryout_featured_hook', 'kahuna_posted_edit', 50 ); // Edit button
	add_action( 'cryout_featured_meta_hook', 'kahuna_comments_on', 50 ); // Comments

	if ( is_single() ) { // If single, metas are shown after the title

		add_action( 'cryout_post_meta_hook',	'kahuna_posted_author_single', 10 );
		add_action( 'cryout_post_meta_hook',	'kahuna_posted_category', 20 );
		add_action( 'cryout_post_meta_hook',	'kahuna_posted_date', 30 );
		add_action( 'cryout_post_meta_hook',	'kahuna_posted_edit', 50 ); // Edit button
		add_action( 'cryout_post_utility_hook',	'kahuna_posted_tags', 40 ); // Tags always at the bottom of the article

	} else { // if blog page, metas are shown at the top of the article

		add_action( 'cryout_featured_meta_hook',	'kahuna_posted_author', 15 );
		add_action( 'cryout_featured_meta_hook',	'kahuna_posted_category', 20 );
		add_action( 'cryout_featured_meta_hook',	'kahuna_posted_tags', 30 );
		add_action( 'cryout_featured_meta_hook',	'kahuna_posted_date', 40 );

	}

	add_action( 'cryout_featured_meta_hook', 'kahuna_meta_format', 10 ); // Post format
} //kahuna_meta_infos()
add_action( 'wp_head', 'kahuna_meta_infos' );


/* Remove category from rel in category tags */
function kahuna_remove_category_tag( $text ) {
	$text = str_replace( 'rel="category tag"', 'rel="tag"', $text );
	return $text;
} //kahuna_remove_category_tag()
//add_filter( 'the_category', 'kahuna_remove_category_tag' );
//add_filter( 'get_the_category_list', 'kahuna_remove_category_tag' );

/**
 * Backup navigation
 */
if ( ! function_exists( 'kahuna_content_nav' ) ) :
function kahuna_content_nav( $nav_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav id="<?php echo $nav_id; ?>" class="navigation">

			<span class="nav-previous">
				 <?php next_posts_link( '<i class="icon-angle-left"></i>' . __( 'Older posts', 'kahuna' ) ); ?>
			</span>

			<span class="nav-next">
				<?php previous_posts_link( __( 'Newer posts', 'kahuna' ) . '<i class="icon-angle-right"></i>' ); ?>
			</span>

		</nav><!-- #<?php echo $nav_id; ?> -->

	<?php endif;
}; // kahuna_content_nav()
endif;

/**
 * Adds a post thumbnail and if one doesn't exist the first post image is returned
 * @uses cryout_get_first_image( $postID )
 */
if ( ! function_exists( 'kahuna_set_featured_srcset_picture' ) ) :
function kahuna_set_featured_srcset_picture() {

	global $post;
	$options = cryout_get_option( array( 'kahuna_fpost', 'kahuna_fauto', 'kahuna_falign', 'kahuna_magazinelayout', 'kahuna_landingpage' ) );

	switch ( apply_filters( 'kahuna_lppostslayout_filter', $options['kahuna_magazinelayout'] ) ) {
		case 3: $featured = 'kahuna-featured-third'; break;
		case 2: $featured = 'kahuna-featured-half'; break;
		case 1: default: $featured = 'kahuna-featured'; break;
	}

	// filter to disable srcset if so desired
	$use_srcset = apply_filters( 'kahuna_featured_srcset', true );

	if ( function_exists('has_post_thumbnail') && has_post_thumbnail() && $options['kahuna_fpost']) {
		// has featured image
		$featured_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'kahuna-featured' );
		$fimage_id = get_post_thumbnail_id( $post->ID );
	} elseif ( $options['kahuna_fpost'] && $options['kahuna_fauto'] && empty($featured_image) ) {
		// get the first image from post
		$featured_image = cryout_post_first_image( $post->ID, 'kahuna-featured' );
		$fimage_id = $featured_image['id'];
	} else {
		// featured image not enabled or not obtainable
		$featured_image[0] = apply_filters('kahuna_preview_img_src', '');
		$featured_image[1] = apply_filters('kahuna_preview_img_w', '');
		$featured_image[2] = apply_filters('kahuna_preview_img_h', '');
		$fimage_id = FALSE;
	};

	if ( ! empty( $featured_image[0] ) ) {
		$featured_width = kahuna_featured_width();
		?>
		<div class="post-thumbnail-container"  <?php cryout_schema_microdata( 'image' ); ?>>

			<a class="post-featured-image" href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>" title="<?php echo esc_attr( get_post_field( 'post_title', $post->ID ) ) ?>"
				<?php cryout_echo_bgimage( $featured_image[0], 'post-featured-image' ) ?>>
			</a>
			<picture class="responsive-featured-image">
				<source media="(max-width: 1152px)" sizes="<?php echo cryout_gen_featured_sizes( $featured_width, $options['kahuna_magazinelayout'], $options['kahuna_landingpage'] ) ?>" srcset="<?php echo cryout_get_picture_src( $fimage_id, 'kahuna-featured-third' ); ?> 512w">
				<source media="(max-width: 800px)" sizes="<?php echo cryout_gen_featured_sizes( $featured_width, $options['kahuna_magazinelayout'], $options['kahuna_landingpage'] ) ?>" srcset="<?php echo cryout_get_picture_src( $fimage_id, 'kahuna-featured-half' ); ?> 800w">
				<?php if ( cryout_on_landingpage() ) { ?><source media="" sizes="<?php echo cryout_gen_featured_sizes( $featured_width, $options['kahuna_magazinelayout'], $options['kahuna_landingpage'] ) ?>" srcset="<?php echo cryout_get_picture_src( $fimage_id, 'kahuna-featured-lp' ); ?> <?php printf( '%sw', $featured_width ) ?>">
				<?php } ?>
				<img alt="<?php the_title_attribute();?>" <?php cryout_schema_microdata( 'url' ); ?> src="<?php echo cryout_get_picture_src( $fimage_id, 'kahuna-featured' ); ?>" />
			</picture>
			<meta itemprop="width" content="<?php echo $featured_image[1]; // width ?>">
			<meta itemprop="height" content="<?php echo $featured_image[2]; // height ?>">
			<div class="featured-image-overlay">
				<div class="entry-meta featured-image-meta"><?php cryout_featured_meta_hook(); ?></div>
				<a class="featured-image-link" href="<?php echo esc_url( get_permalink( $post->ID ) ) ?>" title="<?php echo esc_attr( get_post_field( 'post_title', $post->ID ) ) ?>"></a>
			</div>
		</div>
	<?php
		} else { ?>
		<div class="entry-meta featured-image-meta"><?php cryout_featured_meta_hook(); ?></div>
		<?php }
} // kahuna_set_featured_srcset_picture()
endif;
if ( cryout_get_option( 'kahuna_fpost' ) ) add_action( 'cryout_featured_hook', 'kahuna_set_featured_srcset_picture' );

/* FIN */
