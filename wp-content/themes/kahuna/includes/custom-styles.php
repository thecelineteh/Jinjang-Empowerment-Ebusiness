<?php
/**
 * Master generated style function
 *
 * @package Kahuna
 */

function kahuna_body_classes( $classes ) {
	$options = cryout_get_option( array(
		'kahuna_landingpage', 'kahuna_layoutalign',  'kahuna_image_style', 'kahuna_magazinelayout', 'kahuna_comclosed', 'kahuna_contenttitles', 'kahuna_caption_style',
		'kahuna_elementborder', 'kahuna_elementshadow', 'kahuna_elementborderradius', 'kahuna_totop', 'kahuna_menustyle', 'kahuna_menuposition', 'kahuna_menulayout',
		'kahuna_headerresponsive', 'kahuna_fresponsive', 'kahuna_comlabels', 'kahuna_comdate', 'kahuna_tables', 'kahuna_normalizetags', 'kahuna_articleanimation',
		'kahuna_headertitles_archives',
	) );

	if ( is_front_page() && $options['kahuna_landingpage'] && ('page' == get_option('show_on_front')) ) {
		$classes[] = 'kahuna-landing-page';
	}

	if ( $options['kahuna_layoutalign'] ) $classes[] = 'kahuna-boxed-layout';

	$classes[] = esc_html( $options['kahuna_image_style'] );
	$classes[] = esc_html( $options['kahuna_caption_style'] );
	$classes[] = esc_html( $options['kahuna_totop'] );
	$classes[] = esc_html( $options['kahuna_tables'] );

	if ( $options['kahuna_menustyle'] ) $classes[] = 'kahuna-fixed-menu';
	if ( $options['kahuna_menuposition'] ) $classes[] = 'kahuna-over-menu';
	if ( $options['kahuna_menulayout'] == 0 ) $classes[] = 'kahuna-menu-left';
	if ( $options['kahuna_menulayout'] == 2 ) $classes[] = 'kahuna-menu-center';

	if ( $options['kahuna_headerresponsive'] ) $classes[] = 'kahuna-responsive-headerimage';
			else $classes[] = 'kahuna-cropped-headerimage';

	if ( $options['kahuna_fresponsive'] ) $classes[] = 'kahuna-responsive-featured';
		else $classes[] = 'kahuna-cropped-featured';

	if ( $options['kahuna_magazinelayout'] ) {
		switch ( $options['kahuna_magazinelayout'] ):
			case 1: $classes[] = 'kahuna-magazine-one kahuna-magazine-layout'; break;
			case 2: $classes[] = 'kahuna-magazine-two kahuna-magazine-layout'; break;
			case 3: $classes[] = 'kahuna-magazine-three kahuna-magazine-layout'; break;
		endswitch;
	}
	switch ( $options['kahuna_comclosed'] ) {
		case 2: $classes[] = 'kahuna-comhide-in-posts'; break;
		case 3: $classes[] = 'kahuna-comhide-in-pages'; break;
		case 0: $classes[] = 'kahuna-comhide-in-posts'; $classes[] = 'kahuna-comhide-in-pages'; break;
	}
	if ( $options['kahuna_comlabels'] == 1 ) $classes[] = 'kahuna-comment-placeholder';
	if ( $options['kahuna_comdate'] == 1 ) $classes[] = 'kahuna-comment-date-published';

	if ( kahuna_header_title_check() ) $classes[] = 'kahuna-header-titles';
								 else $classes[] = 'kahuna-normal-titles';

	$kahuna_archive_desc = trim( get_the_archive_description() ); // get_the_archive_description doesn't work with author description
	if ( ( is_archive() || is_search() || is_404() ) && ! is_author() && $options['kahuna_headertitles_archives'] && empty( $kahuna_archive_desc ) ) $classes[] = 'kahuna-header-titles-nodesc';

	switch ( $options['kahuna_contenttitles'] ) {
		case 2: $classes[] = 'kahuna-hide-page-title'; break;
		case 3: $classes[] = 'kahuna-hide-cat-title'; break;
		case 0: $classes[] = 'kahuna-hide-page-title'; $classes[] = 'kahuna-hide-cat-title'; break;
	}

	if ( $options['kahuna_elementborder'] ) $classes[] = 'kahuna-elementborder';
	if ( $options['kahuna_elementshadow'] ) $classes[] = 'kahuna-elementshadow';
	if ( $options['kahuna_elementborderradius'] ) $classes[] = 'kahuna-elementradius';
	if ( $options['kahuna_normalizetags'] ) $classes[] = 'kahuna-normalizedtags';

	switch ( $options['kahuna_articleanimation'] ) {
		case 1: $classes[] = 'kahuna-article-animation-fade'; break;
		case 2: $classes[] = 'kahuna-article-animation-slide'; break;
		case 3: $classes[] = 'kahuna-article-animation-zoomIn'; break;
		case 4: $classes[] = 'kahuna-article-animation-zoomOut'; break;
	}

	return $classes;
}
add_filter( 'body_class', 'kahuna_body_classes' );


/*
 * Dynamic styles for the frontend
 */
function kahuna_custom_styles() {
$options = cryout_get_option();
extract($options);

ob_start();
/////////// LAYOUT DIMENSIONS. ///////////
switch ( $kahuna_layoutalign ) {

	case 0: // wide ?>
			body:not(.kahuna-landing-page) #container, #site-header-main-inside, #colophon-inside, .footer-inside, #breadcrumbs-container-inside, #header-page-title {
				margin: 0 auto;
				max-width: <?php echo esc_html( $kahuna_sitewidth ); ?>px;
			}
			body:not(.kahuna-landing-page) #container {
				max-width: calc( <?php echo esc_html( $kahuna_sitewidth ); ?>px - 4em );
			}
			<?php if ( esc_html( $kahuna_menustyle ) ) { ?> #site-header-main { left: 0; right: 0; } <?php } ?>
	<?php break;

	case 1: // boxed ?>
			#site-wrapper, #site-header-main {
				max-width: <?php echo esc_html( $kahuna_sitewidth ); ?>px;
			}
			<?php if ( esc_html( $kahuna_menustyle ) ) { ?> #site-header-main { left: 0; right: 0; } <?php } ?>
	<?php break;
}

/////////// COLUMNS ///////////
$colPadding = 0; // percent
$sidebarP = absint( $kahuna_primarysidebar );
$sidebarS = absint( $kahuna_secondarysidebar );
?>

#primary 									{ width: <?php echo $sidebarP; ?>px; }
#secondary 									{ width: <?php echo $sidebarS; ?>px; }

#container.one-column .main					{ width: 100%; }
#container.two-columns-right #secondary 	{ float: right; }
#container.two-columns-right .main,
.two-columns-right #breadcrumbs				{ width: calc( <?php echo 100 - (int) $colPadding ?>% - <?php echo $sidebarS; ?>px ); float: left; }
#container.two-columns-left #primary 		{ float: left; }
#container.two-columns-left .main,
.two-columns-left #breadcrumbs				{ width: calc( <?php echo 100 - (int) $colPadding ?>% - <?php echo $sidebarP; ?>px ); float: right; }

#container.three-columns-right #primary,
#container.three-columns-left #primary,
#container.three-columns-sided #primary		{ float: left; }

#container.three-columns-right #secondary,
#container.three-columns-left #secondary,
#container.three-columns-sided #secondary	{ float: left; }

#container.three-columns-right #primary,
#container.three-columns-left #secondary 	{ margin-left: <?php echo esc_html( $colPadding ) ?>%; margin-right: <?php echo esc_html( $colPadding ) ?>%; }
#container.three-columns-right .main,
.three-columns-right #breadcrumbs			{ width: calc( <?php echo 100 - absint( $colPadding ) * 2 ?>% - <?php echo absint( $sidebarS + $sidebarP ); ?>px ); float: left; }
#container.three-columns-left .main,
.three-columns-left #breadcrumbs			{ width: calc( <?php echo 100 - absint( $colPadding ) * 2 ?>% - <?php echo absint( $sidebarS + $sidebarP ); ?>px ); float: right; }

#container.three-columns-sided #secondary 	{ float: right; }

#container.three-columns-sided .main,
.three-columns-sided #breadcrumbs			{ width: calc( <?php echo 100 - absint( $colPadding ) * 2 ?>% - <?php echo absint( $sidebarS + $sidebarP ); ?>px ); float: right; }
.three-columns-sided #breadcrumbs			{ margin: 0 calc( <?php echo absint( $colPadding ) ?>% + <?php echo absint($sidebarS) ?>px ) 0 -1920px; }

<?php if ( in_array( $kahuna_siteheader, array( 'logo', 'empty' ) ) ) { ?>
	#site-text { text-indent: -9999px; }
<?php }

/////////// FONTS ///////////
?>
html
					{ font-family: <?php echo cryout_font_select( $kahuna_fgeneral, $kahuna_fgeneralgoogle ) ?>;
					  font-size: <?php echo esc_html( $kahuna_fgeneralsize ) ?>; font-weight: <?php echo esc_html( $kahuna_fgeneralweight ) ?>;
					  line-height: <?php echo esc_html( (float) $kahuna_lineheight ) ?>; }

#site-title 		{ font-family: <?php echo cryout_font_select( $kahuna_fsitetitle, $kahuna_fsitetitlegoogle ) ?>;
					  font-size: <?php echo esc_html( $kahuna_fsitetitlesize ) ?>; font-weight: <?php echo esc_html( $kahuna_fsitetitleweight ) ?>; }

#access ul li a 	{ font-family: <?php echo cryout_font_select( $kahuna_fmenu, $kahuna_fmenugoogle ) ?>;
					  font-size: <?php echo esc_html( $kahuna_fmenusize ) ?>; font-weight: <?php echo esc_html( $kahuna_fmenuweight ) ?>; }

.widget-title 		{ font-family: <?php echo cryout_font_select( $kahuna_fwtitle, $kahuna_fwtitlegoogle ) ?>;
					  font-size: <?php echo esc_html( $kahuna_fwtitlesize ) ?>; font-weight: <?php echo esc_html( $kahuna_fwtitleweight ) ?>; }
.widget-container 	{ font-family: <?php echo cryout_font_select( $kahuna_fwcontent, $kahuna_fwcontentgoogle ) ?>;
				      font-size: <?php echo esc_html( $kahuna_fwcontentsize ) ?>; font-weight: <?php echo esc_html( $kahuna_fwcontentweight ) ?>; }
.entry-title, .page-title
					{ font-family: <?php echo cryout_font_select( $kahuna_ftitles, $kahuna_ftitlesgoogle ) ?>;
					  font-size: <?php echo esc_html( $kahuna_ftitlessize ) ?>; font-weight: <?php echo esc_html( $kahuna_ftitlesweight ) ?>; }
.entry-meta > span
					{ font-family: <?php echo cryout_font_select( $kahuna_metatitles, $kahuna_metatitlesgoogle ) ?>;
					  font-weight: <?php echo esc_html( $kahuna_metatitlesweight ) ?>; }
/*.post-thumbnail-container*/ .entry-meta > span { font-size: <?php echo esc_html( $kahuna_metatitlessize ) ?>; }
.page-link, .pagination, #author-info #author-link, .comment .reply a, .comment-meta, .byline
					{ font-family: <?php echo cryout_font_select( $kahuna_metatitles, $kahuna_metatitlesgoogle ) ?>; }
.content-masonry .entry-title
 	                { font-size: <?php echo esc_html( (int)$kahuna_ftitlessize * 0.8 ) ?>%; }

					  <?php
$font_root = 2.6; // headings font size root
for ( $i = 1; $i <= 6; $i++ ) {
		$size = round( ( $font_root - ( 0.27 * $i ) ) * ( preg_replace( "/[^\d]/", "", esc_html( $kahuna_fheadingssize ) ) / 100), 5 ); ?>
		h<?php echo $i ?> { font-size: <?php echo $size ?>em; } <?php
} //for ?>
h1, h2, h3, h4, h5, h6 { font-family: <?php echo cryout_font_select( $kahuna_fheadings, $kahuna_fheadingsgoogle ) ?>;
					     font-weight: <?php echo esc_html( $kahuna_fheadingsweight ) ?>; }


<?php
/////////// COLORS ///////////
?>
body 										{ color: <?php echo esc_html( $kahuna_sitetext ) ?>;
											  background-color: <?php echo esc_html( $kahuna_sitebackground ) ?>; }

.lp-staticslider .staticslider-caption-title,
.seriousslider.seriousslider-theme .seriousslider-caption-title,
.lp-staticslider .staticslider-caption-text,
.seriousslider.seriousslider-theme .seriousslider-caption-text,
.lp-staticslider .staticslider-caption-text a
											{ color: <?php echo esc_html( $kahuna_menubackground ); ?>; }

#site-header-main, #access ul ul,
.menu-search-animated .searchform input[type="search"], #access .menu-search-animated .searchform, #access::after,
.kahuna-over-menu .header-fixed#site-header-main, .kahuna-over-menu .header-fixed#site-header-main #access:after
											{ background-color: <?php echo esc_html( $kahuna_menubackground ) ?>; }

#site-header-main 							{ border-bottom-color: rgba(0,0,0,.05); }

.kahuna-over-menu .header-fixed#site-header-main #site-title a
											{ color: <?php echo esc_html( $kahuna_accent1 ) ?>; }

#access > div > ul > li,
#access > div > ul > li > a,
.kahuna-over-menu .header-fixed#site-header-main #access > div > ul > li:not([class*='current']),
.kahuna-over-menu .header-fixed#site-header-main #access > div > ul > li:not([class*='current']) > a,
.kahuna-over-menu .header-fixed#site-header-main #sheader.socials a::before,
#sheader.socials a::before, #access .menu-search-animated .searchform input[type="search"]
											{ color: <?php echo esc_html( $kahuna_menutext ) ?>; }
.kahuna-over-menu .header-fixed#site-header-main #sheader.socials a:hover::before,
#sheader.socials a:hover::before			{ color: <?php echo esc_html( $kahuna_menubackground ) ?>; }

#access ul.sub-menu li a,
#access ul.children li a 					{ color: <?php echo esc_html( $kahuna_submenutext ) ?>; }

#access ul.sub-menu li a,
#access ul.children li a 					{ background-color: <?php echo esc_html( $kahuna_submenubackground ) ?>; }

#access > div > ul > li:hover > a,
#access > div > ul > li a:hover,
#access > div > ul > li:hover,
.kahuna-over-menu .header-fixed#site-header-main #access > div > ul > li > a:hover,
.kahuna-over-menu .header-fixed#site-header-main #access > div > ul > li:hover
											{ color: <?php echo esc_html( $kahuna_accent1 ) ?>; }

#access > div > ul > li > a > span::before,
#site-title::before  						{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
#site-title a:hover 						{ color: <?php echo esc_html( $kahuna_accent1 ) ?>; }

#access > div > ul > li.current_page_item > a,
#access > div > ul > li.current-menu-item > a,
#access > div > ul > li.current_page_ancestor > a,
#access > div > ul > li.current-menu-ancestor > a,
#access .sub-menu, #access .children,
.kahuna-over-menu .header-fixed#site-header-main #access > div > ul > li > a
											{ color: <?php echo esc_html( $kahuna_accent2 ) ?>; }

#access ul.children > li.current_page_item > a,
#access ul.sub-menu > li.current-menu-item > a,
#access ul.children > li.current_page_ancestor > a,
#access ul.sub-menu > li.current-menu-ancestor > a
											{ color: <?php echo esc_html( $kahuna_accent2 ) ?>; }

#access .sub-menu li:not(:last-child) span,
#access .children li:not(:last-child) span	{ border-bottom: 1px solid <?php echo esc_html( cryout_hexdiff( $kahuna_submenubackground, 17 ) ); ?>; }
.searchform .searchsubmit					{ color: <?php echo esc_html( $kahuna_sitetext ) ?>; }

body:not(.kahuna-landing-page) article.hentry, body:not(.kahuna-landing-page) .main
											{ background-color: <?php echo esc_html( $kahuna_contentbackground ) ?>; }
.pagination a, .pagination span 			{ border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ); ?>; }

.page-link a, .page-link span em 			{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ); ?>; }
.pagination a:hover, .pagination span:hover,
.page-link a:hover, .page-link span em:hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ); ?>; }

.post-thumbnail-container .featured-image-meta,
#header-page-title-inside,
.lp-staticslider .staticslider-caption-title span,
.lp-staticslider .staticslider-caption-text span,
.seriousslider.seriousslider-theme .seriousslider-caption-text span
											{ background-color: rgba(<?php echo esc_html( cryout_hex2rgb( $kahuna_overlaybackground ) ) ;?>, <?php echo esc_html( $kahuna_overlayopacity/100 ); ?>); }
.lp-staticslider .staticslider-caption-title span,
.seriousslider.seriousslider-theme .seriousslider-caption-title span
											{ background-color: rgba(<?php echo esc_html( cryout_hex2rgb( $kahuna_accent1 ) ) ;?>, <?php echo esc_html( $kahuna_overlayopacity/100 ); ?>); }
.post-thumbnail-container .featured-image-link::before
											{ background-color: <?php echo esc_html( $kahuna_accent1 ) ;?>; }
#header-page-title .entry-meta .bl_categ a  { background-color: <?php echo esc_html(  $kahuna_accent1 ) ;?>; }
#header-page-title .entry-meta .bl_categ a:hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_accent1, -17 ) ) ;?>; }
<?php if ( ! is_rtl() ):
	if ( $kahuna_sitelayout == '2cSr' || $kahuna_sitelayout == '2cSl' || $kahuna_sitelayout == '3cSs' ) { ?>
	<?php } if ( $kahuna_sitelayout == '3cSr' ) { ?>
	#secondary  { margin-left: 0; }
	#primary  { padding-left: 3%; padding-right: 0; }
	<?php } if ( $kahuna_sitelayout == '3cSl' ) { ?>
	#secondary  { padding-right: 3%; padding-left: 0; }
	#primary  { margin-right: 0; }
		<?php }
endif; ?>
<?php if ( is_rtl() ):
	if ( $kahuna_sitelayout == '2cSr' || $kahuna_sitelayout == '2cSl' || $kahuna_sitelayout == '3cSs' ) { ?>
	<?php } if ( $kahuna_sitelayout == '3cSr' ) { ?>
	body #secondary  { margin-right: 0; }
	body #primary  { padding-right: 3%; padding-left: 0; }
	<?php } if ( $kahuna_sitelayout == '3cSl' ) { ?>
	body #secondary  { padding-left: 3%; padding-right: 3%; }
	body #primary  { margin-left: 0; }
		<?php }
endif; ?>
<?php if ( ! empty( $kahuna_primarybackground ) ) { ?>
	#primary .widget-container				{ padding: 2em; background-color: <?php echo esc_html( $kahuna_primarybackground ) ?>; }
	@media (max-width: 1024px) { .cryout #container #primary .widget-container { padding: 1em; } }
<?php } ?>
<?php if ( ! empty( $kahuna_secondarybackground ) ) { ?>
	#secondary .widget-container			{ padding: 2em; background-color: <?php echo esc_html( $kahuna_secondarybackground ) ?>;}
	@media (max-width: 1024px) { .cryout #container #secondary .widget-container { padding: 1em; } }
<?php } ?>
.widget-title span 							{ border-bottom-color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
#colophon, #footer 							{ background-color: <?php echo esc_html( $kahuna_footerbackground ) ?>;
 											  color: <?php echo esc_html( $kahuna_footertext ) ?>; }
#colophon 	  								{ border-top: 5px solid  <?php echo esc_html(  cryout_hexdiff( $kahuna_footerbackground, 35 ) ) ?> }
#footer-bottom								{ background: <?php echo esc_html (cryout_hexdiff ($kahuna_footerbackground, -5 ) ) ?>; }
.entry-title a:active, .entry-title a:hover { color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
.entry-title a:hover						{ border-top-color:  <?php echo esc_html( $kahuna_accent1 ) ?>; }
span.entry-format 							{ color: <?php echo esc_html( $kahuna_accent1 ) ?>; }

.entry-content h5, .entry-content h6 		{ color: <?php echo esc_html( $kahuna_accent2 ) ?>; }
.entry-content blockquote::before,
.entry-content blockquote::after 			{ color: rgba(<?php echo cryout_hex2rgb( esc_html( $kahuna_sitetext ) ) ?>,0.2); }

.entry-content h1, .entry-content h2,
.entry-content h3, .entry-content h4		{ color: <?php echo esc_html( $kahuna_headingstext ) ?>; }

a 											{ color: <?php echo esc_html( $kahuna_accent1 ); ?>; }
a:hover, .entry-meta span a:hover,
.comments-link a:hover 						{ color: <?php echo esc_html( $kahuna_accent2 ); ?>; }
.entry-meta > span.comments-link 			{ top: <?php echo absint( $kahuna_ftitlessize )/200 ?>em; }

.socials a:before 							{ color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
#sheader.socials a:before 					{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_menubackground, 10 ) ); ?>; }
#sfooter.socials a:before 					{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_footerbackground, 10 ) ); ?>; }
.sidey .socials a:before 					{ background-color: <?php echo esc_html( $kahuna_contentbackground ); ?>; }

#sheader.socials a:hover:before				{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>; color: <?php echo esc_html( $kahuna_menubackground ) ?>; }
#sfooter.socials a:hover:before				{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>; color: <?php echo esc_html( $kahuna_footerbackground ) ?>; }
.sidey a:hover:before	 					{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>; color: <?php echo esc_html( $kahuna_contentbackground ) ?>; }

.kahuna-normalizedtags #content .tagcloud a
											{ color: <?php echo esc_html($kahuna_contentbackground) ?>;
											  background-color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
.kahuna-normalizedtags #content .tagcloud a:hover
											{ background-color: <?php echo esc_html( $kahuna_accent2 ) ?>; }

#nav-fixed i, #nav-fixed a + a 				{ background-color: rgba(<?php echo esc_html( cryout_hex2rgb( cryout_hexdiff( $kahuna_contentbackground, 40 ) ) ) ?>,0.8); }
#nav-fixed a:hover i,
#nav-fixed a:hover + a,
#nav-fixed a + a:hover						{ background-color: rgba(<?php echo esc_html( cryout_hex2rgb( $kahuna_accent1 ) ) ?>,0.8); }
#nav-fixed i, #nav-fixed span				{ color: <?php echo esc_html( $kahuna_contentbackground ) ?>; }
#toTop 										{ color: <?php echo esc_html( $kahuna_accent1 ) ?>;
											  border-color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
#toTop:hover								{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>;
											  color: <?php echo esc_html( $kahuna_sitebackground ) ?>; }
<?php if( $kahuna_totop != 'kahuna-totop-disabled' ) { ?>
	@media (max-width: 800px) {
		.cryout #footer-bottom .footer-inside { padding-top: 2.5em; }
		.cryout .footer-inside #toTop {background-color: <?php echo esc_html( $kahuna_accent1 ) ?>;  color: <?php echo esc_html( $kahuna_sitebackground ) ?>;}
		.cryout .footer-inside #toTop:hover { opacity: 0.8;}
	}
<?php } ?>

a.continue-reading-link, .continue-reading-link::after
 											{ background-color:<?php echo esc_html( $kahuna_accent1 ) ?>; color: <?php echo esc_html( $kahuna_contentbackground ) ?>; }

.entry-meta .icon-metas:before				{ color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -69) ) ?>; }

.kahuna-caption-one .main .wp-caption .wp-caption-text 	{ border-bottom-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }
.kahuna-caption-two .main .wp-caption .wp-caption-text 	{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground,10 ) ) ?>; }

.kahuna-image-one .entry-content img[class*="align"],
.kahuna-image-one .entry-summary img[class*="align"],
.kahuna-image-two .entry-content img[class*='align'],
.kahuna-image-two .entry-summary img[class*='align'] 	{ border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }
.kahuna-image-five .entry-content img[class*='align'],
.kahuna-image-five .entry-summary img[class*='align'] 	{ border-color: <?php echo esc_html( $kahuna_accent1 ); ?>; }

/* diffs */
span.edit-link a.post-edit-link,
span.edit-link a.post-edit-link:hover,
span.edit-link .icon-edit:before			{ color: <?php echo esc_html( $kahuna_sitetext, 19 ) ?>; }

.searchform 								{ border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 20 ) ) ?>; }
#breadcrumbs-container 						{ background-color: <?php echo esc_html( cryout_hexdiff(  $kahuna_contentbackground, 7 ) ) ?>; }
.entry-meta span, .entry-meta a, .entry-utility span, .entry-utility a, .entry-meta time,
#breadcrumbs-nav, #header-page-title .byline, .footermenu ul li span.sep
											{ color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -69) ) ?>; }
.footermenu ul li a:hover 					{ color: <?php echo esc_html( $kahuna_accent1 ); ?>; }
.footermenu ul li a::after 					{ background: <?php echo esc_html( $kahuna_accent1 ); ?>; }
#breadcrumbs-nav a							{ color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -39) ) ?>; }
.entry-meta span.entry-sticky				{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -69) ) ?>;  color: <?php echo esc_html( $kahuna_contentbackground ); ?>; }
#commentform								{ <?php if ( $kahuna_comformwidth ) { echo 'max-width:' . esc_html( $kahuna_comformwidth ) . 'px;';}?>}

code, #nav-below .nav-previous a:before, #nav-below .nav-next a:before
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }
pre, .comment-author
											{ border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }
pre											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 7 ) ) ?>; }
.commentlist .comment-body, .commentlist .pingback
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 10 ) ) ?>; }
.commentlist .comment-body::after			{ border-top-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 10 ) ) ?>; }
article #author-info						{ border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }
.page-header.pad-container					{ border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }
.comment-meta a 							{ color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -99) ) ?>; }
.commentlist .reply a 						{ color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -79) ) ?>;  }
.commentlist .reply a:hover					{ border-bottom-color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
select, input[type], textarea 				{ color: <?php echo esc_html( $kahuna_sitetext ); ?>;
											  border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 22 ) ) ?>; }
.searchform input[type="search"],
.searchform input[type="search"]:hover,
.searchform input[type="search"]:focus		{ background-color: <?php echo esc_html( $kahuna_contentbackground ) ?>; }
input[type]:hover, textarea:hover, select:hover,
input[type]:focus, textarea:focus, select:focus
											{ background: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 10 ) ) ?>; }

button, input[type="button"], input[type="submit"], input[type="reset"]
											{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>;
											  color: <?php echo esc_html( $kahuna_contentbackground ) ?>; }

button:hover, input[type="button"]:hover, input[type="submit"]:hover, input[type="reset"]:hover
											{ background-color: <?php echo esc_html( $kahuna_accent2 ) ?>; }

hr											{ background-color: <?php echo esc_html(cryout_hexdiff($kahuna_contentbackground, 15 ) ) ?>; }

/* woocommerce */
.woocommerce-page #respond input#submit.alt, .woocommerce a.button.alt,
.woocommerce-page button.button.alt, .woocommerce input.button.alt,
.woocommerce #respond input#submit, .woocommerce a.button,
.woocommerce button.button, .woocommerce input.button
											{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>;
											  color: <?php echo esc_html( $kahuna_contentbackground ) ?>;
											  line-height: <?php echo esc_html( (float) $kahuna_lineheight ) ?>; }
.woocommerce #respond input#submit:hover, .woocommerce a.button:hover,
.woocommerce button.button:hover, .woocommerce input.button:hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_accent1, -34 ) ) ?>;
										 	 color: <?php echo esc_html( $kahuna_contentbackground ) ?>;}
.woocommerce-page #respond input#submit.alt, .woocommerce a.button.alt,
.woocommerce-page button.button.alt, .woocommerce input.button.alt
											{ background-color: <?php echo esc_html( $kahuna_accent2 ) ?>;
											  color: <?php echo esc_html( $kahuna_contentbackground ) ?>;
										  	  line-height: <?php echo esc_html( (float) $kahuna_lineheight ) ?>; }
.woocommerce-page #respond input#submit.alt:hover, .woocommerce a.button.alt:hover,
.woocommerce-page button.button.alt:hover, .woocommerce input.button.alt:hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_accent2, -34 ) ) ?>;
											  color: <?php echo esc_html( $kahuna_contentbackground ) ?>;}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active
											{ border-bottom-color: <?php echo esc_html( $kahuna_contentbackground ) ?>; }
.woocommerce #respond input#submit.alt.disabled,
.woocommerce #respond input#submit.alt.disabled:hover,
.woocommerce #respond input#submit.alt:disabled,
.woocommerce #respond input#submit.alt:disabled:hover,
.woocommerce #respond input#submit.alt[disabled]:disabled,
.woocommerce #respond input#submit.alt[disabled]:disabled:hover,
.woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover,
.woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover,
.woocommerce a.button.alt[disabled]:disabled,
.woocommerce a.button.alt[disabled]:disabled:hover,
.woocommerce button.button.alt.disabled,
.woocommerce button.button.alt.disabled:hover,
.woocommerce button.button.alt:disabled,
.woocommerce button.button.alt:disabled:hover,
.woocommerce button.button.alt[disabled]:disabled,
.woocommerce button.button.alt[disabled]:disabled:hover,
.woocommerce input.button.alt.disabled,
.woocommerce input.button.alt.disabled:hover,
.woocommerce input.button.alt:disabled,
.woocommerce input.button.alt:disabled:hover,
.woocommerce input.button.alt[disabled]:disabled,
.woocommerce input.button.alt[disabled]:disabled:hover
											{ background-color: <?php echo esc_html( $kahuna_accent2 ) ?>; }
.woocommerce ul.products li.product .price, .woocommerce div.product p.price,
.woocommerce div.product span.price
											{ color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -50 ) ); ?> }
#add_payment_method #payment,
.woocommerce-cart #payment,
.woocommerce-checkout #payment 				{ background: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 10 ) ) ?>; }

.woocommerce .main .page-title {
	/*font-size: <?php echo round( ( $font_root - ( 3 ) ) / 100 * ( preg_replace( "/[^\d]/", "", esc_html( $kahuna_fheadingssize ) ) / 100), 5 ); ?>em; */
}

/* mobile menu */
nav#mobile-menu 							{ background-color: <?php echo esc_html( $kahuna_menubackground ) ?>; }
#mobile-menu .mobile-arrow 					{ color: <?php echo esc_html( $kahuna_sitetext ) ?>; }

<?php
/////////// LAYOUT ///////////
?>
.main .entry-content, .main .entry-summary 	{ text-align: <?php echo esc_html( $kahuna_textalign ) ?>; }
.main p, .main ul, .main ol, .main dd, .main pre, .main hr
											{ margin-bottom: <?php echo esc_html( $kahuna_paragraphspace ) ?>; }
.main p 									{ text-indent: <?php echo esc_html( $kahuna_parindent ) ?>;}
.main a.post-featured-image 				{ background-position: <?php echo esc_html( $kahuna_falign ) ?>; }

#header-widget-area 						{ width: <?php echo esc_html( $kahuna_headerwidgetwidth ) ?>;
											<?php switch ( esc_html( $kahuna_headerwidgetalign ) ) {
												case 'left': ?> left: 10px; <?php break;
												case 'right': ?> right: 10px; <?php break;
												case 'center': ?>  left: calc(50% - <?php echo esc_html( $kahuna_headerwidgetwidth ) ?> / 2); <?php break;
											} ?> }
.kahuna-stripped-table .main thead th		{ border-bottom-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 22 ) ) ?>; }
.kahuna-stripped-table .main td, .kahuna-stripped-table .main th
 											{ border-top-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 22 ) ) ?>; }
.kahuna-bordered-table .main th, .kahuna-bordered-table .main td
											{ border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 22 ) ) ?>; }
.kahuna-stripped-table .main tr:nth-child(even) td
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 9 ) ) ?>; }
<?php if ( $kahuna_fpost && ( $kahuna_fheight > 0 ) ) { ?>
.kahuna-cropped-featured .main .post-thumbnail-container
											{ height: <?php echo esc_html( $kahuna_fheight ) ?>px; }
.kahuna-responsive-featured .main .post-thumbnail-container
											{ max-height: <?php echo esc_html( $kahuna_fheight ) ?>px; height: auto; }
<?php } ?>

<?php
/////////// SOME CONDITIONAL CLEANUP ///////////
if ( empty( $kahuna_contentbackground ) ) {  ?> #primary, #colophon { border: 0; box-shadow: none; } <?php }

/////////// ELEMENTS PADDING ///////////
?>

article.hentry .article-inner,
#content-masonry article.hentry .article-inner {
		padding: <?php echo esc_html( $kahuna_elementpadding ) ?>%;
}

<?php if ( $kahuna_elementpadding ) { ?>

#breadcrumbs-nav,
body.woocommerce.woocommerce-page #breadcrumbs-nav,
.pad-container  							{ padding: <?php echo esc_html( $kahuna_elementpadding ) ?>%; }

.kahuna-magazine-two.archive #breadcrumbs-nav,
.kahuna-magazine-two.archive .pad-container,
.kahuna-magazine-two.search #breadcrumbs-nav,
.kahuna-magazine-two.search .pad-container
											{ padding: <?php echo esc_html( $kahuna_elementpadding/2 ) ?>%; }

.kahuna-magazine-three.archive #breadcrumbs-nav,
.kahuna-magazine-three.archive .pad-container,
.kahuna-magazine-three.search #breadcrumbs-nav,
.kahuna-magazine-three.search .pad-container
											{ padding: <?php echo esc_html( $kahuna_elementpadding/3 ) ?>%; }
<?php } // kahuna_elementpadding

/////////// HEADER LAYOUT ///////////
?>
#site-header-main 							{ height:<?php echo intval( $kahuna_menuheight ) ?>px; }
#access .menu-search-animated .searchform 	{ height: <?php echo intval( $kahuna_menuheight - 1 ) ?>px;
											  line-height: <?php echo intval( $kahuna_menuheight - 1 ) ?>px; }
.menu-search-animated, #sheader-container, .identity, #nav-toggle
											{ height:<?php echo intval( $kahuna_menuheight ) ?>px;
											  line-height:<?php echo intval( $kahuna_menuheight ) ?>px; }
#access div > ul > li > a 					{ line-height:<?php echo intval( $kahuna_menuheight ) ?>px; }
#branding		 							{ height:<?php echo intval( $kahuna_menuheight ) ?>px; }
.kahuna-responsive-headerimage #masthead #header-image-main-inside
											{ max-height: <?php echo esc_html( $kahuna_headerheight ) ?>px; }
.kahuna-cropped-headerimage #masthead #header-image-main-inside
											{ height: <?php echo esc_html( $kahuna_headerheight ) ?>px; }
<?php if ( is_front_page() && function_exists( 'the_custom_header_markup' ) && has_header_video() ) { ?>
	.kahuna-responsive-headerimage #masthead #header-image-main-inside
											{ max-height: none; }
	.kahuna-cropped-headerimage #masthead #header-image-main-inside
											{ height: auto; }
<?php } ?>
<?php if ( $kahuna_sitetagline ) {?> #site-description { display: block; } <?php } ?>
<?php if (! display_header_text() ) { ?>
	#site-text 								{ display: none; }
<?php }; ?>
<?php if ( esc_html( $kahuna_menustyle ) ) { ?>
	#masthead #site-header-main 			{ position: fixed; }
<?php }; ?>
<?php if ( ! esc_html( $kahuna_menuposition ) ) { ?>
	#header-image-main						{ margin-top: <?php echo intval( $kahuna_menuheight ) ?>px; }
<?php }; ?>
<?php if ( esc_html( $kahuna_menuposition ) ) { ?>
	#header-widget-area						{ top: <?php echo intval( $kahuna_menuheight )+10 ?>px; }
<?php }; ?>
<?php
$header_image = kahuna_header_image_url();
if ( empty( $header_image ) ) { ?>
@media (min-width: 1152px) {
	<?php if ( esc_html( $kahuna_menuposition ) ) { ?>
	body:not(.kahuna-landing-page) #site-wrapper
											{ margin-top: <?php echo intval( $kahuna_menuheight ) ?>px; }
	<?php } ?>
	body:not(.kahuna-landing-page) #masthead
											{ border-bottom: 1px solid <?php echo esc_html( cryout_hexdiff( $kahuna_menubackground, 17 ) ); ?>; }
}
<?php }; ?>
@media (max-width: 640px) {
	#header-page-title .entry-title { font-size: <?php echo absint( $kahuna_ftitlessize - 20 ) ?>%; }
}

<?php
/////////// lANDING PAGE ///////////
?>
.lp-staticslider .staticslider-caption,
.seriousslider.seriousslider-theme .seriousslider-caption,
.kahuna-landing-page .lp-blocks-inside,
.kahuna-landing-page .lp-boxes-inside,
.kahuna-landing-page .lp-text-inside,
.kahuna-landing-page .lp-posts-inside,
.kahuna-landing-page .lp-page-inside,
.kahuna-landing-page .lp-section-header,
.kahuna-landing-page .content-widget		{ max-width: <?php echo esc_html( $kahuna_sitewidth ) ?>px;	}
.kahuna-landing-page .content-widget 		{ margin: 0 auto; }

.lp-staticslider-image 						{ max-height: calc(100vh - <?php echo intval( $kahuna_menuheight ) ?>px); }

a.staticslider-button:nth-child(2n+1),
.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n+1)
											{ background-color: <?php echo esc_html( $kahuna_accent1 ) ?>;
											  color: <?php echo esc_html( $kahuna_contentbackground ); ?>;
											  border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_accent1, 25) ) ?>; }
.staticslider-button:nth-child(2n+1):hover,
.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n+1):hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_accent1, 25) ) ?>; }
a.staticslider-button:nth-child(2n),
.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n)
											{ color: <?php echo esc_html( $kahuna_accent2 ) ?>;
											  background-color: <?php echo esc_html( $kahuna_contentbackground ) ?>;
											  border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 25) ) ?>; }
a.staticslider-button:nth-child(2n):hover,
.seriousslider-theme .seriousslider-caption-buttons a:nth-child(2n):hover
											{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 25) ) ?>; }

<?php if ( $kahuna_lpslider == 3 ) { ?> .kahuna-landing-page #header-image-main-inside { display: block; } <?php } ?>
.lp-block 									{ background: <?php echo esc_html( $kahuna_contentbackground ); ?>; }
.lp-block:hover 							{ box-shadow: 0 0 20px rgba(<?php echo esc_html( cryout_hex2rgb( cryout_hexdiff( $kahuna_contentbackground, 255 ) ) ) ;?>, 0.15); }
.lp-block > i::before 						{ color: <?php echo esc_html( $kahuna_contentbackground ); ?>;
											  border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_accent1, 15 ) ); ?>;
											  background-color: <?php echo esc_html( $kahuna_accent1 ); ?>; }
.lp-block:hover i::before 					{ background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_accent1, 15 ) ); ?>; }
.lp-block i:after 							{ background-color: <?php echo esc_html( $kahuna_accent1 ); ?>; }
.lp-block:hover i:after 					{ background-color: <?php echo esc_html( $kahuna_accent2); ?>; }
.lp-block-text, .lp-boxes-static .lp-box-text,
.lp-section-desc 							{ color: <?php echo esc_html( cryout_hexdiff( $kahuna_sitetext, -40 ) ) ?>; }
.lp-blocks 									{ background-color: <?php echo esc_html( $kahuna_lpblocksbg ) ?>; }
.lp-boxes 									{ background-color: <?php echo esc_html( $kahuna_lpboxesbg ) ?>; }
.lp-text 									{ background-color: <?php echo esc_html( $kahuna_lptextsbg ) ?>; }
.lp-boxes-static .lp-box:hover 				{ box-shadow: 0 0 20px rgba(<?php echo esc_html( cryout_hex2rgb( cryout_hexdiff( $kahuna_contentbackground, 255 ) ) ) ;?>, 0.15); }
.lp-boxes-static .lp-box-image::after 		{ background-color: <?php echo esc_html( $kahuna_accent1 ); ?>; }
.lp-boxes-static .lp-box-image .box-overlay	{ background-color: <?php echo  esc_html( cryout_hexdiff( $kahuna_accent1, -20 ) ); ?>; }
.lp-box-titlelink:hover 					{ color:  <?php echo esc_html( $kahuna_accent1 ) ?>; }
.lp-boxes-1 .lp-box .lp-box-image 			{ height: <?php echo intval ( (int) $kahuna_lpboxheight1 ); ?>px; }
.lp-boxes-animated.lp-boxes-1 .lp-box:hover .lp-box-text
											{ max-height: <?php echo intval ( (int) $kahuna_lpboxheight1 - 100 ); ?>px; }
.lp-boxes-2 .lp-box .lp-box-image 			{ height: <?php echo intval ( (int) $kahuna_lpboxheight2 ); ?>px; }
.lp-boxes-animated.lp-boxes-2 .lp-box:hover .lp-box-text
											{ max-height: <?php echo intval ( (int) $kahuna_lpboxheight2 - 100 ); ?>px; }
.lp-box-readmore:hover 						{ color: <?php echo esc_html( $kahuna_accent1 ) ?>; }
#lp-posts, #lp-page 						{ background-color: <?php echo esc_html( $kahuna_lppostsbg ) ?>; }
<?php
for ($i=1; $i<=8; $i++) { ?>
	.lpbox-rnd<?php echo $i ?> { background-color:  <?php echo esc_html( cryout_hexdiff( $kahuna_lpboxesbg, 50+5*$i ) ) ?>; }
<?php }

	return apply_filters( 'kahuna_custom_styles', ob_get_clean() );
} // kahuna_custom_styles()


/*
 * Dynamic styles for the admin MCE Editor
 */
function kahuna_editor_styles() {
	header( 'Content-type: text/css' );
	$options = cryout_get_option();
	extract($options);

	switch ( $kahuna_sitelayout ) {
		case '1c':
			$kahuna_primarysidebar = $kahuna_secondarysidebar = 0;
			break;
		case '2cSl':
			$kahuna_secondarysidebar = 0;
			break;
		case '2cSr':
			$kahuna_primarysidebar = 0;
			break;
		default:
			break;
	}
	$content_body = floor( (int) $kahuna_sitewidth - ( (int) $kahuna_primarysidebar + (int) $kahuna_secondarysidebar ) );

	ob_start();
?>
body {
	max-width: <?php echo esc_html( $content_body ); ?>px;
	font-family: <?php echo cryout_font_select( $kahuna_fgeneral, $kahuna_fgeneralgoogle ) ?>;
	font-size: <?php echo esc_html( $kahuna_fgeneralsize ) ?>; font-weight: <?php echo esc_html( $kahuna_fgeneralweight ) ?>;
	line-height: <?php echo esc_html( (float) $kahuna_lineheight ) ?>;
	color: <?php echo esc_html( $kahuna_sitetext ); ?>;
	background-color: <?php echo esc_html( $kahuna_contentbackground ) ?>	}
	<?php
$font_root = 2.6; // headings font size root
for ( $i = 1; $i <= 6; $i++ ) {
$size = round( ( $font_root - ( 0.27 * $i ) ) * ( preg_replace( "/[^\d]/", "", esc_html( $kahuna_fheadingssize ) ) / 100), 5 ); ?>
h<?php echo $i ?> { font-size: <?php echo $size ?>em; } <?php
} //for ?>
h1, h2, h3, h4, h5, h6 {
	font-family: <?php echo cryout_font_select( $kahuna_fheadings, $kahuna_fheadingsgoogle ) ?>;
	font-weight: <?php echo esc_html( $kahuna_fheadingsweight ) ?>; }

blockquote::before, blockquote::after {
	color: rgba(<?php echo cryout_hex2rgb( esc_html( $kahuna_sitetext ) ) ?>,0.1); }

a 		{ color: <?php echo esc_html( $kahuna_accent1 ); ?>; }
a:hover	{ color: <?php echo esc_html( $kahuna_accent2 ); ?>; }

code	{ background-color: <?php echo esc_html(cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }
pre		{ border-color: <?php echo esc_html(cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?>; }

select, input[type], textarea {
	color: <?php echo esc_html( $kahuna_sitetext ); ?>;
	background-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 10 ) ) ?>;
	border-color: <?php echo esc_html( cryout_hexdiff( $kahuna_contentbackground, 17 ) ) ?> }

p, ul, ol, dd,
pre, hr { margin-bottom: <?php echo esc_html( $kahuna_paragraphspace ) ?>; }
p { text-indent: <?php echo esc_html( $kahuna_parindent ) ?>;}

<?php // end </style>
echo apply_filters( 'kahuna_editor_styles', ob_get_clean() );
} // kahuna_editor_styles()


/* FIN */
