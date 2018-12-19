<?php
/**
 * Useful function(s) included in this library:
 *
 * 1. has_gform() - Line 94 - Checks to see if a Gravity Forms form is on the current page.
 * 2. is_woocommerce_activated() -  Line 526 - Checks to see if WooCommerce is activated.
 * 3. is_blog() - Line 519 Checks to see if this is a blog-related page (blog, blog post, archive)
 * 4. Line 564 - Update Featured Image Size
 */

// Set content width to appease Theme Check
if ( ! isset( $content_width ) ) $content_width = 1024;

// Add Theme Support for the title tag
add_theme_support( "title-tag" );

//Remove Gallery Inline Styling | CSS-Tricks  -- https://css-tricks.com/snippets/wordpress/remove-gallery-inline-styling/
add_filter( 'use_default_gallery_style', '__return_false' );

//Add the read more link to excerpts
function new_excerpt_more( $more ) {
	global $post;
	return '...<strong>' . __('read more') . '</strong>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Add post/page name to body class
function post_name_in_body_class( $classes ){
	if( is_singular() ) {
		global $post;
		array_push( $classes, "{$post->post_name}" );
	}
	return $classes;
}
add_filter( 'body_class', 'post_name_in_body_class' );

// Filter to process shortcodes in widgets
add_filter('widget_text', 'do_shortcode');

// Change the media link type to None by default
update_option('image_default_link_type','none');

// Show full WYSIWYG toolbar by default
function unhide_kitchensink( $args ) {
	$args['wordpress_adv_hidden'] = false;
	return $args;
}
add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );

// show admin bar only for admins and editors
if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}

// Deny Comment Posting to No Referrer Requests
function check_referrer() {
    if (!isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == "") {
        wp_die( __('Please enable referrers in your browser, or, if you\'re a spammer, bugger off!', 'drum-beat-6-starter-theme') );
    }
}
add_action('check_comment_flood', 'check_referrer');

//Remove query strings from static resources
function _remove_query_strings_1( $src ){
	$rqs = explode( '?ver', $src );
        return $rqs[0];
}
function _remove_query_strings_2( $src ){
	$rqs = explode( '&ver', $src );
        return $rqs[0];
}
add_filter( 'script_loader_src', '_remove_query_strings_1', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_1', 15, 1 );
add_filter( 'script_loader_src', '_remove_query_strings_2', 15, 1 );
add_filter( 'style_loader_src', '_remove_query_strings_2', 15, 1 );

// conditional to check whether Gravity Forms shortcode is on a page
function has_gform() {
    global $post;
    $all_content = get_the_content();
    if (strpos($all_content,'[gravityform') !== false) {
		return true;
    } else {
		return false;
    }
}

// White Label login logo
function login_logo() { ?>
<style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_template_directory_uri() ?>/assets/images/icons/login-logo-323x67-max.png);
            background-size: auto auto !important;
            width: 100%;
        }

</style>
<?php }
add_action( 'login_enqueue_scripts', 'login_logo' );

// White Label admin logo
function custom_logo() {
	echo '<style type="text/css">
	#wpadminbar > #wp-toolbar > #wp-admin-bar-root-default #wp-admin-bar-wp-logo .ab-icon {
		background: url(' . get_template_directory_uri() . '/assets/images/icons/admin-logo-20x20.png) center center no-repeat !important;
		width: 20px;
		height: 32px;
		padding: 0;
	}
	#wpadminbar > #wp-toolbar > #wp-admin-bar-root-default #wp-admin-bar-wp-logo .ab-icon:before {
		display: none !important;
	}
	</style>';
}
add_action('admin_head', 'custom_logo');

// White Label Admin Footer
function admin_footer () {
	echo '<a href="http://www.drumcreative.com" target="_blank">&copy;' . date('Y') . ' Drum Creative</a>';
}
add_filter('admin_footer_text', 'admin_footer');

// White Label Admin Login Link
add_filter( 'login_headerurl', 'custom_loginlogo_url' );
function custom_loginlogo_url($url) {
	return site_url();
}

// Filter Gravity Forms emails through WP Better Emails
add_filter('gform_notification', 'change_notification_format', 10, 3);
function change_notification_format( $notification, $form, $entry ) {
    // is_plugin_active is not availble on front end
    if( !is_admin() )
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    // does WP Better Emails exists and activated ?
    if( !is_plugin_active('wp-better-emails/wpbe.php') )
        return $notification;
    // change notification format to text from the default html
    $notification['message_format'] = "text";
    // disable auto formatting so you don't get double line breaks
    $notification['disableAutoformat'] = true;
    return $notification;
}

// Remove "You may use these HTML tags..." from comments
add_filter( 'comment_form_defaults', 'remove_comment_form_allowed_tags' );
function remove_comment_form_allowed_tags( $defaults ) {
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

// Strip header tag contents from excerpts so excerpts don't read weird
function wp_strip_header_tags( $excerpt='' ) {
	$raw_excerpt = $excerpt;
	if ( '' == $excerpt ) {
		$excerpt = get_the_content('');
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = apply_filters('the_content', $excerpt);
		$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
	}
	$regex = '#(<h([1-6])[^>]*>)\s?(.*)?\s?(<\/h\2>)#';
	$excerpt = preg_replace($regex,'', $excerpt);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$excerpt = wp_trim_words( $excerpt, $excerpt_length, $excerpt_more );
	return apply_filters('wp_trim_excerpt', preg_replace($regex,'', $excerpt), $raw_excerpt);
}
add_filter( 'get_the_excerpt', 'wp_strip_header_tags', 9);

// Don't allow TIF's to be uploaded since Chrome doesn't display them.
function unset_tiff($mime_types){
    unset($mime_types['tif|tiff']); //Removing the tif extension
    return $mime_types;
}
add_filter('upload_mimes', 'unset_tiff', 1, 1);


// Enable vCard Upload 
function enable_vcard_upload( $mime_types ){
  $mime_types['vcf'] = 'text/x-vcard';
  return $mime_types;
}
add_filter('upload_mimes', 'enable_vcard_upload' );



// Generate image that is resized using WP Thumb and that is output using responsive image markup
// This gives you full control of proportions
function drum_image($id,$small,$medium,$large,$lazy = true) {
	$image_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
	$image_url = wp_get_attachment_url( $id );
	$image_small = wpthumb( $image_url, 'width=' . $small['width'] . '&height=' . $small['height'] . '&crop=1');
	if ($image_small == null) { $image_small = $image_url; }
	$image_medium = wpthumb( $image_url, 'width=' . $medium['width'] . '&height=' . $medium['height'] . '&crop=1');
	if ($image_medium == null) { $image_medium = $image_url; }
	$image_large = wpthumb( $image_url, 'width=' . $large['width'] . '&height=' . $large['height'] . '&crop=1');
	if ($image_large == null) { $image_large = $image_url; }
	if ($lazy) {
		$image = '<img data-src="' . $image_large . '" alt="' . $image_alt .'" data-srcset="' . $image_large . ' 1100w, ' . $image_small . ' 640w, ' . $image_medium . ' 1024w" sizes="(max-width: 1100px) 100vw, 1100px" class="lazyload" />';
	} else {
		$image = '<img src="' . $image_large . '" alt="' . $image_alt .'" data-srcset="' . $image_large . ' 1100w, ' . $image_small . ' 640w, ' . $image_medium . ' 1024w" sizes="(max-width: 1100px) 100vw, 1100px" />';
	}
	return $image;
}

// Add lazy load class to all images
function img_responsive($content){
    return str_replace('<img class="','<img class="lazyload ',$content);
}
add_filter('the_content','img_responsive');

// Generate image that is resized using WP Thumb and that is output using responsive image markup
// Automatically calculates proportions for you
function drum_image_auto($id,$large,$lazy = true) {
	$image_alt = get_post_meta($id, '_wp_attachment_image_alt', true);
	$image_url = wp_get_attachment_url( $id );
	$medium_width = 1025;
	$medium_proportion = $medium_width / $large['width'];
	$medium_height = round( ( $medium_proportion * $large['height'] ) );
	$small_width = 640;
	$small_proportion = $small_width / $large['width'];
	$small_height = round( ( $small_proportion * $large['height'] ) );
	$image_small = wpthumb( $image_url, 'width=' . $small_width . '&height=' . $small_height . '&crop=1');
	if ($image_small == null) { $image_small = $image_url; }
	$image_medium = wpthumb( $image_url, 'width=' . $medium_width . '&height=' . $medium_height . '&crop=1');
	if ($image_medium == null) { $image_medium = $image_url; }
	$image_large = wpthumb( $image_url, 'width=' . $large['width'] . '&height=' . $large['height'] . '&crop=1');
	if ($image_large == null) { $image_large = $image_url; }
	if ($lazy) {
		$image = '<img data-src="' . $image_large . '" alt="' . $image_alt .'" data-srcset="' . $image_large . ' 1100w, ' . $image_small . ' 640w, ' . $image_medium . ' 1024w" sizes="(max-width: 1100px) 100vw, 1100px" class="lazyload" />';
	} else {
		$image = '<img src="' . $image_large . '" alt="' . $image_alt .'" data-srcset="' . $image_large . ' 1100w, ' . $image_small . ' 640w, ' . $image_medium . ' 1024w" sizes="(max-width: 1100px) 100vw, 1100px" />';
	}
	return $image;
}

// Add no-border class to gallery items
function add_class_to_gallery($link, $id) {
	$border = true;
	$border = get_field('border', $id);
	if (!$border) {
		return str_replace('attachment-thumbnail', 'attachment-thumbnail no-border', $link);
	} else {
		return $link;
	}
}
add_filter( 'wp_get_attachment_link', 'add_class_to_gallery', 10, 2 );

// Add stylesheet to WYSIWYG
function drum_beat_add_editor_styles() {
    add_editor_style( 'assets/stylesheets/wysiwyg-style.css' );
}
add_action( 'admin_init', 'drum_beat_add_editor_styles' );

/**
 * Register the required plugins for this theme.
 */
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {
    $plugins = array(

        // Require Gravity Forms
        array(
            'name'               => 'Gravity Forms', // The plugin name.
            'slug'               => 'gravityforms', // The plugin slug (typically the folder name).
            'source'             => 'http://drumcreative.com/wp-content/required-plugins/gravityforms.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),

        // ACF Pro
        array(
            'name'               => 'Advanced Custom Fields Pro', // The plugin name.
            'slug'               => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
            'source'             => 'http://drumcreative.com/wp-content/required-plugins/advanced-custom-fields-pro.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
        ),

        // Require Wordpress SEO
        array(
            'name'      => 'WordPress SEO by Yoast',
            'slug'      => 'wordpress-seo',

            'required'  => true,
        ),

        // Require WP Thumb
        array(
            'name'      => 'WP Thumb',
            'slug'      => 'wp-thumb',
            'required'  => true,
        ),

        // Require WP LazySizes
        array(
            'name'      => 'WP LazySizes',
            'slug'      => 'wp-lazysizes-master',
            'source'    => 'http://drumcreative.com/wp-content/required-plugins/wp-lazysizes-master.zip', // The plugin source.
            'required'  => true,
        ),

        // Require WP Featherlight Field
        array(
            'name'      => 'WP Featherlight',
            'slug'      => 'wp-featherlight',
            'required'  => true,
        ),

    );
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'drum-beat-6-starter-theme' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'drum-beat-6-starter-theme' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'drum-beat-6-starter-theme' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}

// Add Schema.org support
function html_tag_schema() {
    $schema = 'http://schema.org/';
    // Is single post
    if(is_single()) {
        $type = "Article";
    }
    // Is author page
    elseif( is_author() ) {
        $type = 'ProfilePage';
    }
    // Contact form page ID
    elseif( is_page(1) ) {
        $type = 'ContactPage';
    }
    // Is search results page
    elseif( is_search() ) {
        $type = 'SearchResultsPage';
    } else {
        $type = 'WebPage';
    }
    echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
}

// Disable comments on media attachments
function filter_media_comment_status( $open, $post_id ) {
	$post = get_post( $post_id );
	if( $post->post_type == 'attachment' ) {
		return false;
	}
	return $open;
}
add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );

// Add User Browser and OS Classes to Body Class
function custom_body_classes($classes) {
    // the list of WordPress global browser checks
    // https://codex.wordpress.org/Global_Variables#Browser_Detection_Booleans
    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    // check the globals to see if the browser is in there and return a string with the match
    $classes[] = str_replace( 'is_' , '' , join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    })));
    return $classes;
}
// call the filter for the body class
add_filter('body_class', 'custom_body_classes');

// Remove "Custom Fields" meta box to speed up admin
function admin_speedup_remove_post_meta_box() {
	global $post_type;
	if ( is_admin()  && post_type_supports( $post_type, 'custom-fields' )) {
		remove_meta_box( 'postcustom', $post_type, 'normal' );
	}
}
add_action( 'add_meta_boxes', 'admin_speedup_remove_post_meta_box' );

// Add field type class to Gravity Forms fields
add_filter( 'gform_field_css_class', 'gf_field_type_classes', 10, 3 );
function gf_field_type_classes( $classes, $field, $form ) {
	if (!is_admin()) {
	    $classes .= ' gfield_' . $field->type;
	}
	return $classes;
}

// Set logo using Wordpress Customizer
function drum_logo_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'drum_logo' ); // Add setting for logo uploader

    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'drum_logo', array(
        'label'    => __( 'Upload Logo (replaces Drum Logo)', 'drum' ),
        'section'  => 'title_tagline',
        'description'  => 'When you upload a logo it will replace the drum logo. Please try to keep the <strong>logo width to 250 pixels</strong>.',
        'settings' => 'drum_logo',
    ) ) );
}
add_action( 'customize_register', 'drum_logo_customize_register' );

// Check to see if this is a blog-related page
function is_blog() {
	if (is_home() || is_singular('post') || is_post_type_archive('post') || is_archive()) {
		return true;
	} else {
		return false;
	}
}

// Check to see if WooCommerce is activated
if ( !function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

// Add role class to body
function add_role_to_body($classes) {
	if (is_user_logged_in()) {
		global $current_user;
		$user_role = array_shift($current_user->roles);
		$classes[] = 'role-'. $user_role;
	}
	return $classes;
}
add_filter('body_class','add_role_to_body');

// Ensure cart contents update when products are added to the cart via AJAX
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    ?>
    <a class="view-cart-icon" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><span><?php echo WC()->cart->cart_contents_count; ?></span></a>
    <?php
    $fragments['a.view-cart-icon'] = ob_get_clean();
    return $fragments;
}

// Add ACF Options Page
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title' 	=> 'Options',
        'menu_title'	=> 'Options',
        'menu_slug' 	=> 'options',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

    acf_add_options_sub_page(array(
        'page_title' 	=> 'Admin Dashboard Settings',
        'menu_title'	=> 'Dashboard Settings',
        'parent_slug'	=> 'options',
    ));
}

// Output Address with directions button. Links to Apple Maps on an iPhone/iPad.
function drum_smart_address($street1,$street2,$city,$state,$zip) {
	// Format address for links to map
	if ($street2 == null) {
		$address = $street1 . ', ' . $street2 . ', ' . $city . ', ' . $state . ' ' . $zip;
	} else {
		$address = $street1 . ', ' . $city . ', ' . $state . ' ' . $zip;
	}
	// Create address output
	$output = $street1 . '<br />';
	if ($street2 != null) {
		$output .= $street2 . '<br />';
	}
	$output .= $city . ', ' . $state . ' ' . $zip;
    return $output;
}

// Display phone number and convert to a button for mobile
function drum_smart_phone($phone, $button_text = 'Click to Call', $phone_prefix) {
	$clean_phone = preg_replace("/[^0-9]/","",$phone);
	$output = '<span class="hide-for-small">' . $phone_prefix . $phone . '</span>';
	$output .= '<span class="button"><a class="show-for-small" href="tel:' . $clean_phone . '">' . $button_text . '</a></span>';
	return $output;
}

// Output Directions button. Links to Apple Maps on an iPhone/iPad.
function drum_smart_directions($street1,$street2,$city,$state,$zip) {
	// Format address for links to map
	if ($street2 == null) {
		$address = $street1 . ', ' . $street2 . ', ' . $city . ', ' . $state . ' ' . $zip;
	} else {
		$address = $street1 . ', ' . $city . ', ' . $state . ' ' . $zip;
	}
	// Show 'Get Directions' button
	$clean_address = urlencode( strip_tags($address) );
	$detect = new Mobile_Detect;
	$output = '<div class="button">';
	if( $detect->isiOS() ) {
    	$output .= '<a href="http://maps.apple.com/?daddr=' . $clean_address . '">Apple Maps';
	} else {
	    $output .= '<a href="http://maps.google.com/?q=' . $clean_address . '" target="_blank">Get Directions';
	}
    $output .= '</a></div>';
    return $output;
}

/**
 * Add placeholders to comment form
 */
 function placeholder_author_email_url_form_fields($fields) {
    $replace_author = __('Your Name *', 'textdomain');
    $replace_email = __('Your Email *', 'textdomain');
    $replace_url = __('Your Website *', 'textdomain');

    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'textdomain' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" placeholder="'.$replace_author.'" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></p>';

    $fields['email'] = '<p class="comment-form-email"><label for="email">' . __( 'Email', 'textdomain' ) . '</label> ' .
    ( $req ? '<span class="required">*</span>' : '' ) .
    '<input id="email" name="email" type="text" placeholder="'.$replace_email.'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' /></p>';

    $fields['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website', 'textdomain' ) . '</label>' .
    '<input id="url" name="url" type="text" placeholder="'.$replace_url.'" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" /></p>';

    return $fields;
}
add_filter('comment_form_default_fields','placeholder_author_email_url_form_fields');

/**
 * Comment Form Placeholder Comment Field
 */
 function placeholder_comment_form_field($fields) {
    $replace_comment = __('Your Comment', 'textdomain');

    $fields['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) .
    '</label><textarea id="comment" name="comment" cols="45" rows="8" placeholder="'.$replace_comment.'" aria-required="true"></textarea></p>';

    return $fields;
 }
add_filter( 'comment_form_defaults', 'placeholder_comment_form_field' );

// Add notice stating featured image size
add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
    return $content .= '<p>Featured Image must be sized to at least 1400 x 556 pixels.</p>';
}

// Set WYSIWYG Colors on Options Page - http://stackoverflow.com/questions/23171247/add-custom-text-color-wordpress-3-9-tinymce-4-visual-editor
function my_mce4_options($init) {
	$default_colors = '';
	if(get_field('wysiwyg_colors','option')):
		while(has_sub_field('wysiwyg_colors','option')):
			$default_colors .= '"' . ltrim(get_sub_field('color'), '#') . '", "' . get_sub_field('color_name') . '",';
		endwhile;
	endif;
	$init['textcolor_map'] = '['.$default_colors.']';
	return $init;
}
add_filter('tiny_mce_before_init', 'my_mce4_options');

/**
 * ACF: Keep the last edited tab selection when post refreshes.
 *
 * When a post containing ACF tabs is opened for edits, the currently selected tab
 * will be saved in a transient. Upon save or refresh of the page, the last selected
 * tab will be selected again, making it more convenient to work with ACF tabs.
 *
 * @link https://gist.github.com/gchtr/2d371918f3778683c61f629dbc545972
 */
class Acf_Current_Tab {
	/**
	 * Name under which the transient for the current tab will be saved.
	 * @var string
	 */
	private $_transient_name = 'acf_current_tab';
	/**
	 * Number of minutes the transient will be saved.
	 * @var int
	 */
	private $_transient_minutes = 5;
	public function __construct() {
		add_action( 'acf/input/admin_footer', array( $this, 'handle_tab' ) );
		add_action( 'wp_ajax_acf_save_current_tab', array( $this, 'ajax_acf_save_current_tab' ) );
	}
	/**
	 * Select tab that was selected in last edit session of the post.
	 *
	 * - If the time the same post that was last edited lies within the time the
	 *   transient exists, the last selected tab will be selected via JavaScript.
	 * - If a new post is opened for editing, the current tab will be overwritten.
	 */
	public function handle_tab() {
		$screen = get_current_screen();
		// Run only when post_id is present
		if (( ! isset( $_GET['post'] ) || ! is_numeric( $_GET['post'])) && $screen->id != 'toplevel_page_acf-options' ) {
			return;
		}
		if ($screen->id != 'toplevel_page_acf-options') {
			$post_id = sanitize_key( $_GET['post'] );
		} else {
			$post_id = $screen->id;
		}
		// Check for existing transient
		$current_tab = get_transient( $this->_transient_name );
		// Use value only once, delete transient right away
		delete_transient( $this->_transient_name );
		// The first tab is selected by default
		$tab_index = 0;
		// Get tab index for current post
		if ( $current_tab['post_id'] === $post_id ) {
			$tab_index = $current_tab['tab_index'];
		}
		?>
		<script type="text/javascript">
			(function($) {
				/**
				 * Global to save the current index of selected tab
				 * @type int
				 */
				window.acf_current_tab_index = null;
				acf.add_action('ready', function( $el ){
					var tabIndex = <?php echo $tab_index; ?>
					// Get tab element by index
					var $li = $('.acf-tab-group').find('li:eq(<?php echo $tab_index; ?>)');
					// Select tab only when it’s not the first tab, which is selected by default
					if (0 !== tabIndex) {
						$li.find('a').click();
					}
					window.acf_current_tab_index = tabIndex;
				});
				acf.add_action('refresh', function($tabGroup) {
					var $currentTab;
					var currentTabIndex = window.acf_current_tab_index;
					var newTabIndex;
					// Bail out if we have no jQuery object
					if (false === $tabGroup instanceof jQuery) {
						return;
					}
					$currentTab = $tabGroup.find('li.active');
					// Bail out if no active tab was found
					if ($currentTab.length === 0) {
						return;
					}
					// Get index of active tab
					newTabIndex = $currentTab.index();

					// Bail out if index is initial or previously selected tab is the same
					if (null === currentTabIndex || newTabIndex === currentTabIndex) {
						return;
					}
					window.acf_current_tab_index = newTabIndex;
					// Send tabIndex to backend to save transient
					$.ajax(ajaxurl, {
				        method: 'post',
				        data: {
							action: 'acf_save_current_tab',
							tab_index: newTabIndex,
							post_id: '<?php echo $post_id; ?>'
				        }
			        });
				});
			})(jQuery);
		</script>
		<?php
	}
	public function ajax_acf_save_current_tab() {
		$tab_index = $_POST['tab_index'];
		$post_id = $_POST['post_id'];
		$transient_value = array(
			'tab_index' => $tab_index,
			'post_id' => $post_id,
		);

		$result = set_transient( $this->_transient_name, $transient_value, $this->_transient_minutes * 60 );
		if ( $result ) {
			wp_send_json_success();
		}
		wp_die();
	}
}
if ( is_admin() ) {
	new Acf_Current_Tab();
}

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/assets/stylesheets/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

// Add button shortcode button to TinyMCE
require_once( 'editor-buttons/tinymce-buttons.php' );

// Add button shortcode
add_shortcode( 'button', 'button_shortcode' );
function button_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'size' => 'normal',
        'type' => 'primary',
        'align' => 'text-left'
    ), $atts ) );
	$html = '<div class="button ' . $size . ' ' . $type . ' ' . $align . '">' . $content . '</div>';
    return $html;
}
?>