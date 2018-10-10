<?php
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2); 

// Remove emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

ini_set('display_errors', false);

require('includes/wp_setup.php');
require('includes/globals.php');
require('includes/seo.php');
require('includes/replacers.php');

if (is_user_logged_in()) {
	add_theme_support('woocommerce');
	require('includes/woocommerce.php');
}

require('includes/wp_navmenu.php'); // for menus
require('includes/tags.php');
?>