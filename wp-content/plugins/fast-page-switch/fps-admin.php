<?php

add_action( 'admin_menu', 'fps_add_admin_menu' );
function fps_add_admin_menu()
{
	add_submenu_page(
        'options-general.php',
        'Fast Page Switch',
        'Fast Page Switch',
        'manage_options',
        'Fast Page Switch',
        '_fps_options_page_cb'
    );
}

add_action( 'admin_init', 'fps_settings_init' );
function fps_settings_init()
{
    // Register settings

    register_setting( 'fps_options_page', 'fps_post_types' );
    register_setting( 'fps_options_page', 'fps_post_statuses' );
	register_setting( 'fps_options_page', 'fps_min_cap' );

    // Add settings sections

	add_settings_section(
		'fps_post_type_section',
		'', // title
		'', // callback
		'fps_options_page'
	);

    // Add settings fields

	add_settings_field(
		'fps_min_cap_field',
		__( 'Minimum Capability', 'fast-page-switch' ),
		'_fps_min_cap_field_cb',
		'fps_options_page', // connect to setting
		'fps_post_type_section' // connect to section
	);

	add_settings_field(
		'fps_post_type_field',
		__( 'Post Types Shown', 'fast-page-switch' ),
		'_fps_post_types_field_cb',
		'fps_options_page', // connect to setting
		'fps_post_type_section' // connect to section
	);

	add_settings_field(
		'fps_post_statuses_field',
		__( 'Posts Statuses Shown', 'fast-page-switch' ),
		'_fps_post_statuses_field_cb',
		'fps_options_page', // connect to setting
		'fps_post_type_section' // connect to section
	);
}

function _fps_post_types_field_cb()
{
    global $fps_default_types;

    $excluded_types = array(
        'attachment',
        'revision',
        'nav_menu_item',
		// acf
        'acf-field-group',
		// jetpack
        'feedback',
		// woocommerce
		'shop_order',
		'shop_coupon',
		'shop_webhook',
    );

    $registered_types = get_post_types( array('show_ui'=>true), 'objects' );

    $allowed_types = array();
    foreach( $registered_types as $type ) {
        if ( ! in_array( $type->name, $excluded_types ) )
            $allowed_types[ $type->name ] = $type->label;
    }

    $user_types = get_option( 'fps_post_types', $fps_default_types );

    foreach( $allowed_types as $type => $label ) {
        $checked = isset($user_types[$type]) ? 'checked="checked"' : '';
        echo "<label><input type='checkbox' name='fps_post_types[$type]' value='$label' $checked> $type </label> <br>";
    }
}

function _fps_post_statuses_field_cb()
{
    $all_statuses = fps_get_registered_post_stati();

    $user_statuses = get_option( 'fps_post_statuses', array(
        'private',
        'draft',
        'future',
        'pending',
        'publish',
    ) );

    sort($all_statuses);

    foreach( $all_statuses as $status ) {
        $checked = in_array( $status, $user_statuses ) ? 'checked="checked"' : '';
        echo "<label><input type='checkbox' name='fps_post_statuses[]' value='$status' $checked> $status</label> <br>";
    }
}

function _fps_min_cap_field_cb()
{
	echo '<p style="max-width:260px; font-size:13px; line-height:1.5;">';
	_e('The metabox only shows posts the current user is allowed to edit and hides itself if there aren\'t any posts.','fast-page-switch');
	echo '</p>';
}

function _fps_options_page_cb()
{
	?>
	<div class="wrap">
		<form action='options.php' method='post'>

			<h2>Fast Page Switch Settings</h2>

			<p style="max-width:500px;"><?php
				$text = sprintf(
					wp_kses(
						/* translators: %s: the url for the link */
						__('If this plugin saves you time, please <a target="_blank" href="%s">consider supporting it</a> with a good rating.','fast-page-switch'),
						array( 'a' => array('href'=>array(),'target'=>array()) )
					),
					esc_url('https://wordpress.org/support/plugin/fast-page-switch/reviews/?rate=5#new-post')
				);
				echo force_balance_tags( $text );
			?></p>

            <p style="max-width:500px;"><?php
				$text = sprintf(
					wp_kses(
						/* translators: %s: the url for the link */
						__('Please do not use the rating system for your support requests. I work diligently to maintain a great plugin. For support and feedback simply leave a message in the <a target="_blank" href="%s">support forum</a> and I will get back to you right away.','fast-page-switch'),
						array( 'a' => array('href'=>array(),'target'=>array()) )
					),
					esc_url('https://wordpress.org/support/plugin/fast-page-switch')
				);
				echo force_balance_tags( $text );
			?></p>

			<?php
				settings_fields( 'fps_options_page' );
				do_settings_sections( 'fps_options_page' );
				submit_button();
			?>

		</form>
	</div>
	<?php
}
