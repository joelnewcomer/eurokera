<?php

namespace Heartbeat_Control;

class Settings {

	public function render_slider_field( $field, $field_escaped_value, $field_object_id, $field_object_type, $field_type_object ) {
		echo '<div class="slider-field"></div>';
		echo $field_type_object->input( array(
			'type'       => 'hidden',
			'class'      => 'slider-field-value',
			'readonly'   => 'readonly',
			'data-start' => absint( $field_escaped_value ),
			'data-min'   => $field->min(),
			'data-max'   => $field->max(),
			'data-step'  => $field->step(),
			'desc'       => '',
		) );
		echo '<span class="slider-field-value-display">'. $field->value_label() .' <span class="slider-field-value-text"></span></span>';
		$field_type_object->_desc( true, true );
	}

	public function enqueue_scripts( $hook ) {
		if ( $hook != 'settings_page_heartbeat_control_settings' ) {
			return;
		}

		wp_enqueue_script('heartbeat-control-settings', plugins_url( '/assets/js/bundle.js' , __FILE__ ), array('jquery', 'jquery-ui-slider'), '1.0.0', true);
		wp_localize_script( 'heartbeat-control-settings', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
		wp_register_style( 'slider_ui', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.min.css', array(), '1.0' );
		wp_enqueue_style('heartbeat-control-settings', plugins_url( '/style.css' , __FILE__ ), array('slider_ui'), '1.0.0');
	}

	public function init_metaboxes() {
		add_action( 'cmb2_render_slider', array( $this, 'render_slider_field' ), 10, 5 );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		$prefix = 'heartbeat_control_';

		$cmb = new_cmb2_box( array(
			'id'           => 'heartbeat_control_settings',
			'title'        => __( 'Heartbeat Control Settings', 'cmb2' ),
			'object_types' => array( 'options-page', ), // Post type
			'option_key'   => 'heartbeat_control_settings',
			'capability'   => 'manage_options',
			'parent_slug'   => 'options-general.php',
		) );

		$cmb->add_field( array(
			'name'       => __( 'Heartbeat Behavior', 'cmb2' ),
			'id'         => $prefix . 'behavior',
			'type'       => 'select',
			'default'          => 'allow',
			'options'          => array(
				'allow' => __( 'Allow Heartbeat', 'cmb2' ),
				'disable'   => __( 'Disable Heartbeat', 'cmb2' ),
				'modify'     => __( 'Modify Heartbeat', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name'       => __( 'Locations', 'cmb2' ),
			'id'         => $prefix . 'location',
			'type'       => 'multicheck',
			'options'          => array(
				'admin' => __( 'WordPress Dashboard', 'cmb2' ),
				'frontend'  => __( 'Frontend', 'cmb2' ),
				'/wp-admin/post.php' => __( 'Post Editor', 'cmb2' ),
			),
		) );

		$cmb->add_field( array(
			'name'       => __( 'Frequency', 'cmb2' ),
			'id'         => $prefix . 'frequency',
			'type'       => 'slider',
			'min'        => '15',
			'step' => '1',
			'max'  => '300',
			'default' => '15',
		) );
	}

}
