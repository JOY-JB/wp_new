<?php
/*
Plugin Name: Laurent Twitter Feed
Plugin URI: https://qodeinteractive.com
Description: Plugin that adds Twitter feed functionality to our theme
Author: Elated Themes
Author URI: https://qodeinteractive.com
Version: 1.1.1
*/

define( 'LAURENT_TWITTER_FEED_VERSION', '1.1.1' );
define( 'LAURENT_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'LAURENT_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'LAURENT_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'LAURENT_TWITTER_ASSETS_PATH', LAURENT_TWITTER_ABS_PATH . '/assets' );
define( 'LAURENT_TWITTER_ASSETS_URL_PATH', LAURENT_TWITTER_URL_PATH . 'assets' );
define( 'LAURENT_TWITTER_SHORTCODES_PATH', LAURENT_TWITTER_ABS_PATH . '/shortcodes' );
define( 'LAURENT_TWITTER_SHORTCODES_URL_PATH', LAURENT_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'laurent_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function laurent_twitter_theme_installed() {
		return defined( 'LAURENT_ELATED_ROOT' );
	}
}

if ( ! function_exists( 'laurent_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function laurent_twitter_feed_text_domain() {
		load_plugin_textdomain( 'laurent-twitter-feed', false, LAURENT_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'laurent_twitter_feed_text_domain' );
}