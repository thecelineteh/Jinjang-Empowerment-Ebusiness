<?php
/**
 * Core theme functions
 *
 * @package Kahuna
 */


 /**
  * Calculates the correct content_width value depending on site with and configured layout
  */
if ( ! function_exists( 'kahuna_content_width' ) ) :
function kahuna_content_width() {
	global $content_width;
	$deviation = 0.80;

	$options = cryout_get_option( array(
		'kahuna_sitelayout', 'kahuna_landingpage', 'kahuna_magazinelayout', 'kahuna_sitewidth', 'kahuna_primarysidebar', 'kahuna_secondarysidebar',
   ) );

	$content_width = 0.98 * (int)$options['kahuna_sitewidth'];

	switch( $options['kahuna_sitelayout'] ) {
		case '2cSl': case '3cSl': case '3cSr': case '3cSs': $content_width -= (int)$options['kahuna_primarysidebar']; // primary sidebar
		case '2cSr': case '3cSl': case '3cSr': case '3cSs': $content_width -= (int)$options['kahuna_secondarysidebar']; break; // secondary sidebar
	}

	if ( is_front_page() && $options['kahuna_landingpage'] ) {
		// landing page could be a special case;
		$width = ceil( (int)$content_width / apply_filters('kahuna_lppostslayout_filter', (int)$options['kahuna_magazinelayout']) );
		$content_width = ceil($width);
		return;
   }

   if ( ! is_singular() ) {
       switch ( $options['kahuna_magazinelayout'] ):
           case 2: $content_width = floor($content_width*0.98/2); break; // magazine-two
           case 3: $content_width = floor($content_width*0.96/3); break; // magazine-three
       endswitch;
   };

   $content_width = floor($content_width*$deviation);

} // kahuna_content_width()
endif;

 /**
  * Calculates the correct featured image width depending on site with and configured layout
  * Used by kahuna_setup()
  */
if ( ! function_exists( 'kahuna_featured_width' ) ) :
function kahuna_featured_width() {

	$options = cryout_get_option( array(
		'kahuna_sitelayout', 'kahuna_landingpage', 'kahuna_magazinelayout', 'kahuna_sitewidth', 'kahuna_primarysidebar', 'kahuna_secondarysidebar',
		'kahuna_lplayout',
	) );

	$width = (int)$options['kahuna_sitewidth'];

	$deviation = 0.02 * $width; // content to sidebar(s) margin

	switch( $options['kahuna_sitelayout'] ) {
		case '2cSl': case '3cSl': case '3cSr': case '3cSs': $width -= (int)$options['kahuna_primarysidebar'] + $deviation; // primary sidebar
		case '2cSr': case '3cSl': case '3cSr': case '3cSs': $width -= (int)$options['kahuna_secondarysidebar'] + $deviation; break; // secondary sidebar
	}

	if ( is_front_page() && $options['kahuna_landingpage'] ) {
		// landing page is a special case
		$width = ceil( (int)$options['kahuna_sitewidth'] / apply_filters('kahuna_lppostslayout_filter', (int)$options['kahuna_magazinelayout'] ) );
		return ceil($width);
	}

	if ( ! is_singular() ) {
		switch ( $options['kahuna_magazinelayout'] ):
			case 2: $width = ceil($width*0.94/2); break; // magazine-two
			case 3: $width = ceil($width*0.88/3); break; // magazine-three
		endswitch;
	};

	return ceil($width);

} // kahuna_featured_width()
endif;


 /**
  * Check if a header image is being used
  * Returns the URL of the image or FALSE
  */
if ( ! function_exists( 'kahuna_header_image_url' ) ) :
function kahuna_header_image_url() {
	$limit = 0.75;
	$kahuna_fheader = cryout_get_option( 'kahuna_fheader' );
	$kahuna_headerh = floor( cryout_get_option( 'kahuna_headerheight' ) * $limit );
	$kahuna_headerw = floor( cryout_get_option( 'kahuna_sitewidth' ) * $limit );

	// Check if this is a post or page, if it has a thumbnail, and if it's a big one
	global $post;
	$header_image = FALSE;
	if ( get_header_image() != '' ) { $header_image = get_header_image(); }
	if ( is_singular() && has_post_thumbnail( $post->ID ) && $kahuna_fheader &&
		( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'kahuna-header' ) )
		 ) :
			if ( ( absint($image[1]) >= $kahuna_headerw ) && ( absint($image[2]) >= $kahuna_headerh ) ) {
				// 'header' image is large enough
				$header_image = $image[0];
			} else {
				// 'header' image too small, try 'full' image instead
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				if ( ( absint($image[1]) >= $kahuna_headerw ) && ( absint($image[2]) >= $kahuna_headerh ) ) {
					// 'full' image is large enough
					$header_image = $image[0];
				} else {
					// even 'full' image is too small, don't return an image
					//$header_image = false;
				}
			}
	endif;

	return $header_image;
} //kahuna_header_image_url()
endif;

/**
 * Header image handler
 * Both as normal img and background image
 */
add_action ( 'cryout_headerimage_hook', 'kahuna_header_image', 99 );
if ( ! function_exists( 'kahuna_header_image' ) ) :
function kahuna_header_image() {
	$header_image = kahuna_header_image_url();
	if ( is_front_page() && function_exists( 'the_custom_header_markup' ) && has_header_video() ) {
		the_custom_header_markup();
	} elseif ( ! empty( $header_image ) ) { ?>
			<div class="header-image" <?php echo cryout_echo_bgimage( esc_url( $header_image ) ) ?>></div>
			<img class="header-image" alt="<?php if ( is_single() ) the_title_attribute(); elseif ( is_archive() ) echo strip_tags( get_the_archive_title() ); else echo get_bloginfo( 'name' ) ?>" src="<?php echo esc_url( $header_image ) ?>" />
			<?php cryout_header_widget_hook(); ?>
	<?php }
} // kahuna_header_image()
endif;

if ( ! function_exists( 'kahuna_header_title_check' ) ) :
function kahuna_header_title_check() {
    $options = cryout_get_option( array( 'kahuna_headertitles_posts', 'kahuna_headertitles_pages', 'kahuna_headertitles_archives', 'kahuna_headertitles_home' ) );
	
	// woocommerce should never use header titles
	if (function_exists('is_woocommerce') && is_woocommerce()) return false;
	
	// theme's landing page
	if ( cryout_on_landingpage() && $options['kahuna_headertitles_home'] ) return true;
	
	// blog section
	if ( is_home() && $options['kahuna_headertitles_home'] ) return true;
	
	// other instances
	if ( ( is_single() && $options['kahuna_headertitles_posts'] ) ||
    ( is_page() && $options['kahuna_headertitles_pages'] && ! cryout_on_landingpage() ) ||
    ( ( is_archive() || is_search() || is_404() ) && $options['kahuna_headertitles_archives'] ) ||
    ( ( is_home() ) && $options['kahuna_headertitles_home'] ) ) {
        return true;
    }
	return false;
} //kahuna_header_title_check
endif;

/**
 * Header Title and meta
 */
add_action ( 'cryout_headerimage_hook', 'kahuna_header_title', 100 );
if ( ! function_exists( 'kahuna_header_title' ) ) :
function kahuna_header_title() {
    if ( kahuna_header_title_check() ) : ?>
    <div id="header-page-title">
        <div id="header-page-title-inside">
            <?php if ( is_singular() )  {
                the_title( '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>', '</h1>' );
                } elseif ( is_home() && is_front_page() ) {
                    echo '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '</h1><p class="byline">' . esc_attr( get_bloginfo( 'description', 'display' ) ) . '</p>';
                } else {
                    echo '<h1 class="entry-title" ' . cryout_schema_microdata('entry-title', 0) . '>';
					if ( is_home() ) {
						single_post_title();
					}
					if ( is_archive() ) {
                        echo get_the_archive_title();
                    }
                    if ( is_search() ) {
                        printf( __( 'Search Results for: %s', 'kahuna' ), '<strong>' . get_search_query() . '</strong>' );
                    }
                    if ( is_404() ) {
                        _e( 'Not Found', 'kahuna' );
                    }
                    echo '</h1>';
            } ?>
            <?php cryout_breadcrumbs_hook();?>
        </div>
    </div> <?php endif;
} // kahuna_header_title()
endif;


/**
 * Adds title and description to header
 * Used in header.php
*/
if ( ! function_exists( 'kahuna_title_and_description' ) ) :
function kahuna_title_and_description() {

	$options = cryout_get_option( array( 'kahuna_logoupload', 'kahuna_siteheader' ) );

	if ( in_array( $options['kahuna_siteheader'], array( 'logo', 'both' ) ) ) {
		echo kahuna_logo_helper( $options['kahuna_logoupload'] );
	}
	if ( in_array( $options['kahuna_siteheader'], array( 'title', 'both', 'logo', 'empty' ) ) ) {
		$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
		echo '<div id="site-text">';
		echo '<' . $heading_tag . cryout_schema_microdata( 'site-title', 0 ) . ' id="site-title">';
		echo '<span> <a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> </span>';
		echo '</' . $heading_tag . '>';
		echo '<span id="site-description" ' . cryout_schema_microdata( 'site-description', 0 ) . ' >' . esc_attr( get_bloginfo( 'description' ) ). '</span>';
		echo '</div>';
	}
} // kahuna_title_and_description()
endif;
add_action ( 'cryout_branding_hook', 'kahuna_title_and_description' );

function kahuna_logo_helper( $kahuna_logo ) {
	if ( function_exists( 'the_custom_logo' ) ) {
		// WP 4.5+
		$wp_logo = str_replace( 'class="custom-logo-link"', 'id="logo" class="custom-logo-link" title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'"', get_custom_logo() );
		if ( ! empty( $wp_logo ) ) return '<div class="identity">' . $wp_logo . '</div>';
	} else {
		// older WP
		if ( ! empty( $kahuna_logo ) ) :
			$img = wp_get_attachment_image_src( $kahuna_logo, 'full' );
			return '<div class="identity"><a id="logo" href="' . esc_url( home_url( '/' ) ) . '" ><img title="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" alt="'.esc_attr( get_bloginfo( 'name', 'display' ) ).'" src="' . esc_url( $img[0] ) . '" /></a></div>';
		endif;
	}
	return '';
} // kahuna_logo_helper()

// cryout_schema_publisher() located in cryout/prototypes.php
add_action( 'cryout_after_inner_hook', 'cryout_schema_publisher' );
add_action( 'cryout_singular_after_inner_hook', 'cryout_schema_publisher' );

// cryout_schema_main() located in cryout/prototypes.php
add_action( 'cryout_after_inner_hook', 'cryout_schema_main' );
add_action( 'cryout_singular_after_inner_hook', 'cryout_schema_main' );

/**
 * Kahuna back to top button
 * Creates div for js
*/
function kahuna_back_top() {
	echo '<div id="toTop"><i class="icon-back2top"></i> </div>';
} // kahuna_back_top()
add_action ( 'cryout_master_footerbottom_hook', 'kahuna_back_top' );


/**
 * Creates pagination for blog pages.
 */
if ( ! function_exists( 'kahuna_pagination' ) ) :
function kahuna_pagination( $pages = '', $range = 2, $prefix ='' ) {
	$pagination = cryout_get_option( 'kahuna_pagination' );
	if ( $pagination && function_exists( 'the_posts_pagination' ) ):
		the_posts_pagination( array(
			'prev_text' => '<i class="icon-pagination-left"></i>',
			'next_text' => '<i class="icon-pagination-right"></i>',
			'mid_size' => $range
		) );
	else:
		//posts_nav_link();
		kahuna_content_nav( 'nav-old-below' );
	endif;

} // kahuna_pagination()
endif;

/**
 * Prev/Next page links
 */
if ( ! function_exists( 'kahuna_nextpage_links' ) ) :
function kahuna_nextpage_links( $defaults ) {
	$args = array(
		'link_before'      => '<em>',
		'link_after'       => '</em>',
	);
	$r = wp_parse_args( $args, $defaults );
	return $r;
} // kahuna_nextpage_links()
endif;
add_filter( 'wp_link_pages_args', 'kahuna_nextpage_links' );


/**
 * Footer Hook
 */
add_action( 'cryout_master_footer_hook', 'kahuna_master_footer' );
function kahuna_master_footer() {
	$kahuna_theme = wp_get_theme();
	do_action( 'cryout_footer_hook' );
	echo '<div style="display:block;float:right;clear: right;">' . __( "Powered by", "kahuna" ) .
		'<a target="_blank" href="' . esc_html( $kahuna_theme->get( 'ThemeURI' ) ) . '" title="';
	echo 'Kahuna WordPress Theme by ' . 'Cryout Creations"> ' . 'Kahuna' .'</a> &amp; <a target="_blank" href="' . "http://wordpress.org/";
	echo '" title="' . esc_attr__( "Semantic Personal Publishing Platform", "kahuna") . '"> ' . sprintf( " %s.", "WordPress" ) . '</a></div>';
}

add_action( 'cryout_master_footer_hook', 'kahuna_copyright' );
function kahuna_copyright() {
    echo '<div id="site-copyright">' . wp_kses_post( cryout_get_option( 'kahuna_copyright' ) ) . '</div>';
}

/*
 * Sidebar handler
*/
if ( ! function_exists( 'kahuna_get_sidebar' ) ) :
function kahuna_get_sidebar() {
	global $post;
	if ( get_post() && is_singular() ) { $kahuna_meta_layout = get_post_meta( $post->ID, '_kahuna_layout', true ); }

	if ( isset( $kahuna_meta_layout ) && $kahuna_meta_layout ) {
		$kahuna_sitelayout =  $kahuna_meta_layout;
	}
	else $kahuna_sitelayout = cryout_get_option( 'kahuna_sitelayout' );
	switch( $kahuna_sitelayout ) {
		case '2cSl':
			get_sidebar( 'left' );
		break;

		case '2cSr':
			get_sidebar( 'right' );
		break;

		case '3cSl' : case '3cSr' : case '3cSs' :
			get_sidebar( 'left' );
			get_sidebar( 'right' );
		break;

		default:
		break;
	}
} // kahuna_get_sidebar()
endif;

/*
 * General layout class
 */
if ( ! function_exists( 'kahuna_get_layout_class' ) ) :
function kahuna_get_layout_class() {
	global $post;
	if ( get_post() ) { $kahuna_meta_layout = get_post_meta( $post->ID, '_kahuna_layout', true ); }

	if ( isset( $kahuna_meta_layout ) && $kahuna_meta_layout ) {
		$kahuna_sitelayout =  $kahuna_meta_layout;
	}
	else $kahuna_sitelayout = cryout_get_option( 'kahuna_sitelayout' );

	/*  If not, return the general layout */
	switch( $kahuna_sitelayout ) {
		case '2cSl': return "two-columns-left"; break;
		case '2cSr': return "two-columns-right"; break;
		case '3cSl': return "three-columns-left"; break;
		case '3cSr' : return "three-columns-right"; break;
		case '3cSs' : return "three-columns-sided"; break;
		case '1c':
		default: return "one-column"; break;
	}
} // kahuna_get_layout_class()
endif;

/**
* Checks the browser agent string for mobile ids and adds "mobile" class to body if true
* @return array list of classes.
*/
function kahuna_mobile_body_class( $classes ){
	$browser = ( ! empty( $_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
	$keys = 'mobile|android|mobi|tablet|ipad|opera mini|series 60|s60|blackberry';
	if ( preg_match( "/($keys)/i", $browser ) ) : $classes[] = 'mobile'; endif; // mobile browser detected
	return $classes;
} // kahuna_mobile_body_class()
add_filter( 'body_class', 'kahuna_mobile_body_class');


/**
* Creates breadcrumbs with page sublevels and category sublevels.
* Hooked in master hook
*/
if ( ! function_exists( 'kahuna_breadcrumbs' ) ) :
function kahuna_breadcrumbs() {
	cryout_breadcrumbs(
		'<i class="icon-bread-arrow"></i>',						// $separator
		'<i class="icon-bread-home"></i>', 						// $home
		1,														// $showCurrent
		'<span class="current">', 								// $before
		'</span>', 												// $after
		'<div id="breadcrumbs-container" class="cryout %1$s"><div id="breadcrumbs-container-inside"><div id="breadcrumbs"> <nav id="breadcrumbs-nav" %2$s>', // $wrapper_pre
		'</nav></div></div></div><!-- breadcrumbs -->', 		// $wrapper_post
		kahuna_get_layout_class(),								// $layout_class
		__( 'Home', 'kahuna' ),									// $text_home
		__( 'Archive for category', 'kahuna' ),					// $text_archive
		__( 'Search results for', 'kahuna' ), 					// $text_search
		__( 'Posts tagged', 'kahuna' ), 						// $text_tag
		__( 'Articles posted by', 'kahuna' ), 					// $text_author
		__( 'Not Found', 'kahuna' ),							// $text_404
		__( 'Post format', 'kahuna' ),							// $text_format
		__( 'Page', 'kahuna' )									// $text_page
	);
} // kahuna_breadcrumbs()
endif;


/**
 * Adds searchboxes to the appropriate menu location
 * Hooked in master hook
 */
if ( ! function_exists( 'cryout_search_menu' ) ) :
function cryout_search_menu( $items, $args ) {
$options = cryout_get_option( array( 'kahuna_searchboxmain', 'kahuna_searchboxfooter' ) );
	if( $args->theme_location == 'primary' && $options['kahuna_searchboxmain'] ) {
		$container_class = 'menu-main-search';
		$items .= "<li class='" . $container_class . " menu-search-animated'><i class='icon-search'></i>" . get_search_form( false ) . " <i class='icon-cancel'></i></li>";
	}
	if( $args->theme_location == 'footer' && $options['kahuna_searchboxfooter'] ) {
		$container_class = 'menu-footer-search';
		$items .= "<li class='" . $container_class . "'>" . get_search_form( false ) . "</li>";
	}
	return $items;
} // cryout_search_mainmenu()
endif;

/* cryout_schema_microdata() moved to framework in 0.9.9/0.5.6 */

/**
 * Normalizes tags widget font when needed
 */
function kahuna_normalizetags( $tags_html ) {
	$kahuna_normalizetags = cryout_get_option( 'kahuna_normalizetags' );
	if ( $kahuna_normalizetags ) return preg_replace( '/font-size:.*?;/i', '', $tags_html ); else return $tags_html;
};
add_filter( 'wp_generate_tag_cloud', 'kahuna_normalizetags' );


/**
* Master hook to bypass customizer options
*/
if ( ! function_exists( 'kahuna_master_hook' ) ) :
function kahuna_master_hook() {
	$kahuna_interim_options = cryout_get_option( array(
		'kahuna_breadcrumbs',
		'kahuna_searchboxmain',
		'kahuna_searchboxfooter',
		'kahuna_comlabels')
	);
	if ( $kahuna_interim_options['kahuna_breadcrumbs'] )  add_action( 'cryout_breadcrumbs_hook', 'kahuna_breadcrumbs' );
	if ( $kahuna_interim_options['kahuna_searchboxmain'] || $kahuna_interim_options['kahuna_searchboxfooter'] ) add_filter( 'wp_nav_menu_items', 'cryout_search_menu', 10, 2);

	if ( $kahuna_interim_options['kahuna_comlabels'] == 1 ) {
		add_filter( 'comment_form_default_fields', 'kahuna_comments_form' );
		add_filter( 'comment_form_field_comment', 'kahuna_comments_form_textarea' );
	}

	if ( cryout_get_option( 'kahuna_socials_header' ) ) 		add_action( 'cryout_header_socials_hook', 'kahuna_socials_menu_header', 30 );
	if ( cryout_get_option( 'kahuna_socials_footer' ) ) 		add_action( 'cryout_master_footerbottom_hook', 'kahuna_socials_menu_footer', 17 );
	if ( cryout_get_option( 'kahuna_socials_left_sidebar' ) ) 	add_action( 'cryout_before_primary_widgets_hook', 'kahuna_socials_menu_left', 5 );
	if ( cryout_get_option( 'kahuna_socials_right_sidebar' ) ) 	add_action( 'cryout_before_secondary_widgets_hook', 'kahuna_socials_menu_right', 5 );
};
endif;
add_action( 'wp', 'kahuna_master_hook' );


// Boxes image size
function kahuna_lpbox_width( $options = array() ) {

	if ( $options['kahuna_lpboxlayout1'] == 1 ) { $totalwidth = 1920; }
	else { $totalwidth = $options['kahuna_sitewidth']; }
	$options['kahuna_lpboxwidth1'] = intval ( $totalwidth / $options['kahuna_lpboxrow1'] );

	if ( $options['kahuna_lpboxlayout2'] == 1 ) { $totalwidth = 1920; }
	else { $totalwidth = $options['kahuna_sitewidth']; }
	$options['kahuna_lpboxwidth2'] = intval ( $totalwidth / $options['kahuna_lpboxrow2'] );

	return $options;
} // kahuna_lpbox_width()

// Used for the landing page blocks auto excerpts
function kahuna_custom_excerpt( $text = '', $length = 35, $more = '...' ) {
	$raw_excerpt = $text;

	//handle the <!--more--> and <!--nextpage--> tags
	$moretag = false;
	if (strpos( $text, '<!--nextpage-->' )) $explodemore = explode('<!--nextpage-->', $text);
	if (strpos( $text, '<!--more-->' )) $explodemore = explode('<!--more-->', $text);
	if (!empty($explodemore[1])) {
		// tag was found
		$text = $explodemore[0];
		$moretag = true;
	}

	if ( '' != $text ) {
		$text = strip_shortcodes( $text );

		$text = str_replace(']]>', ']]&gt;', $text);

		// Filters the number of words in an excerpt. Default 35.
		$excerpt_length = apply_filters( 'kahuna_custom_excerpt_length', $length );

		if ($excerpt_length == 0) return '';

		// Filters the string in the "more" link displayed after a trimmed excerpt.
		$excerpt_more = apply_filters( 'kahuna_custom_excerpt_more', $more );
		if (!$moretag) {
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
		}
	}
	return apply_filters( 'kahuna_custom_excerpt', $text, $raw_excerpt );
} // kahuna_custom_excerpt()

// kahuna ajax load more button alternative hook
add_action( 'template_redirect', 'cryout_ajax_init' );

/* FIN */
