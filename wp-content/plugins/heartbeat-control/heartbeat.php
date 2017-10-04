<?php

namespace Heartbeat_Control;

class Heartbeat {

	public $current_screen;
	public $current_query_string;
	public $settings = array();

	public function __construct() {

		if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
			$current_url = $_SERVER['REQUEST_URI'] . '?' . $_SERVER['QUERY_STRING'];
		}  else {
			$current_url = $_SERVER['REQUEST_URI'];
		}

		$this->current_screen = parse_url( $current_url );
		$this->settings = get_option( 'heartbeat_control_settings' );

		if ( ! is_array( $this->settings ) ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'maybe_disable' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'maybe_disable' ), 99 );
		add_filter( 'heartbeat_settings', array( $this, 'maybe_modify' ), 99, 1 );
	}

	public function check_location() {
		$location = $this->settings['heartbeat_control_location'];

		if ( in_array( $this->current_screen['path'], $location ) ) {
			return true;
		} elseif ( ( ! is_admin() ) && ( in_array( 'frontend', $location ) ) ) {
			return true;
		} elseif ( ( is_admin() ) && ( in_array( 'frontend', $location ) ) ) {
			return true;
		}

		return false;
	}

	public function maybe_disable() {
		if ( array_key_exists( 'heartbeat_control_behavior', $this->settings ) && $this->settings['heartbeat_control_behavior']  === 'disable' ) {
			if ( $this->check_location() ) {
				wp_deregister_script( 'heartbeat' );
			}
		}
	}

	public function maybe_modify( $settings ) {

		if ( array_key_exists( 'heartbeat_control_behavior', $this->settings ) && $this->settings['heartbeat_control_behavior'] === 'modify' ) {
			if ( $this->check_location() ) {
				$settings['interval'] = intval( $this->settings['heartbeat_control_frequency'] );
			}
		}

		return $settings;
	}

}
