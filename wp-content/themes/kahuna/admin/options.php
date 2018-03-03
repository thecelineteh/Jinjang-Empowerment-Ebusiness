<?php
/**
 * Customizer settings and other theme related settings (fonts arrays, widget areas)
 *
 * @package Kahuna
 */

/* active_callback for controls that depend on other controls' values */
function kahuna_conditionals( $control ) {

	$conditionals = array(
		array(
			'id'	=> 'kahuna_lpsliderimage',
			'parent'=> 'kahuna_lpslider',
			'value'	=> 1,
		),
		array(
			'id'	=> 'kahuna_lpslidershortcode',
			'parent'=> 'kahuna_lpslider',
			'value'	=> 2,
		),
		array(
			'id'	=> 'kahuna_lpsliderserious',
			'parent'=> 'kahuna_lpslider',
			'value' => 4,
		),
		array(
			'id'    => 'kahuna_lpposts',
			'parent'=> 'kahuna_landingpage',
			'value' => 1,
		),
		array(
			'id'    => 'kahuna_lpposts_more',
			'parent'=> 'kahuna_lpposts',
			'value' => 1,
		),
	);

	foreach ($conditionals as $elem) {
		if ( $control->id == 'kahuna_settings['.$elem['id'].']' && $control->manager->get_setting('kahuna_settings['.$elem['parent'].']')->value() == $elem['value'] ) return true;
	};

	if ( ($control->id == "kahuna_settings[kahuna_landingpage_notice]") && ('posts' == get_option('show_on_front')) ) return true;

    return false;

} // kahuna_conditionals()

$kahuna_big = array(

/************* general info ***************/

'info_sections' => array(
	'cryoutspecial-about-theme' => array(
		'title' => __( 'About', 'cryout' ) . ' ' . ucwords(_CRYOUT_THEME_NAME),
		'desc' => '<img src=" ' . get_template_directory_uri() . '/admin/images/logo-about-header.png" >',
	),
), // info_sections

'info_settings' => array(
	'support_link_faqs' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/wordpress-themes/' . _CRYOUT_THEME_NAME . '" target="_blank">%s</a>', __( 'Read the Docs', 'cryout' ) ),
		'desc' =>  '',
		'section' => 'cryoutspecial-about-theme',
	),
	'support_link_forum' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/forums/f/wordpress/' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '" target="_blank">%s</a>', __( 'Browse the Forum', 'cryout' ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
	'premium_support_link' => array(
		'label' => '',
		'default' => sprintf( '<a href="https://www.cryoutcreations.eu/priority-support" target="_blank">%s</a>', __( 'Priority Support', 'cryout' ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
	'rating_url' => array(
		'label' => '&nbsp;',
		'default' => sprintf( '<a href="https://wordpress.org/support/view/theme-reviews/'. cryout_sanitize_tn( _CRYOUT_THEME_NAME ).'#postform" target="_blank">%s</a>', sprintf( __( 'Rate %s on WordPress.org', 'cryout' ) , ucwords(_CRYOUT_THEME_NAME) ) ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
	'management' => array(
		'label' => '&nbsp;',
		'default' => sprintf( '<a href="themes.php?page=about-' . cryout_sanitize_tn( _CRYOUT_THEME_NAME ) . '-theme">%s</a>', __('Manage Theme Settings', 'cryout') ),
		'desc' => '',
		'section' => 'cryoutspecial-about-theme',
	),
), // info_settings

'panel_overrides' => array(
	'background' => array(
        'title' => __( 'Background', 'cryout' ),
		'desc' => __( 'Background Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-kahuna_siteidentity',
		'replaces' => 'background_image',
		'type' => 'section',
	),
	'kahuna_header_section' => array(
		'title' => __( 'Header Image', 'cryout' ),
		'desc' => __( 'Header Image Settings.', 'cryout' ),
		'priority' => 50,
		'section' => 'cryoutoverride-kahuna_siteidentity',
		'replaces' => 'header_image',
		'type' => 'section',
	),
	'identity' => array(
		'title' => __( 'Site Identity', 'cryout' ),
		'desc' => '',
		'priority' => 50,
		'section' => 'cryoutoverride-kahuna_siteidentity',
		'replaces' => 'title_tagline',
		'type' => 'section',
	),
	'colors' => array(
		'section' => 'section',
		'replaces' => 'colors',
		'type' => 'remove',
	),

), // panel_overrides

/************* panels *************/

'panels' => array(

	array('id'=>'kahuna_siteidentity', 'title'=>__('Site Identity','kahuna'), 'callback'=>'', 'identifier'=>'cryoutoverride-' ),
	array('id'=>'kahuna_landingpage', 'title'=>__('Landing Page','kahuna'), 'callback'=>'' ),
	array('id'=>'kahuna_general_section', 'title'=>__('General','kahuna') , 'callback'=>'' ),
	array('id'=>'kahuna_colors_section', 'title'=>__('Colors','kahuna'), 'callback'=>'' ),
	array('id'=>'kahuna_text_section', 'title'=>__('Typography','kahuna'), 'callback'=>'' ),
	array('id'=>'kahuna_post_section', 'title'=>__('Post Information','kahuna') , 'callback'=>'' ),

), // panels

/************* sections *************/

'sections' => array(

	// layout
	array('id'=>'kahuna_layout', 'title'=>__('Layout', 'kahuna'), 'callback'=>'', 'sid'=>'', 'priority'=>51 ),
	// header
	array('id'=>'kahuna_siteheader', 'title'=>__('Header','kahuna'), 'callback'=>'', 'sid'=> '', 'priority'=>52 ),
	// landing page
	array('id'=>'kahuna_lpgeneral', 'title'=>__('Settings','kahuna'), 'callback'=>'', 'sid'=>'kahuna_landingpage', ),
	array('id'=>'kahuna_lpslider', 'title'=>__('Slider','kahuna'), 'callback'=>'', 'sid'=>'kahuna_landingpage', ),
	array('id'=>'kahuna_lpblocks', 'title'=>__('Featured Icon Blocks','kahuna'), 'callback'=>'', 'sid'=>'kahuna_landingpage', ),
	array('id'=>'kahuna_lpboxes1', 'title'=>__('Featured Boxes Top','kahuna'), 'callback'=>'', 'sid'=>'kahuna_landingpage', ),
	array('id'=>'kahuna_lpboxes2', 'title'=>__('Featured Boxes Bottom','kahuna'), 'callback'=>'', 'sid'=>'kahuna_landingpage', ),
	array('id'=>'kahuna_lptexts', 'title'=>__('Text Areas','kahuna'), 'callback'=>'', 'sid'=>'kahuna_landingpage', ),
	// text
	array('id'=>'kahuna_fontfamily', 'title'=>__('General Font','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_text_section'),
	array('id'=>'kahuna_fontheader', 'title'=>__('Header Fonts','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_text_section'),
	array('id'=>'kahuna_fontwidget', 'title'=>__('Widget Fonts','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_text_section'),
	array('id'=>'kahuna_fontcontent', 'title'=>__('Content Fonts','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_text_section'),
	array('id'=>'kahuna_textformatting', 'title'=>__('Formatting','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_text_section'),
	// general
	array('id'=>'kahuna_contentstructure', 'title'=>__('Structure','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_general_section'),
	array('id'=>'kahuna_contentgraphics', 'title'=>__('Decorations','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_general_section'),
	array('id'=>'kahuna_headertitles', 'title'=>__('Header Titles','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_general_section'),
	array('id'=>'kahuna_postimage', 'title'=>__('Content Images','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_general_section'),
	array('id'=>'kahuna_searchbox', 'title'=>__('Search Box Locations','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_general_section'),
	array('id'=>'kahuna_socials', 'title'=>__('Social Icons','kahuna'), 'callback'=>'', 'sid'=>'kahuna_general_section'),
	// colors
	array('id'=>'kahuna_colors', 'title'=>__('Content','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_colors_section'),
	array('id'=>'kahuna_colors_header', 'title'=>__('Header','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_colors_section'),
	array('id'=>'kahuna_colors_footer', 'title'=>__('Footer','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_colors_section'),
	array('id'=>'kahuna_colors_lp', 'title'=>__('Landing Page','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_colors_section'),
	// post info
	array('id'=>'kahuna_featured', 'title'=>__('Featured Image', 'kahuna'), 'callback'=>'', 'sid'=>'kahuna_post_section'),
	array('id'=>'kahuna_metas', 'title'=>__('Meta Information','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_post_section'),
	array('id'=>'kahuna_excerpts', 'title'=>__('Excerpts','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_post_section'),
	array('id'=>'kahuna_comments', 'title'=>__('Comments','kahuna'), 'callback'=>'', 'sid'=> 'kahuna_post_section'),
	// post excerpt
	array('id'=>'kahuna_excerpthome', 'title'=>__('Home Page','kahuna'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'kahuna_excerptsticky', 'title'=>__('Sticky Posts','kahuna'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'kahuna_excerptarchive', 'title'=>__('Archive and Category Pages','kahuna'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'kahuna_excerptlength', 'title'=>__('Post Excerpt Length ','kahuna'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'kahuna_excerptdots', 'title'=>__('Excerpt suffix','kahuna'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	array('id'=>'kahuna_excerptcont', 'title'=>__('Continue reading link text ','kahuna'), 'callback'=>'', 'sid'=> 'excerpt_section'),
	// misc
	array('id'=>'kahuna_misc', 'title'=>__('Miscellaneous','kahuna'), 'callback'=>'', 'sid'=>'', 'priority'=>82 ),

	/*** developer options ***/
	//array('id'=>'kahuna_developer', 'title'=>__('[ Developer Options ]','kahuna'), 'callback'=>'', 'sid'=>'', 'priority'=>101 ),

), // sections

/************ clone options *********/
'clones' => array (
	'kahuna_lpboxes' => 2,
),

/************* settings *************/

'options' => array (
	//////////////////////////////////////////////////// Layout ////////////////////////////////////////////////////
	array(
	'id' => 'kahuna_sitelayout',
		'type' => 'radioimage',
		'label' => __('Main Layout','kahuna'),
		'choices' => array(
			'1c' => array(
				'label' => __("One column (no sidebars)","kahuna"),
				'url'   => '%s/admin/images/1c.png'
			),
			'2cSr' => array(
				'label' => __("Two columns, sidebar on the right","kahuna"),
				'url'   => '%s/admin/images/2cSr.png'
			),
			'2cSl' => array(
				'label' => __("Two columns, sidebar on the left","kahuna"),
				'url'   => '%s/admin/images/2cSl.png'
			),
			'3cSr' => array(
				'label' => __("Three columns, sidebars on the right","kahuna"),
				'url'   => '%s/admin/images/3cSr.png'
			),
			'3cSl' => array(
				'label' => __("Three columns, sidebars on the left","kahuna"),
				'url'   => '%s/admin/images/3cSl.png'
			),
			'3cSs' => array(
				'label' => __("Three columns, one sidebar on each side","kahuna"),
				'url'   => '%s/admin/images/3cSs.png'
			),
		),
		'desc' => '',
	'section' => 'kahuna_layout' ),
	array(
	'id' => 'kahuna_layoutalign',
		'type' => 'select',
		'label' => __('Theme alignment','kahuna'),
		'values' => array( 0, 1 ),
		'labels' => array( __('Wide','kahuna'), __('Boxed','kahuna') ),
		'desc' => "",
	'section' => 'kahuna_layout' ),
	array(
	'id' => 'kahuna_sitewidth',
		'type' => 'slider',
		'label' => __('Site Width','kahuna'),
		'min' => 960, 'max' => 1920, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'kahuna_layout' ),
	array(
	'id' => 'kahuna_primarysidebar',
		'type' => 'slider',
		'label' => __('Left Sidebar Width','kahuna'),
		'min' => 200, 'max' => 600, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'kahuna_layout' ),
	array(
	'id' => 'kahuna_secondarysidebar',
		'type' => 'slider',
		'label' => __('Right Sidebar Width','kahuna'),
		'min' => 200, 'max' => 600, 'step' => 10, 'um' => 'px',
		'desc' => "",
	'section' => 'kahuna_layout' ),

	array(
	'id' => 'kahuna_magazinelayout',
		'type' => 'radioimage',
		'label' => __('Posts Layout','kahuna'),
		'choices' => array(
			1 => array(
				'label' => __("One column","kahuna"),
				'url'   => '%s/admin/images/magazine-1col.png'
			),
			2 => array(
				'label' => __("Two columns","kahuna"),
				'url'   => '%s/admin/images/magazine-2col.png'
			),
			3 => array(
				'label' => __("Three columns","kahuna"),
				'url'   => '%s/admin/images/magazine-3col.png'
			),
		),
		'desc' => '',
	'section' => 'kahuna_layout' ),
	array(
	'id' => 'kahuna_elementpadding',
		'type' => 'select',
		'label' => __('Post/page padding','kahuna'),
		'values' => cryout_gen_values( 0, 10, 1, array('um'=>'') ),
		'labels' => cryout_gen_values( 0, 10, 1, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_layout' ),

	array(
	'id' => 'kahuna_footercols',
		'type' => 'select',
		'label' => __("Footer Widgets Columns","kahuna"),
		'values' => array(0, 1, 2, 3, 4),
		'labels' => array( 
			__('All in a row','kahuna'),
			__('1 Column','kahuna'),
			__('2 Columns','kahuna'),
			__('3 Columns','kahuna'),
			__('4 Columns','kahuna') 
		),
		'desc' => '',
	'section' => 'kahuna_layout' ),
	array(
	'id' => 'kahuna_footeralign',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Default","kahuna"), __("Center","kahuna") ),
		'label' => __('Footer Widgets Alignment','kahuna'),
		'desc' => "",
	'section' => 'kahuna_layout' ),

	// Header
	array(
	'id' => 'kahuna_menuheight',
		'type' => 'number',
		'min' => 45,
		'max' => 200,
		'label' => __('Header/Menu Height','kahuna'),
		'desc' => "",
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_menustyle',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Disabled","kahuna"), __("Enabled","kahuna") ),
		'label' => __('Fixed Menu','kahuna'),
		'desc' => "",
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_menuposition',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Normal","kahuna"), __("Over header image","kahuna") ),
		'label' => __('Menu Position','kahuna'),
		'desc' => "",
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_menulayout',
		'type' => 'select',
		'values' => array( 0, 1, 2 ),
		'labels' => array( __("Left", "kahuna"), __("Right","kahuna"), __("Center","kahuna") ),
		'label' => __('Menu Layout','kahuna'),
		'desc' => "",
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_headerheight',
		'type' => 'number',
		'min' => 0,
		'max' => 800,
		'label' => __('Header Image Height (in pixels)','kahuna'),
		'desc' => '',
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_headerheight_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","kahuna"),
		//'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_headerresponsive',
		'type' => 'select',
		'values' => array( 0, 1 ),
		'labels' => array( __("Cropped","kahuna"), __("Contained","kahuna") ),
		'label' => __('Header Image Behaviour','kahuna'),
		'desc' => "",
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_siteheader',
		'type' => 'select',
		'label' => __('Site Header Content','kahuna'),
		'values' => array( 'title' , 'logo' , 'both' , 'empty' ),
		'labels' => array( __("Site Title","kahuna"), __("Logo","kahuna"), __("Logo & Site Title","kahuna"), __("Empty","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_sitetagline',
		'type' => 'checkbox',
		'label' => __('Show Tagline','kahuna'),
		'desc' => '',
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_logoupload',
		'type' => 'media-image',
		'label' => __('Logo Image','kahuna'),
		'desc' => '',
		'disable_if' => 'the_custom_logo',
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_headerwidgetwidth',
		'type' => 'select',
		'label' => __("Header Widget Width","kahuna"),
		'values' => array( "100%" , "60%" , "50%" , "33%" , "25%" ),
		'desc' => '',
	'section' => 'kahuna_siteheader' ),
	array(
	'id' => 'kahuna_headerwidgetalign',
		'type' => 'select',
		'label' => __("Header Widget Alignment","kahuna"),
		'values' => array( 'left' , 'center' , 'right' ),
		'labels' => array( __("Left","kahuna"), __("Center","kahuna"), __("Right","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_siteheader' ),

	//////////////////////////////////////////////////// Landing Page ////////////////////////////////////////////////////
	array(
	'id' => 'kahuna_landingpage',
		'type' => 'select',
		'label' => __('Landing Page','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","kahuna"), __("Disabled (use WordPress homepage)","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_lpgeneral' ),
	array(
	'id' => 'kahuna_landingpage_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => sprintf( __( "To activate the Landing Page, make sure to set the WordPress <strong>Front Page displays</strong> option to %s","kahuna" ), "<a data-type='section' data-id='static_front_page' class='cryout-customizer-focus'><strong>" . __("use a static page", "kahuna") . " &raquo;</strong></a>" ),
		'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_lpgeneral' ),
	array(
	'id' => 'kahuna_lpposts',
		'type' => 'select',
		'label' => __('Featured Content','kahuna'),
		'values' => array( 2, 1, 0 ),
		'labels' => array( __("Static Page", "kahuna"), __("Posts", "kahuna"), __("Disabled", "kahuna") ),
		'desc' => '',
		'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_lpgeneral' ),
	array(
	'id' => 'kahuna_lpposts_more',
		'type' => 'text',
		'label' => __( 'More Posts Label', 'kahuna' ),
		'desc' => '',
		'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_lpgeneral' ),

	// slider
	array(
	'id' => 'kahuna_lpslider',
		'type' => 'select',
		'label' => __('Slider','kahuna'),
		'values' => array( 4, 2, 1, 3, 0 ),
		'labels' => array( 
			__("Serious Slider", "kahuna"),
			__("Use Shortcode","kahuna"),
			__("Static Image","kahuna"),
			__("Header Image","kahuna"),
			__("Disabled","kahuna")
		),
		'desc' => sprintf( __("To create an advanced slider, use our <a href='%s' target='_blank'>Serious Slider</a> plugin or any other slider plugin.","kahuna"), 'https://wordpress.org/plugins/cryout-serious-slider/' ),
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpsliderimage',
		'type' => 'media-image',
		'label' => __('Slider Image','kahuna'),
		'desc' => __('The default image can be replaced by setting a new static image.', 'kahuna'),
		'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpsliderlink',
		'type' => 'url',
		'label' => __('Slider Link','kahuna'),
		'desc' => '',
		'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpslidershortcode',
		'type' => 'text',
		'label' => __('Shortcode','kahuna'),
		'desc' => __('Enter shortcode provided by slider plugin. The plugin will be responsible for the slider\'s appearance.','kahuna'),
		'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpsliderserious',
		'type' => 'select',
		'label' => __('Serious Slider','kahuna'),
		'values' => cryout_serious_slides_for_customizer(1, 0),
		'labels' => cryout_serious_slides_for_customizer(2, __(' - Please install, activate or update Serious Slider plugin - ', 'kahuna'), __(' - No sliders defined - ', 'kahuna') ),
		'desc' => __('Select the desired slider from the list. Sliders can be administered in the dashboard.','kahuna'),
		'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpslidertitle',
		'type' => 'text',
		'label' => __('Slider Caption','kahuna'),
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Title', 'kahuna') ),
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpslidertext',
		'type' => 'textarea',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'kahuna') ),
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpslidercta1text',
		'type' => 'text',
		'label' => __('CTA Button','kahuna') . ' #1',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'kahuna') ),
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpslidercta1link',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Link', 'kahuna') ),
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpslidercta2text',
		'type' => 'text',
		'label' => __('CTA Button','kahuna') . ' #2',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Text', 'kahuna') ),
	'section' => 'kahuna_lpslider' ),
	array(
	'id' => 'kahuna_lpslidercta2link',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('Link', 'kahuna') ),
	'section' => 'kahuna_lpslider' ),

	// blocks
	array(
	'id' => 'kahuna_lpblockmaintitle',
		'type' => 'text',
		'label' => __('Section Title','kahuna'),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblockmaindesc',
		'type' => 'textarea',
		'label' => __( 'Section Description', 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblockoneicon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','kahuna'), 1),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblockone',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'desc' => '&nbsp;',
	'section' => 'kahuna_lpblocks' ),

	array(
	'id' => 'kahuna_lpblocktwoicon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','kahuna'), 2),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblocktwo',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'desc' => '&nbsp;',
	'section' => 'kahuna_lpblocks' ),

	array(
	'id' => 'kahuna_lpblockthreeicon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','kahuna'), 3),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblockthree',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'desc' => '&nbsp;',
	'section' => 'kahuna_lpblocks' ),

	array(
	'id' => 'kahuna_lpblockfouricon',
		'type' => 'iconselect',
		'label' => sprintf( __('Block %d','kahuna'), 4),
		'values' => array(),
		'labels' => array(),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblockfour',
		'type' => 'select',
		'label' => '',
		'values' => cryout_pages_for_customizer(1, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'labels' => cryout_pages_for_customizer(2, sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'desc' => '&nbsp;',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblockscontent',
		'type' => 'select',
		'label' => __('Blocks Content','kahuna'),
		'values' => array( 0, 1, 2 ),
		'labels' => array( __("Disabled","kahuna"), __("Excerpt","kahuna"), __("Full Content","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),
	array(
	'id' => 'kahuna_lpblocksclick',
		'type' => 'checkbox',
		'label' => __('Make icons clickable (linking to their respective pages).','kahuna'),
		'desc' => '',
	'section' => 'kahuna_lpblocks' ),


	// boxes #cloned#
	array(
	'id' => 'kahuna_lpboxmaintitle#',
		'type' => 'text',
		'label' => __('Section Title','kahuna'),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxmaindesc#',
		'type' => 'textarea',
		'label' => __( 'Section Description', 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxcat#',
		'type' => 'select',
		'label' => __('Boxes Content','kahuna'),
		'values' => cryout_categories_for_customizer(1, __('All Categories', 'kahuna'), sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'labels' => cryout_categories_for_customizer(2, __('All Categories', 'kahuna'), sprintf( '- %s -', __('Disabled', 'kahuna') ) ),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxcount#',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 1,
			'max' => 100,
		),
		'label' => __('Number of Boxes','kahuna'),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxrow#',
		'type' => 'select',
		'label' => __('Boxes Per Row','kahuna'),
		'values' => array( 1, 2, 3, 4 ),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxheight#',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 1,
			'max' => 2000,
		),
		'label' => __('Box Height','kahuna'),
		'desc' => __("In pixels. The width is a percentage dependent on total site width and number of columns per row.","kahuna"),
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxlayout#',
		'type' => 'select',
		'label' => __('Box Layout','kahuna'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Full width","kahuna"), __("Boxed","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxmargins#',
		'type' => 'select',
		'label' => __('Box Stacking','kahuna'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Joined","kahuna"), __("Apart","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxanimation#',
		'type' => 'select',
		'label' => __('Box Appearance','kahuna'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Animated","kahuna"), __("Static","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxreadmore#',
		'type' => 'text',
		'label' => __('Read More Button','kahuna'),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),
	array(
	'id' => 'kahuna_lpboxlength#',
		'type' => 'number',
		'input_attrs' => array(
			'min' => 1,
			'max' => 100,
		),
		'label' => __('Content Length (words)','kahuna'),
		'desc' => '',
	'section' => 'kahuna_lpboxes#' ),

	// texts
	array(
	'id' => 'kahuna_lptextone',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','kahuna'), 1),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'kahuna') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'kahuna') ),
		'desc' => '',
	'section' => 'kahuna_lptexts' ),
	array(
	'id' => 'kahuna_lptexttwo',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','kahuna'), 2),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'kahuna') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'kahuna') ),
		'desc' => '',
	'section' => 'kahuna_lptexts' ),
	array(
	'id' => 'kahuna_lptextthree',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','kahuna'), 3),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'kahuna') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'kahuna') ),
		'desc' => '',
	'section' => 'kahuna_lptexts' ),
	array(
	'id' => 'kahuna_lptextfour',
		'type' => 'select',
		'label' => sprintf( __('Text Area %d','kahuna'), 4),
		'values' => cryout_pages_for_customizer(1, __('Disabled', 'kahuna') ),
		'labels' => cryout_pages_for_customizer(2, __('Disabled', 'kahuna') ),
		'desc' => __("<br><br>Page properties that will be used:<br>- page title as text title<br>- page content as text content<br>- page featured image as text area background image","kahuna"),
	'section' => 'kahuna_lptexts' ),


	//////////////////////////////////////////////////// Colors ////////////////////////////////////////////////////

	array(
	'id' => 'kahuna_sitebackground',
		'type' => 'color',
		'label' => __('Site Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_sitetext',
		'type' => 'color',
		'label' => __('Site Text','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_headingstext',
		'type' => 'color',
		'label' => __('Content Headings','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_contentbackground',
		'type' => 'color',
		'label' => __('Content Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_primarybackground',
		'type' => 'color',
		'label' => __('Left Sidebar Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_secondarybackground',
		'type' => 'color',
		'label' => __('Right Sidebar Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_overlaybackground',
		'type' => 'color',
		'label' => __('Overlay Color','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_overlayopacity',
		'type' => 'slider',
		'label' => __('Overlay Opacity','kahuna'),
		'min' => 0, 'max' => 100, 'step' => 5, 'um' => '%',
		'desc' => "",
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_menubackground',
		'type' => 'color',
		'label' => __('Header Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_header' ),
	array(
	'id' => 'kahuna_menutext',
		'type' => 'color',
		'label' => __('Menu Text','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_header' ),
	array(
	'id' => 'kahuna_submenutext',
		'type' => 'color',
		'label' => __('Submenu Text','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_header' ),
	array(
	'id' => 'kahuna_submenubackground',
		'type' => 'color',
		'label' => __('Submenu Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_header' ),
	array(
	'id' => 'kahuna_footerbackground',
		'type' => 'color',
		'label' => __('Footer Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_footer' ),
	array(
	'id' => 'kahuna_footertext',
		'type' => 'color',
		'label' => __('Footer Text','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_footer' ),
	array(
	'id' => 'kahuna_lpblocksbg',
		'type' => 'color',
		'label' => __('Blocks Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_lp' ),
	array(
	'id' => 'kahuna_lpboxesbg',
		'type' => 'color',
		'label' => __('Boxes Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_lp' ),
	array(
	'id' => 'kahuna_lptextsbg',
		'type' => 'color',
		'label' => __('Text Areas Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_lp' ),
	array(
	'id' => 'kahuna_lppostsbg',
		'type' => 'color',
		'label' => __('Static Page / Posts Background','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors_lp' ),
	array(
	'id' => 'kahuna_accent1',
		'type' => 'color',
		'label' => __('Primary Accent','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),
	array(
	'id' => 'kahuna_accent2',
		'type' => 'color',
		'label' => __('Secondary Accent','kahuna'),
		'desc' => '',
	'section' => 'kahuna_colors' ),

	//////////////////////////////////////////////////// Fonts ////////////////////////////////////////////////////
	array( // general font
	'id' => 'kahuna_fgeneralsize',
		'type' => 'select',
		'label' => __('General Font','kahuna'),
		'values' => cryout_gen_values( 12, 20, 1, array('um'=>'px') ),
		'desc' => '',
	'section' => 'kahuna_fontfamily' ),
	array(
	'id' => 'kahuna_fgeneralweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontfamily' ),
	array(
	'id' => 'kahuna_fgeneral',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontfamily' ),
	array(
	'id' => 'kahuna_fgeneralgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => __("The fonts under the <em>Preferred Theme Fonts</em> list are recommended because they have all the font weights used throughout the theme.","kahuna"),
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontfamily' ),

	array( // site title font
	'id' => 'kahuna_fsitetitlesize',
		'type' => 'select',
		'label' => __('Site Title','kahuna'),
		'values' => cryout_gen_values( 90, 250, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_fontheader' ),
	array(
	'id' => 'kahuna_fsitetitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontheader' ),
	array(
	'id' => 'kahuna_fsitetitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontheader' ),
	array(
	'id' => 'kahuna_fsitetitlegoogle',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontheader' ),

	array( // menu font
	'id' => 'kahuna_fmenusize',
		'type' => 'select',
		'label' => __('Main Menu','kahuna'),
		'values' => cryout_gen_values( 80, 140, 5, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_fontheader' ),
	array(
	'id' => 'kahuna_fmenuweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontheader' ),
	array(
	'id' => 'kahuna_fmenu',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontheader' ),
	array(
	'id' => 'kahuna_fmenugoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontheader' ),

	array( // widget fonts
	'id' => 'kahuna_fwtitlesize',
		'type' => 'select',
		'label' => __('Widget Title','kahuna'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_fontwidget' ),
	array(
	'id' => 'kahuna_fwtitleweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontwidget' ),
	array(
	'id' => 'kahuna_fwtitle',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontwidget' ),
	array(
	'id' => 'kahuna_fwtitlegoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontwidget' ),

	array(
	'id' => 'kahuna_fwcontentsize',
		'type' => 'select',
		'label' => __('Widget Content','kahuna'),
		'values' => cryout_gen_values( 80, 120, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_fontwidget' ),
	array(
	'id' => 'kahuna_fwcontentweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontwidget' ),
	array(
	'id' => 'kahuna_fwcontent',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontwidget' ),
	array(
	'id' => 'kahuna_fwcontentgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontwidget' ),

	array( // content fonts
	'id' => 'kahuna_ftitlessize',
		'type' => 'select',
		'label' => __('Post/Page Titles','kahuna'),
		'values' => cryout_gen_values( 130, 300, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_ftitlesweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_ftitles',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_ftitlesgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontcontent' ),

	array( // meta fonts
	'id' => 'kahuna_metatitlessize',
		'type' => 'select',
		'label' => __('Post metas','kahuna'),
		'values' => cryout_gen_values( 70, 160, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_metatitlesweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_metatitles',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_metatitlesgoogle',
		'type' => 'googlefont',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontcontent' ),


	array(
	'id' => 'kahuna_fheadingssize',
		'type' => 'select',
		'label' => __('Headings','kahuna'),
		'values' => cryout_gen_values( 100, 150, 10, array('um'=>'%') ),
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_fheadingsweight',
		'type' => 'select',
		'label' => '',
		'values' => array('100', '200', '300', '400', '500', '600', '700', '800', '900'),
		'labels' => array( __('100 thin','kahuna'), __('200 extra-light','kahuna'), __('300 ligher','kahuna'), __('400 regular','kahuna'), __('500 medium','kahuna'), __('600 semi-bold','kahuna'), __('700 bold','kahuna'), __('800 extra-bold','kahuna'), __('900 black','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_fheadings',
		'type' => 'font',
		'label' => '',
		'desc' => '',
	'section' => 'kahuna_fontcontent' ),
	array(
	'id' => 'kahuna_fheadingsgoogle',
		'type' => 'text',
		'label' => '',
		'desc' => '',
		'input_attrs' => array( 'placeholder' => __('or enter Google Font Identifier','kahuna') ),
	'section' => 'kahuna_fontcontent' ),

	array( // formatting
	'id' => 'kahuna_lineheight',
		'type' => 'select',
		'label' => __('Line Height','kahuna'),
		'values' => cryout_gen_values( 1.0, 2.4, 0.2, array('um'=>'em') ),
		'desc' => '',
	'section' => 'kahuna_textformatting' ),
	array(
	'id' => 'kahuna_textalign',
		'type' => 'select',
		'label' => __('Text Alignment','kahuna'),
		'values' => array( "Default" , "Left" , "Right" , "Justify" , "Center" ),
		'labels' => array( __("Default","kahuna"), __("Left","kahuna"), __("Right","kahuna"), __("Justify","kahuna"), __("Center","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_textformatting' ),
	array(
	'id' => 'kahuna_paragraphspace',
		'type' => 'select',
		'label' => __('Paragraph Spacing','kahuna'),
		'values' => cryout_gen_values( 0.5, 1.6, 0.1, array('um'=>'em', 'pre'=>array('0.0em') ) ),
		'desc' => '',
	'section' => 'kahuna_textformatting' ),
	array(
	'id' => 'kahuna_parindent',
		'type' => 'select',
		'label' => __('Paragraph Indentation','kahuna'),
		'values' => cryout_gen_values( 0, 2, 0.5, array('um'=>'em') ),
		'desc' => '',
	'section' => 'kahuna_textformatting' ),

	//////////////////////////////////////////////////// Structure ////////////////////////////////////////////////////

	array(
	'id' => 'kahuna_breadcrumbs',
		'type' => 'select',
		'label' => __('Breadcrumbs','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_contentstructure' ),
	array(
	'id' => 'kahuna_pagination',
		'type' => 'select',
		'label' => __('Numbered Pagination','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_contentstructure' ),
	array(
	'id' => 'kahuna_singlenav',
		'type' => 'select',
		'label' => __('Single Post Prev/Next Navigation','kahuna'),
		'values' => array( 2, 1, 0 ),
		'labels' => array( __("Absolute","kahuna"), __("Static", "kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_contentstructure' ),
	array(
	'id' => 'kahuna_contenttitles',
		'type' => 'select',
		'label' => __('Page/Category Titles','kahuna'),
		'values' => array( 1, 2, 3, 0 ),
		'labels' => array( __('Always Visible','kahuna'), __('Hide on Pages','kahuna'), __('Hide on Categories','kahuna'), __('Always Hidden','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_contentstructure' ),
	array(
	'id' => 'kahuna_totop',
		'type' => 'select',
		'label' => __('Back to Top Button','kahuna'),
		'values' => array( 'kahuna-totop-normal', 'kahuna-totop-fixed', 'kahuna-totop-disabled' ),
		'labels' => array( __("Bottom of page","kahuna"), __("In footer","kahuna"), __("Disabled","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_contentstructure' ),
	array(
	'id' => 'kahuna_tables',
		'type' => 'select',
		'label' => __('Tables Style','kahuna'),
		'values' => array( 'kahuna-no-table', 'kahuna-clean-table', 'kahuna-stripped-table', 'kahuna-bordered-table' ),
		'labels' => array( __("No border","kahuna"), __("Clean","kahuna"), __("Stripped","kahuna"), __("Bordered","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_contentstructure' ),
	array(
	'id' => 'kahuna_normalizetags',
		'type' => 'select',
		'label' => __('Tags Cloud Appearance','kahuna'),
		'values' => array( 0, 1 ),
		'labels' => array( __("Size Emphasis","kahuna"), __("Uniform Boxes","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_contentstructure' ),
array(
		'id' => 'kahuna_copyright',
		'type' => 'textarea',
		'label' => __( 'Custom Footer Text', 'kahuna' ),
		'desc' => __("Insert custom text or basic HTML code that will appear in your footer. <br /> You can use HTML to insert links, images and special characters.","kahuna"),
		'section' => 'kahuna_contentstructure' ),

	//////////////////////////////////////////////////// Graphics ////////////////////////////////////////////////////

	array(
	'id' => 'kahuna_elementborder',
		'type' => 'checkbox',
		'label' => __('Border','kahuna'),
		'desc' => '',
	'section' => 'kahuna_contentgraphics' ),
	array(
	'id' => 'kahuna_elementshadow',
		'type' => 'checkbox',
		'label' => __('Shadow','kahuna'),
		'desc' => '',
	'section' => 'kahuna_contentgraphics' ),
	array(
	'id' => 'kahuna_elementborderradius',
		'type' => 'checkbox',
		'label' => __('Rounded Corners','kahuna'),
		'desc' => __('These decorations apply to certain theme elements.','kahuna'),
	'section' => 'kahuna_contentgraphics' ),
	array(
	'id' => 'kahuna_articleanimation',
		'type' => 'select',
		'label' => __('Article Animation on Scroll','kahuna'),
		'values' => array( 0, 1, 2, 3, 4),
		'labels' => array( __("None","kahuna"), __("Fade","kahuna"), __("Slide","kahuna"), __("Zoom In","kahuna"), __("Zoom Out","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_contentgraphics' ),

	//////////////////////////////////////////////////// Search Box ////////////////////////////////////////////////////

	array(
	'id' => 'kahuna_searchboxmain',
		'type' => 'checkbox',
		'label' => __('Add Search to Main Menu','kahuna'),
		'desc' => '',
	'section' => 'kahuna_searchbox' ),
	array(
	'id' => 'kahuna_searchboxfooter',
		'type' => 'checkbox',
		'label' => __('Add Search to Footer Menu','kahuna'),
		'desc' => '',
	'section' => 'kahuna_searchbox' ),

	//////////////////////////////////////////////////// Content Image ////////////////////////////////////////////////////

	array(
	'id' => 'kahuna_image_style',
		'type' => 'radioimage',
		'label' => __('Post Images','kahuna'),
		'choices' => array(
			'kahuna-image-none' => array(
				'label' => __("No Styling","kahuna"),
				'url'   => '%s/admin/images/image-style-0.png'
			),
			'kahuna-image-one' => array(
				'label' => sprintf( __("Style %d","kahuna"), 1),
				'url'   => '%s/admin/images/image-style-1.png'
			),
			'kahuna-image-two' => array(
				'label' => sprintf( __("Style %d","kahuna"), 2),
				'url'   => '%s/admin/images/image-style-2.png'
			),
			'kahuna-image-three' => array(
				'label' => sprintf( __("Style %d","kahuna"), 3),
				'url'   => '%s/admin/images/image-style-3.png'
			),
			'kahuna-image-four' => array(
				'label' => sprintf( __("Style %d","kahuna"), 4),
				'url'   => '%s/admin/images/image-style-4.png'
			),
			'kahuna-image-five' => array(
				'label' => sprintf( __("Style %d","kahuna"), 5),
				'url'   => '%s/admin/images/image-style-5.png'
			),
		),
		'desc' => '',
	'section' => 'kahuna_postimage' ),
	array(
	'id' => 'kahuna_caption_style',
		'type' => 'select',
		'label' => __('Post Captions','kahuna'),
		'values' => array( 'kahuna-caption-zero', 'kahuna-caption-one', 'kahuna-caption-two' ),
		'labels' => array( __('Plain','kahuna'), __('With Border','kahuna'), __('With Background','kahuna') ),
		'desc' => '',
	'section' => 'kahuna_postimage' ),


	//////////////////////////////////////////////////// Post Information ////////////////////////////////////////////////////

	array( // meta
	'id' => 'kahuna_meta_author',
		'type' => 'checkbox',
		'label' => __("Display Author","kahuna"),
		'desc' => '',
	'section' => 'kahuna_metas' ),
	array(
	'id' => 'kahuna_meta_date',
		'type' => 'checkbox',
		'label' => __("Display Date","kahuna"),
		'desc' => '',
	'section' => 'kahuna_metas' ),
	array(
	'id' => 'kahuna_meta_time',
		'type' => 'checkbox',
		'label' => __("Display Time","kahuna"),
		'desc' => '',
	'section' => 'kahuna_metas' ),
	array(
	'id' => 'kahuna_meta_category',
		'type' => 'checkbox',
		'label' => __("Display Category","kahuna"),
		'desc' => '',
	'section' => 'kahuna_metas' ),
	array(
	'id' => 'kahuna_meta_tag',
		'type' => 'checkbox',
		'label' => __("Display Tags","kahuna"),
		'desc' => '',
	'section' => 'kahuna_metas' ),
	array(
	'id' => 'kahuna_meta_comment',
		'type' => 'checkbox',
		'label' => __("Display Comments","kahuna"),
		'desc' => __("Choose meta information to show on posts.","kahuna"),
	'section' => 'kahuna_metas' ),


	array( // meta
	'id' => 'kahuna_headertitles_posts',
		'type' => 'checkbox',
		'label' => __("Posts","kahuna"),
		'desc' => '',
	'section' => 'kahuna_headertitles' ),
	array(
	'id' => 'kahuna_headertitles_pages',
		'type' => 'checkbox',
		'label' => __("Pages","kahuna"),
		'desc' => '',
	'section' => 'kahuna_headertitles' ),
	array(
	'id' => 'kahuna_headertitles_archives',
		'type' => 'checkbox',
		'label' => __("Archive pages","kahuna"),
		'desc' => '',
	'section' => 'kahuna_headertitles' ),
	array(
	'id' => 'kahuna_headertitles_home',
		'type' => 'checkbox',
		'label' => __("Home page","kahuna"),
		'desc' => '',
	'section' => 'kahuna_headertitles' ),


	array( // comments
	'id' => 'kahuna_comclosed',
		'type' => 'select',
		'label' => __("'Comments Are Closed' Text",'kahuna'),
		'values' => array( 1, 2, 3, 0 ), // "Show" , "Hide in posts", "Hide in pages", "Hide everywhere"
		'labels' => array( __("Show","kahuna"), __("Hide in posts","kahuna"), __("Hide in pages","kahuna"), __("Hide everywhere","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_comments' ),
	array(
	'id' => 'kahuna_comdate',
		'type' => 'select',
		'label' => __('Comment Date Format','kahuna'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Specific","kahuna"), __("Relative","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_comments' ),
	array(
	'id' => 'kahuna_comlabels',
		'type' => 'select',
		'label' => __('Comment Field Label','kahuna'),
		'values' => array( 1, 2 ),
		'labels' => array( __("Placeholders","kahuna"), __("Labels","kahuna") ),
		'desc' => __("Change to labels for better compatibility with comment-related plugins.","kahuna"),
	'section' => 'kahuna_comments' ),
	array(
	'id' => 'kahuna_comformwidth',
		'type' => 'number',
		'label' => __('Comment Form Width (pixels)','kahuna'),
		'desc' => '',
	'section' => 'kahuna_comments' ),

	array( // excerpts
	'id' => 'kahuna_excerpthome',
		'type' => 'select',
		'label' => __( 'Standard Posts On Homepage', 'kahuna' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","kahuna"), __("Full Post","kahuna") ),
		'desc' => __("Post formats always display full posts.","kahuna"),
	'section' => 'kahuna_excerpts' ),
	array(
	'id' => 'kahuna_excerptsticky',
		'type' => 'select',
		'label' => __( 'Sticky Posts on Homepage', 'kahuna' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Inherit","kahuna"), __("Full Post","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_excerpts' ),
	array(
	'id' => 'kahuna_excerptarchive',
		'type' => 'select',
		'label' => __( 'Standard Posts in Categories/Archives', 'kahuna' ),
		'values' => array( 'excerpt', 'full' ),
		'labels' => array( __("Excerpt","kahuna"), __("Full Post","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_excerpts' ),
	array(
	'id' => 'kahuna_excerptlength',
		'type' => 'number',
		'label' => __( 'Excerpt Length (words)' , 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_excerpts' ),
	array(
	'id' => 'kahuna_excerptdots',
		'type' => 'text',
		'label' => __( 'Excerpt Suffix', 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_excerpts' ),
	array(
	'id' => 'kahuna_excerptcont',
		'type' => 'text',
		'label' => __( 'Continue Reading Label', 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_excerpts' ),

	//////////////////////////////////////////////////// Featured Images ////////////////////////////////////////////////////
	array(
	'id' => 'kahuna_fpost',
		'type' => 'select',
		'label' => __( 'Featured Images', 'kahuna' ),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","kahuna"), __("Disabled","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_featured' ),
	array(
	'id' => 'kahuna_fauto',
		'type' => 'select',
		'label' => __( 'Auto Select Image From Content', 'kahuna' ),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enabled","kahuna"), __("Disabled","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_featured' ),
	array(
	'id' => 'kahuna_fheight',
		'type' => 'number',
		'label' => __( 'Featured Image Height (in pixels)', 'kahuna' ),
		'desc' => __( 'Set to 0 to disable image processing', 'kahuna' ),
	'section' => 'kahuna_featured' ),
	array(
	'id' => 'kahuna_fheight_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","kahuna"),
		//'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_featured' ),
	array(
	'id' => 'kahuna_fresponsive',
		'type' => 'select',
		'values' => array( 0 , 1 ),
		'labels' => array( __("Cropped","kahuna"), __("Contained","kahuna") ),
		'label' => __('Featured Image Behaviour','kahuna'),
		'desc' => __("<strong>Contained</strong> will scale depending on the viewed resolution<br><strong>Cropped</strong> will try to keep the configured height.","kahuna"),
	'section' => 'kahuna_featured' ),
	array(
	'id' => 'kahuna_falign',
		'type' => 'select',
		'label' => __( 'Featured Image Crop Position', 'kahuna' ),
		'values' => array( "left top" , "left center", "left bottom", "right top", "right center", "right bottom", "center top", "center center", "center bottom" ),
		'labels' => array( __("Left Top","kahuna"), __("Left Center","kahuna"), __("Left Bottom","kahuna"), __("Right Top","kahuna"), __("Right Center","kahuna"), __("Right Bottom","kahuna"), __("Center Top","kahuna"), __("Center Center","kahuna"), __("Center Bottom","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_featured' ),
	array(
	'id' => 'kahuna_falign_notice',
		'type' => 'notice',
		'label' => '',
		'input_attrs' => array( 'class' => 'warning' ),
		'desc' => __("Changing this value may require to recreate your thumbnails.","kahuna"),
		//'active_callback' => 'kahuna_conditionals',
	'section' => 'kahuna_featured' ),

	array(
	'id' => 'kahuna_fheader',
		'type' => 'select',
		'label' => __('Use Featured Images in Header','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_featured' ),

	//////////////////////////////////////////////////// Social Positions ////////////////////////////////////////////////////

	array(
	'id' => 'kahuna_socials_header',
		'type' => 'checkbox',
		'label' => __( 'Display in Header', 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_socials' ),
	array(
	'id' => 'kahuna_socials_footer',
		'type' => 'checkbox',
		'label' => __( 'Display in Footer', 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_socials' ),
	array(
	'id' => 'kahuna_socials_left_sidebar',
		'type' => 'checkbox',
		'label' => __( 'Display in Left Sidebar', 'kahuna' ),
		'desc' => '',
	'section' => 'kahuna_socials' ),
	array(
	'id' => 'kahuna_socials_right_sidebar',
		'type' => 'checkbox',
		'label' => __( 'Display in Right Sidebar', 'kahuna' ),
		'desc' => sprintf( __( 'Select where social icons should be visible in.<br><br><strong>Social Icons are defined using the <a href="%1$s" target="_blank">social icons menu</a></strong>. Read the <a href="%2$s" target="_blank">theme documentation</a> on how to create a social menu.', 'kahuna' ), 'nav-menus.php?action=locations', 'http://www.cryoutcreations.eu/wordpress-tutorials/use-new-social-menu' ),
	'section' => 'kahuna_socials' ),

	//////////////////////////////////////////////////// Miscellaneous ////////////////////////////////////////////////////

	array(
	'id' => 'kahuna_masonry',
		'type' => 'select',
		'label' => __('Masonry','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_misc' ),
	array(
	'id' => 'kahuna_defer',
		'type' => 'select',
		'label' => __('JS Defer loading','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_misc' ),
	array(
	'id' => 'kahuna_fitvids',
		'type' => 'select',
		'label' => __('FitVids','kahuna'),
		'values' => array( 1, 2, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Enable on mobiles","kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_misc' ),
	array(
	'id' => 'kahuna_autoscroll',
		'type' => 'select',
		'label' => __('Autoscroll','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Disable","kahuna") ),
		'desc' => '',
	'section' => 'kahuna_misc' ),
	array(
	'id' => 'kahuna_editorstyles',
		'type' => 'select',
		'label' => __('Editor Styles','kahuna'),
		'values' => array( 1, 0 ),
		'labels' => array( __("Enable","kahuna"), __("Disable","kahuna") ),
		'desc' => __("<br>Only use these options to troubleshoot issues.","kahuna"),
	'section' => 'kahuna_misc' ),
	//////////////////////////////////////////////////// !!! DEVELOPER !!! ////////////////////////////////////////////////////
	// nothing for now

), // options

/* option=array(
	type: checkbox, select, textarea, input, function
	id: field_name or custom_function_name
	values: value_0, value_1, value_2 | true/false | number
	labels: __('Label 0','context'), ... | __('Enabled','context')/... |  number/__('Once','context')/...
	desc: html to be displayed at the question mark
	section: section_id

	array(
	'id' => '',
		'type' => '',
		'label' => '',
		'values' => array(  ),
		'labels' => array(  ),
		'desc' => '',
		'input_attrs' => array(  ),
		// conditionals
		'disable_if' => 'function_name',
		'require_fn' => 'function_name',
		'display_width' => '?????',
	'section' => '' ),

*/

/*** fonts ***/
'fonts' => array(

	'Preferred Theme Fonts'=> array(
					"Source Sans Pro/gfont",
					"Poppins/gfont",
					"Raleway/gfont",
					"Roboto/gfont",
					"Ubuntu/gfont",
					"Ubuntu Condensed/gfont",
					"Open Sans/gfont",
					"Open Sans Condensed:300/gfont",
					"Lato/gfont",
					"Droid Sans/gfont",
					"Oswald/gfont",
					"Yanone Kaffeesatz/gfont",
					),
	'Sans-Serif' => array(
					"Segoe UI, Arial, sans-serif",
					"Verdana, Geneva, sans-serif" ,
					"Geneva, sans-serif",
					"Helvetica Neue, Arial, Helvetica, sans-serif",
					"Helvetica, sans-serif" ,
					"Century Gothic, AppleGothic, sans-serif",
				    "Futura, Century Gothic, AppleGothic, sans-serif",
					"Calibri, Arian, sans-serif",
				    "Myriad Pro, Myriad,Arial, sans-serif",
					"Trebuchet MS, Arial, Helvetica, sans-serif" ,
					"Gill Sans, Calibri, Trebuchet MS, sans-serif",
					"Impact, Haettenschweiler, Arial Narrow Bold, sans-serif",
					"Tahoma, Geneva, sans-serif" ,
					"Arial, Helvetica, sans-serif" ,
					"Arial Black, Gadget, sans-serif",
					"Lucida Sans Unicode, Lucida Grande, sans-serif"
					),
	'Serif' => array(
					"Georgia, Times New Roman, Times, serif",
					"Times New Roman, Times, serif",
					"Cambria, Georgia, Times, Times New Roman, serif",
					"Palatino Linotype, Book Antiqua, Palatino, serif",
					"Book Antiqua, Palatino, serif",
					"Palatino, serif",
				    "Baskerville, Times New Roman, Times, serif",
 					"Bodoni MT, serif",
					"Copperplate Light, Copperplate Gothic Light, serif",
					"Garamond, Times New Roman, Times, serif"
					),
	'MonoSpace' => array(
					"Courier New, Courier, monospace" ,
					"Lucida Console, Monaco, monospace",
					"Consolas, Lucida Console, Monaco, monospace",
					"Monaco, monospace"
					),
	'Cursive' => array(
					"Lucida Casual, Comic Sans MS, cursive",
				    "Brush Script MT, Phyllis, Lucida Handwriting, cursive",
					"Phyllis, Lucida Handwriting, cursive",
					"Lucida Handwriting, cursive",
					"Comic Sans MS, cursive"
					)
	), // fonts

/*** google font option fields ***/
'google-font-enabled-fields' => array(
	'kahuna_fgeneral',
	'kahuna_fsitetitle',
	'kahuna_fmenu',
	'kahuna_fwtitle',
	'kahuna_fwcontent',
	'kahuna_ftitles',
	'kahuna_metatitles',
	'kahuna_fheadings',
	),

	/*** landing page blocks icons ***/
	'block-icons' => array(
		'no-icon' => '&nbsp;',
		'toggle' => 'e003',
		'layout' => 'e004',
		'lock' => 'e007',
		'unlock' => 'e008',
		'target' => 'e012',
		'disc' => 'e019',
		'microphone' => 'e048',
		'play' => 'e052',
		'cloud2' => 'e065',
		'cloud-upload' => 'e066',
		'cloud-download' => 'e067',
		'plus2' => 'e114',
		'minus2' => 'e115',
		'check2' => 'e116',
		'cross2' => 'e117',
		'users2' => 'e00a',
		'user' => 'e00b',
		'trophy' => 'e00c',
		'speedometer' => 'e00d',
		'screen-tablet' => 'e00f',
		'screen-smartphone' => 'e01a',
		'screen-desktop' => 'e01b',
		'plane' => 'e01c',
		'notebook' => 'e01d',
		'magic-wand' => 'e01e',
		'hourglass2' => 'e01f',
		'graduation' => 'e02a',
		'fire' => 'e02b',
		'eyeglass' => 'e02c',
		'energy' => 'e02d',
		'chemistry' => 'e02e',
		'bell' => 'e02f',
		'badge' => 'e03a',
		'speech' => 'e03b',
		'puzzle' => 'e03c',
		'printer' => 'e03d',
		'present' => 'e03e',
		'pin' => 'e03f',
		'picture2' => 'e04a',
		'map' => 'e04b',
		'layers' => 'e04c',
		'globe' => 'e04d',
		'globe2' => 'e04e',
		'folder' => 'e04f',
		'feed' => 'e05a',
		'drop' => 'e05b',
		'drawar' => 'e05c',
		'docs' => 'e05d',
		'directions' => 'e05e',
		'direction' => 'e05f',
		'cup2' => 'e06b',
		'compass' => 'e06c',
		'calculator' => 'e06d',
		'bubbles' => 'e06e',
		'briefcase' => 'e06f',
		'book-open' => 'e07a',
		'basket' => 'e07b',
		'bag' => 'e07c',
		'wrench' => 'e07f',
		'umbrella' => 'e08a',
		'tag' => 'e08c',
		'support' => 'e08d',
		'share' => 'e08e',
		'share2' => 'e08f',
		'rocket' => 'e09a',
		'question' => 'e09b',
		'pie-chart2' => 'e09c',
		'pencil2' => 'e09d',
		'note' => 'e09e',
		'music-tone-alt' => 'e09f',
		'list2' => 'e0a0',
		'like' => 'e0a1',
		'home2' => 'e0a2',
		'grid' => 'e0a3',
		'graph' => 'e0a4',
		'equalizer' => 'e0a5',
		'dislike' => 'e0a6',
		'calender' => 'e0a7',
		'bulb' => 'e0a8',
		'chart' => 'e0a9',
		'clock' => 'e0af',
		'envolope' => 'e0b1',
		'flag' => 'e0b3',
		'folder2' => 'e0b4',
		'heart2' => 'e0b5',
		'info' => 'e0b6',
		'link' => 'e0b7',
		'refresh' => 'e0bc',
		'reload' => 'e0bd',
		'settings' => 'e0be',
		'arrow-down' => 'e604',
		'arrow-left' => 'e605',
		'arrow-right' => 'e606',
		'arrow-up' => 'e607',
		'paypal' => 'e608',
		'home' => 'e800',
		'apartment' => 'e801',
		'data' => 'e80e',
		'cog' => 'e810',
		'star' => 'e814',
		'star-half' => 'e815',
		'star-empty' => 'e816',
		'paperclip' => 'e819',
		'eye2' => 'e81b',
		'license' => 'e822',
		'picture' => 'e827',
		'book' => 'e828',
		'bookmark' => 'e829',
		'users' => 'e82b',
		'store' => 'e82d',
		'calendar' => 'e836',
		'keyboard' => 'e837',
		'spell-check' => 'e838',
		'screen' => 'e839',
		'smartphone' => 'e83a',
		'tablet' => 'e83b',
		'laptop' => 'e83c',
		'laptop-phone' => 'e83d',
		'construction' => 'e841',
		'pie-chart' => 'e842',
		'gift' => 'e844',
		'diamond' => 'e845',
		'cup3' => 'e848',
		'leaf' => 'e849',
		'earth' => 'e853',
		'bullhorn' => 'e859',
		'hourglass' => 'e85f',
		'undo' => 'e860',
		'redo' => 'e861',
		'sync' => 'e862',
		'history' => 'e863',
		'download' => 'e865',
		'upload' => 'e866',
		'bug' => 'e869',
		'code' => 'e86a',
		'link2' => 'e86b',
		'unlink' => 'e86c',
		'thumbs-up' => 'e86d',
		'thumbs-down' => 'e86e',
		'magnifier' => 'e86f',
		'cross3' => 'e870',
		'menu' => 'e871',
		'list' => 'e872',
		'warning' => 'e87c',
		'question-circle' => 'e87d',
		'check' => 'e87f',
		'cross' => 'e880',
		'plus' => 'e881',
		'minus' => 'e882',
		'layers2' => 'e88e',
		'text-format' => 'e890',
		'text-size' => 'e892',
		'hand' => 'e8a5',
		'pointer-up' => 'e8a6',
		'pointer-right' => 'e8a7',
		'pointer-down' => 'e8a8',
		'pointer-left' => 'e8a9',
		'heart' => 'e930',
		'cloud' => 'e931',
		'trash' => 'e933',
		'user2' => 'e934',
		'key' => 'e935',
		'search' => 'e936',
		'settings2' => 'e937',
		'camera' => 'e938',
		'tag2' => 'e939',
		'bulb2' => 'e93a',
		'pencil' => 'e93b',
		'diamond2' => 'e93c',
		'location' => 'e93e',
		'eye' => 'e93f',
		'bubble' => 'e940',
		'stack' => 'e941',
		'cup' => 'e942',
		'phone' => 'e943',
		'news' => 'e944',
		'mail' => 'e945',
		'news2' => 'e948',
		'paperplane' => 'e949',
		'params2' => 'e94a',
		'data2' => 'e94b',
		'megaphone' => 'e94c',
		'study' => 'e94d',
		'chemistry2' => 'e94e',
		'fire2' => 'e94f',
		'paperclip2' => 'e950',
		'calendar2' => 'e951',
		'wallet' => 'e952',
		),

/*** ajax load more identifiers ***/
'theme_identifiers' => array(
	'load_more_optid' 			=> 'kahuna_lpposts_more',
	'content_css_selector' 		=> '#lp-posts .lp-posts-inside',
	'pagination_css_selector' 	=> '#lp-posts nav.navigation',
),

/************* widget areas *************/

'widget-areas' => array(
	'sidebar-2' => array(
		'name' => __( 'Sidebar Left', 'kahuna' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'sidebar-1' => array(
		'name' => __( 'Sidebar Right', 'kahuna' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'footer-widget-area' => array(
		'name' => __( 'Footer', 'kahuna' ),
		'description' 	=> __('You can configure how many columns the footer displays from the theme options', 'kahuna'),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s"><div class="footer-widget-inside">',
		'after_widget' => '</div></section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'content-widget-area-before' => array(
		'name' => __( 'Content Before', 'kahuna' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'content-widget-area-after' => array(
		'name' => __( 'Content After', 'kahuna' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
	'widget-area-header' => array(
		'name' => __( 'Header', 'kahuna' ),
		'before_widget' => '<section id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h2 class="widget-title"><span>',
		'after_title' => '</span></h2>',
	),
), // widget-areas


); // $kahuna_big

// FIN
