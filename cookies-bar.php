<?php
/*
 * Plugin Name: Cookies Bar
 * Description: With this lightweight plugin you can display a cookie compliance bar (banner) at the bottom of your site.
 * Version: 1.0.2
 * Author: Guido
 * Author URI: https://www.guido.site
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Requires CP: 2.0
 * Requires PHP: 7.4
 * Text Domain: cookies-bar
 */

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// enqueue scripts
function cookies_bar_enqueue_scripts() {
	wp_enqueue_style( 'cookies-bar-styles', plugins_url( '/css/cookies-bar-style.min.css',__FILE__ ), array(), false );
	wp_enqueue_script( 'cookies-bar-script', plugins_url( '/js/cookies-bar-script.js' , __FILE__ ), array(), false, true );
	// add expiration to script
	$expiration_setting = get_option( 'cookies-bar-setting-3' );
	$expiration = strtotime( 'now' );
	if ( $expiration_setting == 'hour' ) {
		$expiration = strtotime( '+1 hour' );
	} else if ( $expiration_setting == 'day' ) {
		$expiration = strtotime( '+1 day' );
	} else if ( $expiration_setting == 'week' ) {
		$expiration = strtotime( '+1 week' );
	} else if ( $expiration_setting == 'month' ) {
		$expiration = strtotime( '+1 month' );
	}
	$args = array(
		'cookieValue' => $expiration,
		'cookieExpires' => gmdate( 'Y M d H:i:s', $expiration ),
	);
	wp_localize_script( 'cookies-bar-script', 'objectL10n', $args );
}
add_action( 'wp_enqueue_scripts', 'cookies_bar_enqueue_scripts' );

// delete cookie if turned off
function cookies_bar_delete_cookie() {
	$cookie_bar_setting = get_option( 'cookies-bar-setting-2' );
	if ( $cookie_bar_setting == 'off' ) {
		if ( isset( $_COOKIE['cookies_bar'] ) ) {
			setcookie( 'cookies_bar', '', time() - 3600 );
		}
	}
}
add_action( 'init', 'cookies_bar_delete_cookie' );

// create cookies bar
function cookies_bar_display() {
	$cookie_bar_setting = get_option( 'cookies-bar-setting-2' );
	$expiration_setting = get_option( 'cookies-bar-setting-3' );
	if ( $cookie_bar_setting == 'on' ) {
		if ( ( $expiration_setting == 'hour' ) || ( $expiration_setting == 'day' ) || ( $expiration_setting == 'week' ) || ( $expiration_setting == 'month' ) ) {
			if ( ! isset( $_COOKIE['cookies_bar'] ) ) {
				// cookies bar variables
				$cookies_bar_font_size = empty( get_option( 'cookies-bar-setting-12' ) ) ? '16' : get_option( 'cookies-bar-setting-12' );
				$cookies_bar_background = empty( get_option( 'cookies-bar-setting-8' ) ) ? '#333' : get_option( 'cookies-bar-setting-8' );
				$cookies_bar_color = empty( get_option( 'cookies-bar-setting-9' ) ) ? '#fff' : get_option( 'cookies-bar-setting-9' );
				$cookies_bar_button_background = empty( get_option( 'cookies-bar-setting-10' ) ) ? '#f26535' : get_option( 'cookies-bar-setting-10' );
				$cookies_bar_button_color = empty( get_option( 'cookies-bar-setting-11' ) ) ? '#fff' : get_option( 'cookies-bar-setting-11' );
				$cookies_bar_message = __( 'We use cookies to make our site work. If you continue to use the site, we assume that you agree with this.', 'cookies-bar' );
				$cookies_bar_button_text = __( 'Ok', 'cookies-bar' );
				$cookies_bar_privacy_policy_url = get_option( 'cookies-bar-setting-6' );
				$cookies_bar_privacy_policy_text = __( 'Privacy Policy', 'cookies-bar' );
				if ( ! empty( get_option( 'cookies-bar-setting-4' ) ) ) {
					$cookies_bar_message = get_option( 'cookies-bar-setting-4' );
				}
				if ( ! empty( get_option( 'cookies-bar-setting-5' ) ) ) {
					$cookies_bar_button_text = get_option( 'cookies-bar-setting-5' );
				}
				if ( ! empty( get_option( 'cookies-bar-setting-7' ) ) ) {
					$cookies_bar_privacy_policy_text = get_option( 'cookies-bar-setting-7' );
				}
				if ( ! empty( $cookies_bar_privacy_policy_url ) ) {
					$privacy_policy = '<a class="privacy-policy" href="'.esc_url( $cookies_bar_privacy_policy_url ).'" target="_blank">'.esc_html( $cookies_bar_privacy_policy_text ).'</a>';
				} else {
					$privacy_policy = '';
				}
				// cookies bar
				?>
				<div id="cookies-bar" class="cookies-bar" style="font-size:<?php echo esc_attr( $cookies_bar_font_size ); ?>px;background-color:<?php echo esc_attr( $cookies_bar_background ); ?>;color:<?php echo esc_attr( $cookies_bar_color ); ?>"><?php echo wp_kses_post( $cookies_bar_message ); ?><button onclick="cookiesBarCreateCookie()" style="background-color:<?php echo esc_attr( $cookies_bar_button_background ); ?>;color:<?php echo esc_attr( $cookies_bar_button_color ); ?>"><?php echo esc_html( $cookies_bar_button_text ); ?></button><?php echo wp_kses_post( $privacy_policy ); ?></div>
				<?php
			}
		}
	}
}
add_action( 'wp_footer', 'cookies_bar_display' );

// add settings link
function cookies_bar_action_links( $links ) {
	$settingslink = array( '<a href="'. admin_url( 'options-general.php?page=cookies-bar' ) .'">'. __( 'Settings', 'cookies-bar' ) .'</a>' );
	return array_merge( $links, $settingslink );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'cookies_bar_action_links' );

// include options file
include 'cookies-bar-options.php';
