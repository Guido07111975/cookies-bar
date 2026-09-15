<?php
// exit if uninstall is not called
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$cookies_bar_keep = get_option( 'cookies-bar-setting-1' );
if ( $cookies_bar_keep != 'yes' ) {
	// delete options
	$cookies_bar_options = array(
		'cookies-bar-setting-1',
		'cookies-bar-setting-2',
		'cookies-bar-setting-3',
		'cookies-bar-setting-4',
		'cookies-bar-setting-5',
		'cookies-bar-setting-6',
		'cookies-bar-setting-7',
		'cookies-bar-setting-8',
		'cookies-bar-setting-9',
		'cookies-bar-setting-10',
		'cookies-bar-setting-11',
	);

	foreach ( $cookies_bar_options as $option ) {
		delete_option( $option );
	}
}
