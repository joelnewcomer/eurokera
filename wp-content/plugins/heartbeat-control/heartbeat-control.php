<?php
/**
 * Plugin Name: Heartbeat Control
 * Plugin URI: https://jeffmatson.net/heartbeat-control
 * Description: Completely controls the WordPress heartbeat.
 * Version: 1.1.3
 * Author: Jeff Matson
 * Author URI: http://jeffmatson.net
 * License: GPL2
 */

namespace Heartbeat_Control;

class Heartbeat_Control {

	public $version = '1.1';

	public function __construct() {
		$this->maybe_upgrade();
		$this->register_dependencies();
		require_once( dirname( __FILE__ ) . '/vendor/webdevstudios/cmb2/init.php' );
		add_action( 'cmb2_admin_init', array( new Settings, 'init_metaboxes' ) );
		add_action( 'wp_ajax_dismiss_heartbeat_control_update_notice', array( $this, 'dismiss_update_notice' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'maybe_enqueue_scripts' ) );
		new Heartbeat;
	}

	public function maybe_enqueue_scripts() {
		if ( get_option( 'heartbeat_control_update_notice' ) ) {
			wp_enqueue_script( 'heartbeat-control-notices', plugins_url( '/assets/js/notices.js' , __FILE__ ), array('jquery'), '1.0.0', true);
			wp_localize_script( 'heartbeat-control-notices', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		}
	}

	public function register_dependencies() {
		require_once( dirname( __FILE__ ) . '/autoloader.php' );
	}

	public function maybe_upgrade() {
		add_action( 'admin_notices', array( $this, 'heartbeat_control_updated' ) );
		if ( get_option( 'heartbeat_control_version' ) !== $this->version ) {
			$this->upgrade_10_to_11();
		}


	}

	public function upgrade_10_to_11() {
		$updated_options = array();
		if ( $old_location = get_option('heartbeat_location') ) {
			if ( $old_location === 'disable-heartbeat-everywhere' ) {
				$updated_options['heartbeat_control_behavior'] = 'disable';
				$updated_options['heartbeat_control_location'] = array( 'frontend', 'admin', '/wp-admin/post.php' );
			} elseif ( $old_location === 'disable-heartbeat-dashboard' ) {
				$updated_options['heartbeat_control_behavior'] = 'disable';
				$updated_options['heartbeat_control_location'] = array( 'admin' );
			} elseif ( $old_location === 'allow-heartbeat-post-edit' ) {
				$updated_options['heartbeat_control_behavior'] = 'allow';
				$updated_options['heartbeat_control_location'] = array( '/wp-admin/post.php' );
			} else {
				if ( $old_frequency = get_option('heartbeat_frequency') ) {
					$updated_options['heartbeat_control_behavior'] = 'modify';
					$updated_options['heartbeat_control_location'] = array( 'frontend', 'admin', '/wp-admin/post.php' );
					$updated_options['heartbeat_control_frequency'] = $old_frequency;
				}
			}
		}

		update_option( 'heartbeat_control_settings', $updated_options );
		update_option( 'heartbeat_control_version', '1.1' );
		update_option( 'heartbeat_control_update_notice', true );
	}

	public function heartbeat_control_updated() {
		if ( get_option('heartbeat_control_update_notice') ) {
		?>
			<div id="heartbeat_control_update_notice" class="notice notice-success is-dismissible">
				<p><?php _e( 'Heartbeat Control has updated to a new version!', 'heartbeat-control' ); ?></p>
				<p><?php _e( 'All prior settings should be preserved, but it might be a good idea to check out the settings to be sure.', 'heartbeat-control' ); ?></p>
			</div>
		<?php
		}
	}

	public function dismiss_update_notice() {
		delete_option( 'heartbeat_control_update_notice' );
	}

}

new Heartbeat_Control;
