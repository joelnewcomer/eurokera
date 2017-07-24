<?php // add the admin options page
add_action('admin_menu', 'loginsignup_admin_add_page');
function loginsignup_admin_add_page() {
	add_options_page('Login/Signup Modal', 'Login/Signup Modal', 'manage_options', 'loginsignup', 'loginsignup_options_page');
}

// display the admin options page
function loginsignup_options_page() {
?>
<div>
<h1>Login/Signup Modal Settings</h1>
<form action="options.php" method="post">
<?php settings_fields('loginsignup_options'); ?>
<?php do_settings_sections('loginsignup'); ?>

<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<?php
}

// add the admin settings and such
add_action('admin_init', 'loginsignup_admin_init');
function loginsignup_admin_init(){
	register_setting( 'loginsignup_options', 'loginsignup_options', 'loginsignup_options_validate' );
	add_settings_section('loginsignup_main', 'Registration Form Setting', 'loginsignup_class_section_text', 'loginsignup');
	add_settings_field('gf_form_string', 'Gravity Forms shortcode', 'gf_form_setting', 'loginsignup', 'loginsignup_main');
	add_settings_field('wpe_install_string', 'WP Engine install name', 'wpe_form_setting', 'loginsignup', 'loginsignup_main');
}

function loginsignup_class_section_text() {
	echo '<p>Enter the shortcode for the form that allows visitors to register.<br />
	Add classes "username", "email", and "password" to your form fields to add icons.</p>';

}

function gf_form_setting() {
	$options = get_option('loginsignup_options');
	echo "<input id='gf_form_string' name='loginsignup_options[gf_form_string]' size='75' type='text' value='{$options['gf_form_string']}' />";
}

function wpe_form_setting() {
	$options = get_option('loginsignup_options');
	echo "<input id='wpe_install_string' name='loginsignup_options[wpe_install_string]' size='75' type='text' value='{$options['wpe_install_string']}' />";
}



// validate our options
function loginsignup_options_validate($input) {
return $input;
}
?>