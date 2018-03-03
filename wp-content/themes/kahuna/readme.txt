=============
Kahuna WordPress Theme
Copyright 2017-18 Cryout Creations
https://www.cryoutcreations.eu/

Author: Cryout Creations
Requires at least: 4.2
Tested up to: 4.9.4
Stable tag: 1.1.1
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl.html
Donate link: https://www.cryoutcreations.eu/donate/

Kahuna is the big kahuna among WordPress themes. It proved itself with an exotic design, effective and easy to use customizer settings and a responsive, fully editable layout. Many personal and business sites have embraced it for a wide spectrum of uses, ranging from portfolio and photography sites to blogs and online shops. The features are too many to list but here are some of the main attractions: translatable, search engine optimized (both microformats and micordata), supports RTL (right-to-left) languages, supports eCommerce (WooCommerce), has both wide and boxed layouts, masonry bricks, socials, Google fonts, typography options, and a great customizable landing page.

== License ==

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see http://www.gnu.org/copyleft/gpl.html


== Third Party Resources ==

Kahuna WordPress Theme bundles the following third-party resources:

HTML5Shiv, Copyright Alexander Farkas (aFarkas)
Dual licensed under the terms of the GPL v2 and MIT licenses
Source: https://github.com/aFarkas/html5shiv/

FitVids, Copyright Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
Licensed under the terms of the WTFPLlicense
Source: http://fitvidsjs.com/

== Bundled Fonts ==

Source Sans Pro, Copyright Adobe Systems Incorporated
Licensed under the terms of SIL Open Font License, Version 1.1.
Source: https://github.com/adobe-fonts/source-sans-pro/

Poppins, Copyright Indian Type Foundry
Licensed under the terms of SIL Open Font License, Version 1.1.
Source: https://github.com/google/fonts/tree/master/ofl/poppins

Icomoon icons, Copyright Keyamoon.com
Licensed under the terms of the GPL license
Source: https://icomoon.io/#icons-icomoon

Zocial CSS social buttons, Copyright Sam Collins
Licensed under the terms of the MIT license
Source: https://github.com/smcllns/css-social-buttons

Entypo+ icons, Copyright Daniel Bruce
Licensed under the terms of the CC BY-SA 4.0 license
Source: http://www.entypo.com/faq.php

== Bundled Images ==

The following bundled images are released into the public domain under Creative Commons CC0:
https://www.pexels.com/photo/adult-agreement-beard-beverage-541522/
https://www.pexels.com/photo/light-desk-pencil-picture-73526/
https://www.pexels.com/photo/people-notes-meeting-team-7095/
https://pixabay.com/en/aerial-view-green-grass-trees-2563791/

Preview demo images:
1.jpg - https://www.pexels.com/photo/close-up-of-pictures-185933/
2.jpg - https://www.pexels.com/photo/people-meeting-workspace-team-7097/
3.jpg - https://www.pexels.com/photo/man-holding-smartphone-capturing-roadway-171933/
4.jpg - https://www.pexels.com/photo/adult-art-artist-blur-297648/
5.jpg - https://www.pexels.com/photo/black-and-white-blog-business-chocolate-261577/
6.jpg - https://www.pexels.com/photo/arts-build-close-up-commerce-273230/
7.jpg - https://www.pexels.com/photo/close-up-of-woman-holding-coffee-cup-at-cafe-312420/
8.jpg - https://www.pexels.com/photo/business-camera-communication-computer-436784/
9.jpg - https://www.pexels.com/photo/above-adult-blur-buildings-373934/
10.jpg - https://www.pexels.com/photo/blackboard-business-chalkboard-concept-355988/

The rest of the bundled images are created by Cryout Creations and released with the theme under GPLv3


== Changelog ==

= 1.1.1 =
* Adjusted font size for masonry article titles (made them smaller)
* Fixed content breadcrumbs missing background color
* Fixed header widget area overlapping header titles
* Removed 'defer' loading of comments script

= 1.1.0 =
* Improved featured image srcset functionality to support more browsers and usage scenarios
* Improved edit button text color styling for dark backgrounds
* Improved compatibility of dark color schemes with Crayon Syntax Highlighter plugin's editor styling
* Improved 'comments moderated' text positioning
* Improved demo content check to use theme slug
* Improved sublists appearance in sidebar widgets
* Added all weight values for the typography options
* Added icon to comments reply button
* Added icon to excerpt read more button
* Changed featured image icon to arrow
* Relocated Header Titles options panel under General
* Fixed non working translation in article publish date
* Fixed page layout option overlapping category/search/archive layout when last item uses custom layout
* Fixed and disabled header titles functionality on WooCommerce sections
* Fixed header titles not following the separate option on home static page
* Fixed header titles to use the correct page title on the 'blog' section
* Fixed comments block being visible on landing page featured page
* Fixed missing saturation animation for cropped featured images
* Fixed site title and tagline animation
* Removed header image blur effect as it was malfunctioning on Chrome
* Removed leftover right margin from post tiles in lists
* Improved headings titles handing of custom post types and content
* Updated to Cryout Framework 0.7.3:
	* Framework: fixed invalid count() call in prototypes.php triggering warnings on PHP 7+
	* Framework: added cryout_get_picture(), cryout_get_picture_src(), cryout_is_landingpage(), cryout_on_landingpage() functions

= 1.0.1 =
* Fixed landing page static image responsiveness and improved compatibility with Serious Slider
* Fixed widgets losing padding on screens smaller than 1024px for sidebars with a background color set
* Post metas are now always visible over the featured images on screens smaller than 800px
* Fixed breadcrumbs under the header having too much padding on mobile
* Added alt attribute to landing page text area images
* Fixed notice in custom styling

= 1.0.0 =
* Fixed image background color on landing page featured boxes
* Adjusted breadcrumbs background
* Fixed theme overriding some Serious Slider buttons styling
* Fixed site tagline misaligned on homepage header when landing page is not used
* Removed 'comment-list' and 'search-form' from add_theme_support('html5') per review request

= 0.9.3 =
* Fixed landing page featured boxes category selector not working since 0.9.2
* Fixed missing text areas numbers in theme options
* Fixed non-translatable strings in theme options
* Added auto-match for mailto: URL in social icons
* Improved masonry initiation to check if function is available
* Increased content headers line-height to 1.2
* Fixed extra space under menu when main menu is set to fixed and on top of header image with boxed layout when no header image is set
* Added workaround for horizontal scrollbar on mobile devices when large menus are used

= 0.9.2 =
* Added integrated styling for our Serious Slider plugin
* Added preliminary support for Polylang (and theoretically WPML) multi-language content for all landing page elements
* Adjusted responsiveness of static slider image to better fit screen
* Fixed admin bar overlapping mobile menu
* Renamed $kahuna variables to be more generic
* Fixed editor styling option not controlling style.css enqueue
* Fixed featured boxes not deactivating by setting the category to 'disabled'
* Fixed dropdown menu width issue in Chrome with very short menu items
* Fixed missing edit button on single posts
* Fixed author pages displaying empty biography area
* Adjusted static slider CTA buttons styling to be more generic
* Fixed static slider caption container being displayed when no static slider caption fields are used

= 0.9.1 =
* Changed article markup to improve search engine readability (separated actual article content from article extra information)
* Changed comment headers to ‘footer’ elements
* Changed author bio div to ‘section’ element
* Changed default landing page appearance and images
* Changed default screenshot.png
* Fixed hardcoded colors for the submenu, colophon, static boxes and icon blocks
* Added color option for landing page posts/ static page
* Added links to landing page boxes titles and images
* Adjusted the 'leave a comment' meta line-height
* Fixed footer responsiveness
* Added zoom in / zoom out animations for articles
* Fixed site title overlapping menu icon on mobile

= 0.9 =
Initial release
