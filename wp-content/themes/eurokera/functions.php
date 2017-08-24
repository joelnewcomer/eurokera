<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

// Add ScrollReveal class to body
add_filter( 'body_class','sr_class' );
function sr_class( $classes ) {
	$scroll_reveal = get_field('scrollreveal', 'option');
    if (!$scroll_reveal) {
	    $classes[] = 'no-sr';
	}
    return $classes;
}

/** Mobile Detect http://mobiledetect.net/ */
require_once('library/Mobile_Detect.php');

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Drum's functions */
require_once('library/drum-functions.php');

/** Add Drum's plugins */
require_once('library/drum-plugins.php');

/** Add TGM Plugin Activation - http://tgmpluginactivation.com/ */
require_once('library/class-tgm-plugin-activation.php');

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

// Specify Local JSON folder. This was added on 7/19/17 because of a bug preventing the JSON from saving.
function my_acf_json_load_point( $paths ) {
    unset($paths[0]);    
    $paths[] = get_stylesheet_directory() . '/acf-json';
    return $paths;
}

register_post_type('products', array('menu_icon' => 'dashicons-cart', 'label' => 'Products','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => true,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => false,'supports' => array('title','revisions','thumbnail','page-attributes',),'labels' => array (
  'name' => 'Products',
  'singular_name' => 'Product',
  'menu_name' => 'Products',
  'add_new' => 'Add Product',
  'add_new_item' => 'Add New Product',
  'edit' => 'Edit',
  'edit_item' => 'Edit Product',
  'new_item' => 'New Product',
  'view' => 'View Product',
  'view_item' => 'View Product',
  'search_items' => 'Search Products',
  'not_found' => 'No Products Found',
  'not_found_in_trash' => 'No Products Found in Trash',
  'parent' => 'Parent Product',
),) );

register_post_type('selector_log', array('menu_icon' => 'dashicons-list-view',	'label' => 'Product Selector Log','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => ''),'query_var' => true,'exclude_from_search' => true,'supports' => array('title',),'labels' => array (
  'name' => 'Product Selector Log',
  'singular_name' => 'Log Item',
  'menu_name' => 'Product Selector Log',
  'add_new' => 'Add Log Item',
  'add_new_item' => 'Add New Log Item',
  'edit' => 'Edit',
  'edit_item' => 'Edit Log Item',
  'new_item' => 'New Log Item',
  'view' => 'View Log Item',
  'view_item' => 'View Log Item',
  'search_items' => 'Search Product Selector Log',
  'not_found' => 'No Product Selector Log Found',
  'not_found_in_trash' => 'No Product Selector Log Found in Trash',
  'parent' => 'Parent Log Item',
),) );


// Add quality-videos shortcode
function quality_videos( $atts, $content = null ) {
	$rows = get_field('quality_videos','option');
	if($rows) {
		shuffle( $rows );
		$counter = 1;
		echo '<div class="product-videos">';
		foreach($rows as $row) { ?>
			<a class="quality-video" href="<?php echo $row['video_url']; ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
				<div class="product-addl-video">
					<?php echo  wp_get_attachment_image( $row['video_poster'], 'width=310&height=228&crop=1' ) ?>
					<?php get_template_part('assets/images/play', 'button.svg'); ?>
				</div>
				<div class="video-title" style="display:table;height:100%;">
				  <div style="display:table-cell;vertical-align:middle;">
				    <div><h2><?php echo $row['video_title']; ?></h2></div>
				  </div>
				</div>
			</a>
			<?php
			$counter++;
			if ($counter > 2) {
				break;
			}
		}
		echo '</div>';
	}
}
add_shortcode ('quality-videos', 'quality_videos');