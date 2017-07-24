<?php
/**
Plugin Name:     Drum Dashboard
Plugin URI:      https://cliftonc0613@bitbucket.org/drumcreative/drum-dashboard
Description:     This plugin adds a set of panels in the dashboard for the client.
Author:          Drum Creative
Author URI:      https://drumcreative.com
Text Domain:     drumcreative-drum-dashboard
Domain Path:     /languages
Version:         0.2.0
@package         Drum_Dashboard
 */

/*
add_action( 'plugins_loaded', 'myplugin_git_updater' );

function myplugin_git_updater() {
    if ( is_admin() && !class_exists( 'GPU_Controller' ) ) {
        require_once dirname( __FILE__ ) . '/git-plugin-updates/git-plugin-updates.php';
        add_action( 'plugins_loaded', 'GPU_Controller::get_instance', 20 );
    }
}
*/

// Show Dashboard Settings submenu for selected user only
function remove_menus() {
    $user = wp_get_current_user();
    $allowed_user = get_field('allowed_user','option');
    if ($allowed_user != null) {
	    if ($user->ID != $allowed_user['ID']) {
    	    remove_menu_page('admin-dashboard');
    	}
    }
}
add_action('admin_menu', 'remove_menus', 999);


// Disables ALL Panels on admin Dashboard
function my_remove_dashboard_widgets() {
global $wp_meta_boxes;

unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
unset($wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview']);
unset($wp_meta_boxes['dashboard']['normal']['core']['wpe_dify_news_feed']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

// remove Gavity Form Meta Box
//    remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal');

}
add_action('wp_dashboard_setup', 'my_remove_dashboard_widgets' );

// Disables Woocommerce Panels on admin Dashboard
function remove_woocommerce_dashboard_widgets() {

// remove WooCommerce Dashboard Status
remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal');
remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal');
}
add_action('wp_user_dashboard_setup', 'remove_woocommerce_dashboard_widgets', 20);
add_action('wp_dashboard_setup', 'remove_woocommerce_dashboard_widgets', 20);




add_action('admin_enqueue_scripts','admin_script');
function admin_script() {
    if(is_admin()){

		wp_register_style('dashboard-styles', plugins_url('style.css',__FILE__ ));
		wp_enqueue_style('dashboard-styles');

	    wp_register_style('dashboard-app-styles', plugins_url('/assets/stylesheets/app.min.css',__FILE__ ));
		wp_enqueue_style('dashboard-app-styles');

        wp_enqueue_script('fitvids', plugins_url('/assets/javascript/jquery.fitvids.js',__FILE__ ), array('jquery'));
        wp_enqueue_script('fitvids');
        wp_enqueue_script('admin_script', plugins_url('/assets/javascript/plugin_script.js',__FILE__ ), array('jquery'));
        wp_enqueue_script('admin_script');
    }
}
/**
*	Adds hidden content to admin_footer, then shows with jQuery, and inserts after welcome panel
*
*@author Ren Ventura <EngageWP.com>
*@see http://www.engagewp.com/how-to-create-full-width-dashboard-widget-wordpress
*/
    add_action( 'admin_footer', 'drum_custom_dashboard_widget' );

    /**
    *	Adds hidden content to admin_footer, then shows with jQuery, and inserts after welcome panel
    *
    */
    add_action( 'admin_footer', 'drum_custom_dashboard_widget' );
    function drum_custom_dashboard_widget() {
    // Bail if not viewing the main dashboard page
    if ( get_current_screen()->base !== 'dashboard' ) {
    return;
    }
    ?>

    <?php if( get_field('show_welcome_screen', 'option') == true ): ?>
    <div id="drum-welcome" class="welcome-panel drum-panel" style="display: none;">
        <div class="welcome-panel-content drum-panel-content">
            <?php echo the_field('admin_intro_content', 'option');?>
            <div class="welcome-panel-column-container">
                <div class="large-3 medium-12 small-12 column panel-1">
                    <img src="<?php echo plugins_url('/assets/images/admin-logo.png', __FILE__ );?>" alt="Drum Logo">
                </div>
                <div class="large-4 medium-6 small-12 column panel-2">
                    <div class="maintenance">
                        <?php if( get_field('maintenance_hours', 'option')): ?>
                                <h1>Maintenance:
                                <?php if( get_field('maintenance_hours', 'option') || get_field('maintenance_hours', 'option') == 0 ): ?>
                                <span class="no-wrap"><?php echo the_field('maintenance_hours', 'option');?> Hrs</span>
                                <?php endif; ?>
                                </h1>
                            <?php if( get_field('maintenance_hours', 'option') == 0 ): ?>
                                <a class="button button-primary button-hero" href="mailto:support@drumcreative.com">Signup For Maintenance</a>
                            <?php else: ?>
                                <a class="button button-primary button-hero" href="mailto:support@drumcreative.com">Submit Support Ticket</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <h1>Maintenance: </h1> <a class="button button-primary button-hero" href="mailto:support@drumcreative.com">Signup For Maintenance</a>
                        <?php endif; ?>

                    </div>
                    <div class="hosting">
                        <h1>Hosting: <span class="no-wrap"><?php echo the_field('hosting', 'option');?></span></h1>
                    </div>
                </div>
                <div class="large-5 medium-6 small-12 column panel-3">
                	<?php if( get_field('account_manager', 'option') == 'Joe' ): ?>
		                <h1>Account Manager</h1>
		                <p><strong>Name:</strong> Joe LaPenna</p>
		                <p><strong>Email:</strong> <a href="mailto:joe@drumcreative.com">joe@drumcreative.com</a></p>

		                <p><strong>Phone:</strong> 864.254.6096 ext. 1</p>
		            <?php elseif( get_field('account_manager', 'option') == 'Dana' ): ?>
		                <h1>Account Manager</h1>
		                <p><strong>Name:</strong> Dana Goos</p>
		                <p><strong>Email:</strong> <a href="mailto:dana@drumcreative.com">dana@drumcreative.com</a></p>
		                <p><strong>Phone:</strong> 864.254.6096 ext. 11</p>
		            <?php endif; ?>
		            <p><strong>Hours:</strong> Mon. – Fri. 8am-5pm EST</p>
            	</div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if( get_field('show_video_tutorials', 'option') == true ): ?>
    <div id="drum-video" class="welcome-panel drum-panel" style="display: none;">
        <div class="welcome-panel-content drum-panel-content">
            <?php echo the_field('video_admin_intro_content', 'option');?>
            <div class="welcome-panel-column-container">

                <?php
                if( have_rows('videos','option') ):
                    while ( have_rows('videos', 'option') ) : the_row(); ?>
                        <div class="large-3 medium-6 short-delay columns tut-video">
                            <iframe width="560" height="370" src="https://player.vimeo.com/video/<?php echo the_sub_field('video_id');?>?portrait=0&byline=0" frameborder="0" allowfullscreen></iframe>
                        </div> <!-- .tut-video -->
                    <?php endwhile;
                endif;
                ?>

            </div><!-- .welcome-panel-column-container -->
        </div><!-- .drum-panel-content -->
    </div><!-- #drum-video -->
    <?php endif; ?>
    <?php if( get_field('show_drum_hosting_ad', 'option') == true ): ?>
    <div id="drum-ad" class="welcome-panel drum-panel" style="display: none;">
        <div class="welcome-panel-content drum-panel-content">
            <?php if( get_field('drum_ad', 'option') == 'Ad Maintenance' ): ?>
                <a href="http://drumcreative.com/dashboard-maintenance" target="_blank">
                    <img src="http://drumcreative.com/ads/ad-maintenance.jpg" alt="Maintenance Add"/>
                </a> <!-- drum ad- -->
            <?php elseif( get_field('drum_ad', 'option') == 'Ad SEO' ): ?>
                <a href="http://drumcreative.com/dashboard-seo" target="_blank">
                    <img src="http://drumcreative.com/ads/ad-seo.jpg" alt="SEO Add"/>
                </a> <!-- drum ad- -->
            <?php else: ?>
                <a href="http://drumcreative.com/dashboard-hosting" target="_blank">
                    <img src="http://drumcreative.com/ads/ad-hosting.jpg" alt="Hosting Add"/>
                </a> <!-- drum ad- -->
            <?php endif; ?>

        </div><!-- .drum-panel-content -->
    </div><!-- #drum-ad -->
    <?php endif; ?>
    <script src="https://player.vimeo.com/api/player.js"></script>
        <script>
            jQuery(document).ready(function() {
                jQuery('#dashboard-widgets-wrap').prepend(jQuery('#drum-ad').show());
                jQuery('#dashboard-widgets-wrap').prepend(jQuery('#drum-video').show());
                jQuery('#dashboard-widgets-wrap').prepend(jQuery('#drum-welcome').show());

            });
        </script>

<?php }

if( function_exists('acf_add_options_page') ) {

    $option_page = acf_add_options_page(array(
        'page_title' 	=> 'Admin Dashboard',
        'menu_title' 	=> 'Admin Dashboard',
        'menu_slug' 	=> 'admin-dashboard',
        'capability' 	=> 'edit_posts',
        'redirect' 	=> false
    ));

}

//Change ACF Local JSON save location to /acf folder inside this plugin
add_filter('acf/settings/save_json', function() {
    return dirname(__FILE__) . '/acf';
});

//Include the /acf folder in the places to look for ACF Local JSON files
add_filter('acf/settings/load_json', function($paths) {
    $paths[] = dirname(__FILE__) . '/acf';
    return $paths;
});
?>