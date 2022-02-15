<?php
/**
 * @package jwt-auth-whitelist
 */
/*
Plugin Name: JWT Auth Whitelist
Plugin URI: https://wpmore.cn/jwt-auth-whitelist.html
Description: If you’re adding the filter inside theme and the it doesn’t work, please create a small 1 file plugin and add your filter there. It should fix the issue.
Version: 1.0.0
Author: 更好的WordPress主题
Author URI: https://wpmore.cn/
License: GPLv2 or later
Text Domain: jwt-auth-whitelist
*/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Make sure we don't expose any info if called directly
if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// JWT Auth WHITELISTING ENDPOINTS
// https://cn.wordpress.org/plugins/jwt-auth/
// https://wordpress.org/support/topic/whitelisting-endpoints-function-do-not-work/
add_filter(
	'jwt_auth_default_whitelist',
	function ( $endpoints ) {
		$whitelists = array(
			// Whitelist APIs can be increased and decreased here as needed.
			'/wp-json/indexnow/v_1.0.1/apiKey',
			'/wp-json/indexnow/v_1.0.1/submitUrl',
			'/wp-json/indexnow/v_1.0.1/apiSettings',
			'/wp-json/indexnow/v_1.0.1/getStats',
			'/wp-json/indexnow/v_1.0.1/allSubmissions',
			'/wp-json/yoast/v1/prominent_words/get_content',
			'/wp-json/yoast/v1/prominent_words/save',
			'/wp-json/yoast/v1/prominent_words/complete',
			'/wp-json/yoast/v1/workouts?_locale=user',
			'/wp-json/yoast/v1/workouts/cornerstone_data?_locale=user',
		);

		foreach ( $whitelists as $whitelist ) {
			if ( ! in_array( $whitelist, $endpoints, true ) ) {
				array_push( $endpoints, $whitelist );
			}
		}
		return $endpoints;
	},
	10,
	2
);
