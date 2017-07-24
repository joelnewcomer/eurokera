<?php
/*
Plugin Name: Login/Signup Modal Window
Description: A CodyHouse Gem. This modal window allows users to login/signup into your website. Once opened, the user can easily switch from one form to the other, or select the reset password option.
Version: 1.0
Author: Joel Newcomer
Author URI: http://drumcreative.com
Plugin URI: http://drumcreative.com
*/

define('LOGINSIGNUP_DIR', plugin_dir_path(__FILE__));
define('LOGINSIGNUP_URL', plugin_dir_url(__FILE__));


function tabswh_load(){

    if(is_admin()) //load admin files only in admin
        require_once(LOGINSIGNUP_DIR.'includes/admin.php');
}
tabswh_load();


// Enqueue css file
/*
function login_signup_css() {
  if ( !is_admin() ) {

     wp_register_style( 'loginsignup', LOGINSIGNUP_URL . 'assets/css/login-signup.css', false );
     wp_enqueue_style( 'loginsignup' );

  }
}
add_action( 'init', 'login_signup_css' );
*/

// Enqueue jQuery Tools min js file & tabs that only includes tabs w/history code.
function loginsignup_scripts() {

  if ( !is_admin() ) {

  // Enqueue to footer
     wp_register_script( 'loginsignup', LOGINSIGNUP_URL . 'assets/js/login-signup.js', array( 'jquery' ), false, true );
     wp_enqueue_script( 'loginsignup' );
  }
}
add_action( 'wp_footer', 'loginsignup_scripts' );


function login_signup(){

$args = array(
	'echo' => false
);

$options = get_option('loginsignup_options');
$gf_shortcode = $options['gf_form_string'];
$wpe = $options['wpe_install_string'];

$return = '<nav class="util-nav">
			<ul>';
			
			if (!is_user_logged_in()) { 
				$return .= '<li><a class="cd-signin" href="#0">Sign in</a></li>
				<li><a class="cd-signup" href="#0">Sign up</a></li>';
			} else {
				$return .= '<li><a class="cd-signout" href="' . wp_logout_url( site_url() ) . '">Sign out</a></li>';
			}
				
$return .= 	'</ul>
		</nav>

<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
		<div class="cd-user-modal-container"> <!-- this is the container wrapper -->
			<ul class="cd-switcher">
				<li><a href="#0">Sign in</a></li>
				<li><a href="#0">New account</a></li>
			</ul>

			<div id="cd-login"> <!-- log in form -->

				<form class="cd-form" name="loginform" id="loginform" action="' . site_url() . '/wp-login.php?wpe-login=' . $wpe . ' " method="post">

					<p class="fieldset">
						<label class="image-replace cd-email" for="signin-email">E-mail</label>
						<input class="full-width has-padding has-border" id="signin-email" name="log" type="text" placeholder="Username or E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<label class="image-replace cd-password" for="signin-password">Password</label>
						<input class="full-width has-padding has-border" id="signin-password" type="password"  name="pwd" placeholder="Password">
						<a href="#0" class="hide-password">Hide</a>
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input type="checkbox" name="rememberme" id="rememberme" checked value="forever">
						<label for="rememberme">Remember me</label>
					</p>

					<p class="fieldset">
						<input class="full-width" type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Login" />
						<input type="hidden" name="redirect_to" value="' . site_url() . '" />
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
				<!-- <a href="#0" class="cd-close-form">Close</a> -->
			</div> <!-- cd-login -->

			<div id="cd-signup"> <!-- sign up form -->
				' . do_shortcode($gf_shortcode) . '
			</div> <!-- cd-signup -->

			<div id="cd-reset-password"> <!-- reset password form -->
				<p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

				<form class="cd-form">
					<p class="fieldset">
						<label class="image-replace cd-email" for="reset-email">E-mail</label>
						<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
						<span class="cd-error-message">Error message here!</span>
					</p>

					<p class="fieldset">
						<input class="full-width has-padding" type="submit" value="Reset password">
					</p>
				</form>

				<p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
			</div> <!-- cd-reset-password -->
			<a href="#0" class="cd-close-form">Close</a>
		</div> <!-- cd-user-modal-container -->
	</div> <!-- cd-user-modal -->';

return $return;

}

add_shortcode( 'tab', 'st_tab' );
function st_tab( $atts, $content ){
extract(shortcode_atts(array(
	'title' => '%d',
	'id' => '%d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array(
	'title' => sprintf( $title, $GLOBALS['tab_count'] ),
	'content' =>  do_shortcode($content),
	'id' =>  $id );

$GLOBALS['tab_count']++;
}
?>