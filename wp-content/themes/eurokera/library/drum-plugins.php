<?php
/*===================================
=             Plugins               =
===================================*/

// 1. Username Allow Email LogIn - https://gist.github.com/noahbass/37c47023248b84ba4443
// 2. Shortcode Empty Paragraph Fix 0.2 - https://wordpress.org/plugins/shortcode-empty-paragraph-fix/
// 3. Email Address Encoder 1.0.5 - http://wordpress.org/plugins/email-address-encoder/
// 4. WP Comment Humility 0.1.0 - https://wordpress.org/plugins/wp-comment-humility/

// Username Allow Email LogIn - https://gist.github.com/noahbass/37c47023248b84ba4443
add_filter('authenticate', 'bainternet_allow_email_login', 20, 3);
/**
 * bainternet_allow_email_login filter to the authenticate filter hook, to fetch a username based on entered email
 * @param  obj $user
 * @param  string $username [description]
 * @param  string $password [description]
 * @return boolean
 */
function bainternet_allow_email_login( $user, $username, $password ) {
    if ( is_email( $username ) ) {
        $user = get_user_by_email( $username );
        if ( $user ) $username = $user->user_login;
    }
    return wp_authenticate_username_password(null, $username, $password );
}
 add_filter( 'gettext', 'addEmailToLogin', 20, 3 );
/**
 * addEmailToLogin function to add email address to the username label
 * @param string $translated_text   translated text
 * @param string $text              original text
 * @param string $domain            text domain
 */
function addEmailToLogin( $translated_text, $text, $domain ) {
    if ( "Username" == $translated_text )
        $translated_text .= __( ' or Email Address');
    return $translated_text;
}


// Shortcode Empty Paragraph Fix 0.2 - https://wordpress.org/plugins/shortcode-empty-paragraph-fix/
function shortcode_empty_paragraph_fix( $content ) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );
    $content = strtr( $content, $array );
    return $content;
}
add_filter( 'the_content', 'shortcode_empty_paragraph_fix' );


/*
Plugin Name: Email Address Encoder
Plugin URI: http://wordpress.org/plugins/email-address-encoder/
Description: A lightweight plugin to protect email addresses from email-harvesting robots by encoding them into decimal and hexadecimal entities.
Version: 1.0.5
Author: Till Krüss
Author URI: https://till.im/
Text Domain: email-address-encoder
Domain Path: /languages
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Define default filter-priority constant, unless it has already been defined.
 */
if ( ! defined( 'EAE_FILTER_PRIORITY' ) ) {
	define( 'EAE_FILTER_PRIORITY', 1000 );
}

/**
 * Register filters to encode plain email addresses in posts, pages, excerpts,
 * comments and text widgets.
 */
foreach ( array( 'the_content', 'the_excerpt', 'widget_text', 'comment_text', 'comment_excerpt' ) as $filter ) {
	add_filter( $filter, 'eae_encode_emails', EAE_FILTER_PRIORITY );
}

/**
 * Searches for plain email addresses in given $string and
 * encodes them (by default) with the help of eae_encode_str().
 *
 * Regular expression is based on based on John Gruber's Markdown.
 * http://daringfireball.net/projects/markdown/
 *
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_emails( $string ) {

	// abort if `$string` isn't a string
	if ( ! is_string( $string ) ) {
		return $string;
	}

	// abort if `eae_at_sign_check` is true and `$string` doesn't contain a @-sign
	if ( apply_filters( 'eae_at_sign_check', true ) && strpos( $string, '@' ) === false ) {
		return $string;
	}

	// override encoding function with the 'eae_method' filter
	$method = apply_filters( 'eae_method', 'eae_encode_str' );

	// override regex pattern with the 'eae_regexp' filter
	$regexp = apply_filters(
		'eae_regexp',
		'{
			(?:mailto:)?
			(?:
				[-!#$%&*+/=?^_`.{|}~\w\x80-\xFF]+
			|
				".*?"
			)
			\@
			(?:
				[-a-z0-9\x80-\xFF]+(\.[-a-z0-9\x80-\xFF]+)*\.[a-z]+
			|
				\[[\d.a-fA-F:]+\]
			)
		}xi'
	);

	return preg_replace_callback(
		$regexp,
		create_function(
            '$matches',
            'return ' . $method . '($matches[0]);'
        ),
		$string
	);

}

/**
 * Encodes each character of the given string as either a decimal
 * or hexadecimal entity, in the hopes of foiling most email address
 * harvesting bots.
 *
 * Based on Michel Fortin's PHP Markdown:
 *   http://michelf.com/projects/php-markdown/
 * Which is based on John Gruber's original Markdown:
 *   http://daringfireball.net/projects/markdown/
 * Whose code is based on a filter by Matthew Wickline, posted to
 * the BBEdit-Talk with some optimizations by Milian Wolff.
 *
 * @param string $string Text with email addresses to encode
 * @return string $string Given text with encoded email addresses
 */
function eae_encode_str( $string ) {

	$chars = str_split( $string );
	$seed = mt_rand( 0, (int) abs( crc32( $string ) / strlen( $string ) ) );

	foreach ( $chars as $key => $char ) {

		$ord = ord( $char );

		if ( $ord < 128 ) { // ignore non-ascii chars

			$r = ( $seed * ( 1 + $key ) ) % 100; // pseudo "random function"

			if ( $r > 60 && $char != '@' ) ; // plain character (not encoded), if not @-sign
			else if ( $r < 45 ) $chars[ $key ] = '&#x' . dechex( $ord ) . ';'; // hexadecimal
			else $chars[ $key ] = '&#' . $ord . ';'; // decimal (ascii)

		}

	}

	return implode( '', $chars );

}

/**
 * Plugin Name: WP Comment Humility
 * Plugin URI:  https://wordpress.org/plugins/wp-comment-humility/
 * Description: Move the "Comments" menu underneath "Posts"
 * Author:      John James Jacoby
 * Version:     0.1.0
 * Author URI:  https://profiles.wordpress.org/johnjamesjacoby/
 * License:     GPL v2 or later
 */


// Actions
add_action( 'admin_menu',             '_wp_comment_humility' );
add_action( 'admin_head-comment.php', '_wp_comment_humility_modify_admin_menu_highlight' );

function _wp_comment_humility() {

	// Look for
	$comments_menu = _wp_comment_humility_get_menu_index_by_slug( 'edit-comments.php' );

	// No comments
	if ( false !== $comments_menu ) {

		// Unset top level menu
		unset( $GLOBALS['menu'][ $comments_menu ], $GLOBALS['submenu'][ 'edit-comments.php' ] );

		// Move comments to underneath "Posts"
		$awaiting_mod = wp_count_comments();
		$awaiting_mod = $awaiting_mod->moderated;
		$GLOBALS['submenu']['edit.php'][9] = array( sprintf( __( 'Comments %s' ), "<span class='awaiting-mod count-{$awaiting_mod}'><span class='pending-count'>" . number_format_i18n( $awaiting_mod ) . '</span></span>' ), 'edit_posts', 'edit-comments.php' );
	}
}

function _wp_comment_humility_get_menu_index_by_slug( $location = '' ) {
	foreach ( $GLOBALS['menu'] as $index => $menu_item ) {
		if ( $location === $menu_item[2] ) {
			return $index;
		}
	}
	return false;
}

function _wp_comment_humility_modify_admin_menu_highlight() {
	$GLOBALS['plugin_page']  = 'edit.php';
}
?>