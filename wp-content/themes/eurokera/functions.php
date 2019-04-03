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

register_post_type('products', array('menu_icon' => 'dashicons-cart', 'label' => 'Products','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => true,'rewrite' => array('slug' => 'products','with_front' => false),'query_var' => true,'exclude_from_search' => false,'supports' => array('title','revisions','thumbnail','page-attributes',),'labels' => array (
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

register_post_type('selector_log', array('menu_icon' => 'dashicons-list-view',	'label' => 'Product Selector Log','description' => '','public' => true,'show_ui' => true,'show_in_menu' => true,'capability_type' => 'post','hierarchical' => false,'rewrite' => array('slug' => 'log', 'with_front' => false),'query_var' => true,'exclude_from_search' => true,'supports' => array('title',),'labels' => array (
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
		
			<?php if (ICL_LANGUAGE_CODE == 'zh-hans') : ?>	
				<?php
				$video_markup = '<a id="quality-video-' . $counter . '" class="quality-video vp-a vp-mp4-type" href="' . $row['video_url'] . '" data-autoplay="1" data-dwrap="1"></a>';
				echo apply_filters('the_content', $video_markup);
				$video_inner = '<div class="product-addl-video">' . wp_get_attachment_image( $row['video_poster'], 'width=310&height=228&crop=1' );
				ob_start();
				get_template_part('assets/images/play', 'button.svg');
				$play_button = ob_get_contents();
				ob_end_clean();
				$video_inner .= $play_button;
				$video_inner .= '</div><div class="video-title" style="display:table;height:100%;"><div style="display:table-cell;vertical-align:middle;"><div><h2>' . $row['video_title'] . '</h2></div></div></div>';
				?>
				<script>
					jQuery('a#quality-video-<?php echo $counter; ?>').html('<?php echo $video_inner; ?>');
				</script>
			<?php else: ?>
		
		
			<a class="quality-video" href="<?php echo $row['video_url']; ?>?autoplay=1&modestbranding=1&showinfo=0&rel=0" data-featherlight="iframe" data-featherlight-iframe-width="960" data-featherlight-iframe-height="540">
				<div class="product-addl-video">
					<?php echo  wp_get_attachment_image( $row['video_poster'], 'width=310&height=228&crop=1' ); ?>
					<?php get_template_part('assets/images/play', 'button.svg'); ?>
				</div>
				<div class="video-title" style="display:table;height:100%;">
				  <div style="display:table-cell;vertical-align:middle;">
				    <div><h2><?php echo $row['video_title']; ?></h2></div>
				  </div>
				</div>
			</a>
			
			<?php endif; ?>
			<?php
			$counter++;
		}
		echo '</div>';
	}
}
add_shortcode ('quality-videos', 'quality_videos');

// Return get_template_part as variable
function load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

// Get brightness of photo    
function getBrightness($imgURL) {
	$gdHandle = imagecreatefromjpeg($imgURL);
    $width = imagesx($gdHandle);
    $height = imagesy($gdHandle);
    $totalBrightness = 0;
    for ($x = 0; $x < $width; $x++) {
        for ($y = 0; $y < $height; $y++) {
            $rgb = imagecolorat($gdHandle, $x, $y);
            $red = ($rgb >> 16) & 0xFF;
            $green = ($rgb >> 8) & 0xFF;
            $blue = $rgb & 0xFF;
            $totalBrightness += (max($red, $green, $blue) + min($red, $green, $blue)) / 2;
        }
    }
    imagedestroy($gdHandle);
    return ($totalBrightness / ($width * $height)) / 2.55;
}

  /* Pull apart OEmbed video link to get thumbnails out*/
    function get_video_thumbnail_uri( $video_uri ) {
        $thumbnail_uri = '';
        // determine the type of video and the video id
        $video = parse_video_uri( $video_uri );     
        // get youtube thumbnail
        if ( $video['type'] == 'youtube' )
            $thumbnail_uri = 'http://img.youtube.com/vi/' . $video['id'] . '/hqdefault.jpg';
        // get vimeo thumbnail
        if( $video['type'] == 'vimeo' )
            $thumbnail_uri = get_vimeo_thumbnail_uri( $video['id'] );
        // get wistia thumbnail
        if( $video['type'] == 'wistia' )
            $thumbnail_uri = get_wistia_thumbnail_uri( $video_uri );
        // get default/placeholder thumbnail
        if( empty( $thumbnail_uri ) || is_wp_error( $thumbnail_uri ) )
            $thumbnail_uri = ''; 
        //return thumbnail uri
        return $thumbnail_uri;
    }
    /* Parse the video uri/url to determine the video type/source and the video id */
    function parse_video_uri( $url ) {
        // Parse the url 
        $parse = parse_url( $url );
        // Set blank variables
        $video_type = '';
        $video_id = '';
        // Url is http://youtu.be/xxxx
        if ( $parse['host'] == 'youtu.be' ) {
            $video_type = 'youtube';
            $video_id = ltrim( $parse['path'],'/' );    
        }
        // Url is http://www.youtube.com/watch?v=xxxx 
        // or http://www.youtube.com/watch?feature=player_embedded&v=xxx
        // or http://www.youtube.com/embed/xxxx
        if ( ( $parse['host'] == 'youtube.com' ) || ( $parse['host'] == 'www.youtube.com' ) ) {
            $video_type = 'youtube';
            parse_str( $parse['query'] );
            $video_id = $v; 
            if ( !empty( $feature ) )
                $video_id = end( explode( 'v=', $parse['query'] ) );
            if ( strpos( $parse['path'], 'embed' ) == 1 )
                $video_id = end( explode( '/', $parse['path'] ) );
        }
        // Url is http://www.vimeo.com
        if ( ( $parse['host'] == 'vimeo.com' ) || ( $parse['host'] == 'www.vimeo.com' ) ) {
            $video_type = 'vimeo';
            $video_id = ltrim( $parse['path'],'/' );    
        }
        $host_names = explode(".", $parse['host'] );
        $rebuild = ( ! empty( $host_names[1] ) ? $host_names[1] : '') . '.' . ( ! empty($host_names[2] ) ? $host_names[2] : '');
        // Url is an oembed url wistia.com
        if ( ( $rebuild == 'wistia.com' ) || ( $rebuild == 'wi.st.com' ) ) {
            $video_type = 'wistia';
            if ( strpos( $parse['path'], 'medias' ) == 1 )
                    $video_id = end( explode( '/', $parse['path'] ) );
        }
        // If recognised type return video array
        if ( !empty( $video_type ) ) {
            $video_array = array(
                'type' => $video_type,
                'id' => $video_id
            );
            return $video_array;
        } else {
            return false;
        }
    }
    /* Takes a Vimeo video/clip ID and calls the Vimeo API v2 to get the large thumbnail URL.*/
    function get_vimeo_thumbnail_uri( $clip_id ) {
        $vimeo_api_uri = 'http://vimeo.com/api/v2/video/' . $clip_id . '.php';
        $vimeo_response = wp_remote_get( $vimeo_api_uri );
        if( is_wp_error( $vimeo_response ) ) {
            return $vimeo_response;
        } else {
            $vimeo_response = unserialize( $vimeo_response['body'] );
            return $vimeo_response[0]['thumbnail_large'];
        }
    }
    /* Takes a wistia oembed url and gets the video thumbnail url. */
    function get_wistia_thumbnail_uri( $video_uri ) {
        if ( empty($video_uri) )
            return false;
        $wistia_api_uri = 'http://fast.wistia.com/oembed?url=' . $video_uri;
        $wistia_response = wp_remote_get( $wistia_api_uri );
        if( is_wp_error( $wistia_response ) ) {
            return $wistia_response;
        } else {
            $wistia_response = json_decode( $wistia_response['body'], true );
            return $wistia_response['thumbnail_url'];
        }
    }

// Custom image sizes
add_image_size( 'enamels', 1160, 140, false );

// Change notice for disabled users
add_filter( 'ja_disable_users_notice', 'ekfourpointoh' );
function ekfourpointoh( $content ) {
    return 'All logins have been disabled in preparation for EuroKera 4.0. You can make changes on the <a href="http://eurokerav2.staging.wpengine.com/wp-admin">staging website</a> using the same username and password. Please contact <a href="mailto:webmaster@drumcreative.com">webmaster@drumcreative.com</a> if you still need access to this website.';
}