<?php
/**
 * Author: Drum Creative
 * URL: http://drumcreative.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */


// Mobile Detect http://mobiledetect.net/
// require_once('library/Mobile_Detect.php');

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add desktop menu walker */
require_once( 'library/menu-walker.php' );

/** Add off-canvas menu walker */
require_once( 'library/offcanvas-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Add protocol relative theme assets */
require_once( 'library/protocol-relative-theme-assets.php' );

// Add Header image
require_once('library/custom-header.php');

// Add Drum's functions
require_once('library/drum-functions.php');

// Add Drum's plugins
require_once('library/plugins.php');

// Add button shortcode button to TinyMCE
require_once( 'editor-buttons/tinymce-buttons.php' );

// Add shortcodes
require_once('library/shortcodes.php');

// Add TGM Plugin Activation - http://tgmpluginactivation.com/
require_once('library/class-tgm-plugin-activation.php');

// Only load WooCommerce scripts on shop pages and checkout + cart - https://gist.github.com/DevinWalker/7621777
require_once('library/woocommerce-optimize-scripts.php');
?>
