<?php
/**
 * Theme Defaults
 *
 * @package Kahuna
 */

function kahuna_get_option_defaults() {

	$sample_pages = kahuna_get_default_pages();

	// DEFAULT OPTIONS ARRAY
	$kahuna_defaults = array(

	"kahuna_db" 				=> "0.9",

	"kahuna_sitelayout"			=> "2cSr", // two columns, sidebar right
	"kahuna_layoutalign"		=> 0, 		// 0=wide, 1=boxed
	"kahuna_sitewidth"  		=> 1380, 	// pixels
	"kahuna_primarysidebar"		=> 320, 	// pixels
	"kahuna_secondarysidebar"	=> 380, 	// pixels
	"kahuna_magazinelayout"		=> 2, 		// two columns
	"kahuna_elementpadding" 	=> 0, 		// percent
	"kahuna_footercols"			=> 3, 		// 0, 1, 2, 3, 4
	"kahuna_footeralign"		=> 0,		// default

	"kahuna_landingpage"		=> 1, // 1=enabled, 0=disabled
	"kahuna_lpposts"			=> 2, // 2=static page, 1=posts, 0=disabled
	"kahuna_lpposts_more"		=> 'More Posts',
	"kahuna_lpslider"			=> 1, // 2=shortcode, 1=static, 0=disabled
	"kahuna_lpsliderimage"		=> get_template_directory_uri() . '/resources/images/slider/static.jpg', // static image
	"kahuna_lpslidershortcode"	=> '',
	"kahuna_lpslidertitle"		=> get_bloginfo('name'),
	"kahuna_lpslidertext"		=> get_bloginfo('description'),
	"kahuna_lpslidercta1text"	=> 'Demo',
	"kahuna_lpslidercta1link"	=> '#lp-blocks',
	"kahuna_lpslidercta2text"	=> 'More',
	"kahuna_lpslidercta2link"	=> '#lp-boxes-1',

	"kahuna_lpblockmainttitle"	=> '',
	"kahuna_lpblockmaindesc"	=> '',
	"kahuna_lpblockone"			=> $sample_pages[1],
	"kahuna_lpblockoneicon"		=> 'fire',
	"kahuna_lpblocktwo"			=> $sample_pages[2],
	"kahuna_lpblocktwoicon"		=> 'rocket',
	"kahuna_lpblockthree"		=> $sample_pages[3],
	"kahuna_lpblockthreeicon"	=> 'apartment',
	"kahuna_lpblockfour"		=> 0,
	"kahuna_lpblockfouricon"	=> 'megaphone',
	"kahuna_lpblockscontent"	=> 1, // 0=disabled, 1=excerpt, 2=full
	"kahuna_lpblocksclick"		=> 0,

	"kahuna_lpboxmainttitle1"	=> '',
	"kahuna_lpboxmaindesc1"		=> '',
	"kahuna_lpboxcat1"			=> '',
	"kahuna_lpboxcount1"		=> 6,
	"kahuna_lpboxrow1"			=> 3, // 1-4
	"kahuna_lpboxheight1"		=> 350, // pixels
	"kahuna_lpboxlayout1"		=> 2, // 1=full width, 2=boxed
	"kahuna_lpboxmargins1"		=> 2, // 1=no margins, 2=margins
	"kahuna_lpboxanimation1"	=> 2, // 1=animated, 2=static
	"kahuna_lpboxreadmore1"		=> 'Read More',
	"kahuna_lpboxlength1"		=> 25,

	"kahuna_lpboxmainttitle2"	=> '',
	"kahuna_lpboxmaindesc2"		=> '',
	"kahuna_lpboxcat2"			=> '',
	"kahuna_lpboxcount2"		=> 8,
	"kahuna_lpboxrow2"			=> 4, 	// 1-4
	"kahuna_lpboxheight2"		=> 400, // pixels
	"kahuna_lpboxlayout2"		=> 1, 	// 1=full width, 2=boxed
	"kahuna_lpboxmargins2"		=> 1, 	// 1=no margins, 2=margins
	"kahuna_lpboxanimation2"	=> 1, 	// 1=animated, 2=static
	"kahuna_lpboxreadmore2"		=> 'Read More',
	"kahuna_lpboxlength2"		=> 12,

	"kahuna_lptextone"			=> $sample_pages[1],
	"kahuna_lptexttwo"			=> $sample_pages[2],
	"kahuna_lptextthree"		=> $sample_pages[3],
	"kahuna_lptextfour"			=> $sample_pages[4],

	"kahuna_menuheight"			=> 85, 	// pixels
	"kahuna_menustyle"			=> 1, 	// normal, fixed
	"kahuna_menuposition"		=> 0, 	// normal, on header image
	"kahuna_menulayout"			=> 1, 	// 0=left, 1=right, 2=center
	"kahuna_headerheight" 		=> 350, // pixels
	"kahuna_headerresponsive" 	=> 0, 	// cropped, responsive

	"kahuna_logoupload"			=> '', // empty
	"kahuna_siteheader"			=> 'title', // title, logo, both, empty
	"kahuna_sitetagline"		=> '', // 1= show tagline
	"kahuna_headerwidgetwidth"	=> "33%", // 25%, 33%, 50%, 60%, 100%
	"kahuna_headerwidgetalign"	=> "right", // left, center, right

	"kahuna_fgeneral" 			=> 'Source Sans Pro/gfont',
	"kahuna_fgeneralgoogle" 	=> 'Source Sans Pro:400,300,700',
	"kahuna_fgeneralsize" 		=> '17px',
	"kahuna_fgeneralweight" 	=> '400',

	"kahuna_fsitetitle" 		=> 'Poppins/gfont',
	"kahuna_fsitetitlegoogle"	=> '',
	"kahuna_fsitetitlesize" 	=> '110%',
	"kahuna_fsitetitleweight"	=> '700',
	"kahuna_fmenu" 				=> 'Source Sans Pro/gfont',
	"kahuna_fmenugoogle"		=> '',
	"kahuna_fmenusize" 			=> '90%',
	"kahuna_fmenuweight"		=> '400',

	"kahuna_fwtitle" 			=> 'Poppins/gfont',
	"kahuna_fwtitlegoogle"		=> '',
	"kahuna_fwtitlesize" 		=> '100%',
	"kahuna_fwtitleweight"		=> '700',
	"kahuna_fwcontent" 			=> 'Source Sans Pro/gfont',
	"kahuna_fwcontentgoogle"	=> '',
	"kahuna_fwcontentsize" 		=> '100%',
	"kahuna_fwcontentweight"	=> '400',

	"kahuna_ftitles" 			=> 'Poppins/gfont',
	"kahuna_ftitlesgoogle"		=> '',
	"kahuna_ftitlessize" 		=> '160%',
	"kahuna_ftitlesweight"		=> '700',
	"kahuna_metatitles" 		=> 'Source Sans Pro/gfont',
	"kahuna_metatitlesgoogle"	=> '',
	"kahuna_metatitlessize" 	=> '90%',
	"kahuna_metatitlesweight"	=> '400',
	"kahuna_fheadings" 			=> 'Poppins/gfont',
	"kahuna_fheadingsgoogle"	=> '',
	"kahuna_fheadingssize" 		=> '100%',
	"kahuna_fheadingsweight"	=> '700',

	"kahuna_lineheight"			=> "1.8em",
	"kahuna_textalign"			=> "Default",
	"kahuna_paragraphspace"		=> "1.0em",
	"kahuna_parindent"			=> "0.0em",

	"kahuna_sitebackground" 	=> "#F3F7f5",
	"kahuna_sitetext" 			=> "#777777",
	"kahuna_headingstext" 		=> "#444444",
	"kahuna_contentbackground"	=> "#FFFFFF",
	"kahuna_primarybackground"	=> "",
	"kahuna_secondarybackground"=> "",
	"kahuna_overlaybackground"	=> "#000000",
	"kahuna_overlayopacity"		=> "50",
	"kahuna_menubackground"		=> "#FFFFFF",
	"kahuna_menutext" 			=> "#888888",
	"kahuna_submenutext" 		=> "#888888",
	"kahuna_submenubackground" 	=> "#FFFFFF",
	"kahuna_footerbackground"	=> "#1E2C35",
	"kahuna_footertext"			=> "#BBBBBB",
	"kahuna_lpblocksbg"			=> "#EEEFF0",
	"kahuna_lpboxesbg"			=> "#ECEFF2",
	"kahuna_lptextsbg"			=> "#F7F8F9",
	"kahuna_lppostsbg"			=> "#FFF",
	"kahuna_accent1" 			=> "#8CB65F",
	"kahuna_accent2" 			=> "#44505B",

	"kahuna_breadcrumbs"		=> 1,
	"kahuna_pagination"			=> 1,
	"kahuna_singlenav"			=> 2,
	"kahuna_contenttitles" 		=> 1, // 1, 2, 3, 0
	"kahuna_totop"				=> 'kahuna-totop-normal',
	"kahuna_tables"				=> 'kahuna-stripped-table',
	"kahuna_normalizetags"		=> 1, // 0,1
	"kahuna_copyright"			=> '&copy;'. date_i18n('Y') . ' '. get_bloginfo('name'),

	"kahuna_elementborder" 		=> 0,
	"kahuna_elementshadow" 		=> 0,
	"kahuna_elementborderradius"=> 0,
	"kahuna_articleanimation"	=> 3, // 0=none, 1=fade, 2=slide, 3=zoomin, 4=zoomout

	"kahuna_searchboxmain" 		=> 1,
	"kahuna_searchboxfooter"	=> 0,
	"kahuna_image_style"		=> 'kahuna-image-none',
	"kahuna_caption_style"		=> 'kahuna-caption-one',

	"kahuna_meta_author" 		=> 1,
	"kahuna_meta_date"	 		=> 1,
	"kahuna_meta_time" 			=> 0,
	"kahuna_meta_category" 		=> 1,
	"kahuna_meta_tag" 			=> 0,
	"kahuna_meta_comment" 		=> 1,

	"kahuna_headertitles_posts" 	=> 1,
	"kahuna_headertitles_pages" 	=> 1,
	"kahuna_headertitles_archives"	=> 1,
	"kahuna_headertitles_home"		=> 1,

	"kahuna_comlabels"			=> 1, // 1, 2
	"kahuna_comdate"			=> 2, // 1, 2
	"kahuna_comclosed"			=> 1, // 1, 2, 3, 0
	"kahuna_comformwidth"		=> 0, // pixels

	"kahuna_excerpthome"		=> 'excerpt',
	"kahuna_excerptsticky"		=> 'full',
	"kahuna_excerptarchive"		=> 'excerpt',
	"kahuna_excerptlength"		=> "50",
	"kahuna_excerptdots"		=> " &hellip;",
	"kahuna_excerptcont"		=> "Read more",

	"kahuna_fpost" 				=> 1,
	"kahuna_fauto" 				=> 0,
	"kahuna_fheight"			=> 350,
	"kahuna_fresponsive" 		=> 1, // cropped, responsive
	"kahuna_falign" 			=> "center center",
	"kahuna_fheader" 			=> 1,

	"kahuna_socials_header"			=> 0,
	"kahuna_socials_footer"			=> 0,
	"kahuna_socials_left_sidebar"	=> 0,
	"kahuna_socials_right_sidebar"	=> 0,

	"kahuna_postboxes" 			=> '',

	"kahuna_masonry"			=> 1,
	"kahuna_defer"				=> 1,
	"kahuna_fitvids"			=> 1,
	"kahuna_autoscroll"			=> 1,
	"kahuna_editorstyles"		=> 1,


	); // kahuna_defaults array

	return apply_filters( 'kahuna_option_defaults_array', $kahuna_defaults );
} // kahuna_get_option_defaults()

/* Get sample pages for options defaults */
function kahuna_get_default_pages( $number = 4 ) {
	$block_ids = array( 0, 0, 0, 0, 0 );
	$default_pages = get_pages(
		array(
			'sort_order' => 'desc',
			'sort_column' => 'post_date',
			'number' => $number,
		)
	);
	foreach ( $default_pages as $key => $page ) {
		if ( ! empty ( $page->ID ) ) {
			$block_ids[$key+1] = $page->ID;
		}
		else {
			$block_ids[$key+1] = 0;
		}
	}
	return $block_ids;
} //kahuna_get_default_pages()
