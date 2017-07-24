<?php
/*
Plugin Name:    Fast Page Switch
Plugin URI:     https://marcwiest.com
Description:    Save time switching between posts of any post-type in wp-admin.
Version:        1.5.7
Author:         Marc Wiest
Author URI:     https://marcwiest.com
License:        GPL-2.0+
License URI:    http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:    fast-page-switch
Domain Path:    /languages
*/

// Abort if accessed directly.
if ( ! defined( 'WPINC' ) ) die;

define( 'FPS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'FPS_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

global $fps_default_types;
$fps_default_types = array(
    'post' => __('Posts'), // translated by wp core
    'page' => __('Pages'), // translated by wp core
);

/**
 * Load Plugin Text Domain
 */
load_plugin_textdomain( 'fast-page-switch', false, FPS_PLUGIN_DIR.'languages/' );

/**
 * Add Plugin Action Links
 */
add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), 'fps_add_action_links' );
function fps_add_action_links( $links )
{
    $links[] = '<a href="'.admin_url('options-general.php?page=Fast+Page+Switch').'">'.__('Settings','fast-page-switch').'</a>';
    return $links;
}

/**
 * Get all registered post stati.
 *
 * @return numbered array of post stati slugs
 */
function fps_get_registered_post_stati()
{
    $all_statuses = get_post_stati();

    unset($all_statuses['trash']);
    unset($all_statuses['inherit']);
    // acf
    unset($all_statuses['acf-disabled']);
    // edd payment history
    unset($all_statuses['completed']);
    unset($all_statuses['refunded']);
    unset($all_statuses['revoked']);
    unset($all_statuses['failed']);
    unset($all_statuses['abandoned']);
    // edd coupons
    unset($all_statuses['active']);
    unset($all_statuses['inactive']);
    // woocommerce
    unset($all_statuses['wc-cancelled']);
    unset($all_statuses['wc-completed']);
    unset($all_statuses['wc-failed']);
    unset($all_statuses['wc-on-hold']);
    unset($all_statuses['wc-pending']);
    unset($all_statuses['wc-processing']);
    unset($all_statuses['wc-refunded']);

    return array_values( array_flip($all_statuses) );
}

/**
 * Get the post types option.
 *
 * Filters out post types that don't exist. Important when there are saved types that aren't
 * registered anymore.
 *
 * @return array of post type names
 */
function fps_get_user_types()
{
    global $fps_default_types;
    $user_types = get_option( 'fps_post_types', $fps_default_types );
    $r = array();
    foreach( $user_types as $slug => $label ) {
        if ( post_type_exists($slug) ) {
            $r[ $slug ] = $label;
        }
    }
    return $r;
}

/**
 * Get the post statuses option.
 *
 * Filters out non-registered statuses. Important when there are saved statuses that aren't
 * registered anymore.
 *
 * @return array of post statuses
 */
function fps_get_user_statuses()
{
    $user_statuses = get_option( 'fps_post_statuses', array('private','draft','future','pending','publish') );
    $registered_statuses = fps_get_registered_post_stati();
    $r = array();
    foreach( $user_statuses as $u_status ) {
        if ( in_array( $u_status, $registered_statuses ) ) {
            $r[] = $u_status;
        }
    }
    return $r;
}

/**
 * Add Admin Settings Page
 */
include_once FPS_PLUGIN_DIR.'fps-admin.php';

/**
 * Enqueue Admin Scripts & Styles
 */
add_action( 'admin_enqueue_scripts', 'fps_admin_scripts' );
function fps_admin_scripts( $admin_page_type )
{
    // leave if not the add-new or the edit-post screen – works for any post-type, not just posts
    if ( 'post.php' != $admin_page_type && 'post-new.php' != $admin_page_type )
        return;

    $screen = get_current_screen();

    if ( ! ($screen instanceof WP_Screen) )
        return;

    $user_types = fps_get_user_types();

    if ( in_array( $screen->post_type, array_keys($user_types) ) ) {
        wp_enqueue_style( 'select2', FPS_PLUGIN_URL.'assets/css/select2.min.css', array(), '4.0.3' );
        wp_enqueue_script( 'select2', FPS_PLUGIN_URL.'assets/js/select2.min.js', array('jquery'), '4.0.3' );
    }
}

/**
 * Add Metabox
 */
add_action( 'add_meta_boxes', 'fps_add_metabox' );
function fps_add_metabox()
{
    $user_types = fps_get_user_types();

    $screen = get_current_screen();

    if ( ! ($screen instanceof WP_Screen) )
        return;

    if ( ! in_array( $screen->post_type, array_keys($user_types) ) )
        return;

    // test if the current user can edit at least one of the post-types
    $user_may_see_metabox = false;
    foreach( $user_types as $type => $label ) {
        $type_obj = get_post_type_object( $type );
        if ( current_user_can( $type_obj->cap->edit_posts ) ) {
            $user_may_see_metabox = true;
            break;
        }
    }

    if ( $user_may_see_metabox ) {
        add_meta_box(
            'fps-metabox-'.$screen->post_type,
            esc_html__( 'Fast Page Switch', 'fast-page-switch' ),
            '_fps_metabox_cb',
            $screen->post_type,
            'side',
            'high',
            null
        );
    }
}

function _fps_metabox_cb( $post )
{
    $user_types = fps_get_user_types();

    $options = array();
    foreach( $user_types as $type => $label ) {

        $all_posts = get_posts( array(
            'post_type' => $type,
            'post_status' => fps_get_user_statuses(),
            'posts_per_page' => -1,
            'orderby' => 'title',
			'order' => 'ASC',
        ) );

        $type_obj = get_post_type_object($type);

        $user_posts = array();
        foreach( $all_posts as $post_obj ) {
            // only include posts that the current user can edit
            if ( ! current_user_can( $type_obj->cap->edit_post, $post_obj->ID ) )
                continue;
            $user_posts[] = $post_obj;
        }

        if ( ! empty($user_posts) ) {
            $options[ $type ]['label'] = $label;
            $options[ $type ]['posts'] = $user_posts;
        }
    }

    if ( ! empty($options) ) {
        ?>
        <script>
        jQuery(document).ready(function($) {

            var $fps = $('#fast-page-switch'),
                s2Exists = $.isFunction( $.fn.select2 ),
                s2Version3 = false,
                admin_url = '<?php trailingslashit(admin_url()); ?>',
                curPostId = '<?php echo $post->ID; ?>';

            if ( s2Exists ) {
                $fps.select2({
                    theme: 'classic',
                    placeholder: '<?php esc_html_e('Switch','fast-page-switch'); ?>'
                });
            }

            /**
             * Select2 v4
             */
            $fps.on( 'select2:select', function(e) {

                var val = $(this).val();

                if ( hasChanges() ) {
                    // There is no way to check the return of the confirm window. Beacuse of this, if the
                    // user confirms to "leave", the spinner class can't be applied.
                    $('#fps-wrapper').removeClass('fps-js-reveal-spinner');
                    val = curPostId;
                } else {
                    $('#fps-wrapper').addClass('fps-js-reveal-spinner');
                }

                $fps.val( val ).trigger( 'change' );

                // attempt location change
                changeLocation( val );
            });

            /**
             * Select2 v3 or Standard HTML Select Element
             */
            $fps.on( 'select2-opening', function() {
                s2Version3 = true;
            });
            $fps.on( 'change', function( e, changeVal=true ) {

                if ( s2Exists && false === s2Version3 )
                    return;

                var val = $(this).val();

                if ( val !== curPostId && changeVal ) {

                    if ( hasChanges() ) {
                        $('#fps-wrapper').removeClass('fps-js-reveal-spinner');
                        val = curPostId;
                    } else {
                        $('#fps-wrapper').addClass('fps-js-reveal-spinner');
                    }

                    if ( s2Version3 ) {
                        // Select2 v3
                        $fps.select2( 'val', val );
                    } else {
                        // standard HTML select element
                        // 2nd parameter of trigger sets changeVal for event
                        $fps.val( val ).trigger( 'change', false );
                    }

                    // attempt location change
                    changeLocation( val );
                }
            });

            // If the are changes that aren't saved (or autosaved ?), this returns true.
            // Source: wp-admin/js/post.js line 482
            function hasChanges() {
                var editor = typeof tinymce !== 'undefined' && tinymce.get('content');
                if ( ( editor && ! editor.isHidden() && editor.isDirty() ) ||
                    ( wp.autosave && wp.autosave.server.postChanged() ) ) {
                    return true;
                }
                return false;
            }

            function changeLocation( val ) {
                window.location.href = admin_url + 'post.php?post=' + val + '&action=edit';
            }

            // resize select2
            $(window).resize(function(){
                window.setTimeout( function() {
                    $('.select2-container').width( $('#fps-wrapper').width()+'px' );
                }, 333 );
            });
        });
        </script>
        <style>
            #fps-wrapper {
                position: relative;
                padding-top: 6px;
            }
            #fast-page-switch {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }
            #fps-spinner {
                display: inline-block;
                position: absolute;
                top: 4px;
                right: 0;
                height: 20px;
                width: 20px;
                opacity: 0;
            }
            .select2-container {
                display: block;
            }
            #fps-wrapper.fps-js-reveal-spinner .select2-container {
                -webkit-transition: width 333ms;
                   -moz-transition: width 333ms;
                        transition: width 333ms;
                width: 90% !important;
                width: -webkit-calc( 100% - 31px ) !important;
                width: calc( 100% - 31px ) !important;
            }
            #fps-wrapper.fps-js-reveal-spinner #fps-spinner {
                padding-top: 6px;
                -webkit-transition: opacity 333ms;
                   -moz-transition: opacity 333ms;
                        transition: opacity 333ms;
                opacity: 1;
            }
            .select2-results {
                max-height: 300px !important;
            }
            .fps-settings-link {
                position: relative;
                display: inline-block;
                padding-top: 4px;
            }
        </style>
        <?php

        $html = '';

        $html .= '<div id="fps-wrapper">';
        $html .= '<img id="fps-spinner" src="'.admin_url('images/spinner-2x.gif').'" alt="image">';
        $html .= '<select id="fast-page-switch">';
        $html .= '<option></option>';
        foreach( $options as $opt ) {
            $html .= '<optgroup label="'.$opt['label'].'">';
            foreach( $opt['posts'] as $p ) {
                $selected = $post->ID == $p->ID ? ' selected="selected"' : '';
                $html .= "<option value='{$p->ID}' $selected>{$p->post_title}</option>";
            }
        }
        $html .= '</optgroup>';
        $html .= '</select>';
        if ( current_user_can('manage_options') ) {
            $html .= '<small class="fps-settings-link">';
            $html .= '<a href="'.admin_url('options-general.php?page=Fast+Page+Switch').'">'.__('Settings','fast-page-switch').'</a>';
            $html .= '</small>';
        }
        $html .= '</div>';

        echo $html;

    } else {

        // this metabox hides itself if there are no posts to show
        echo "<style>#fps-metabox-{$post->post_type}{display:none;}</style>";

    }
}
