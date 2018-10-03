<?php
define('WL_TEMPLATE_DIR_URI', get_template_directory_uri());
define('WL_TEMPLATE_DIR', get_template_directory());
define('WL_TEMPLATE_LOCAL_DIR', '/wp-content/themes/STT');
define('WL_TEMPLATE_DIR_CORE' , WL_TEMPLATE_DIR . '/core');
define('BOOTSTRAP_VERSION', '3.3.7');

// Font size for category and tag clouds
function set_tag_cloud_sizes($args) {
	$args['smallest'] = 9;
	$args['largest'] = 25;
	return $args;
}
add_filter('widget_tag_cloud_args', 'set_tag_cloud_sizes');

// Function To get the Options-DATA
function stt_get_options() {
	return wp_parse_args(
		get_option('stt_options', array()),
		apply_filters('stt_options', array())
	);
}

function my_title($title, $sep) {
	if (is_feed()) return $title;

	// Add a page number if necessary.
	global $paged, $page;
	if (($paged >= 2 || $page >= 2) && !is_404()) {
		$title .= " $sep " . sprintf(__('Page %s', '_s'), max($paged, $page));
	}
	return $title;
}
add_filter('wp_title', 'my_title', 10, 2);

function stt_setup() {
	global $content_width;
	if (!isset($content_width)) {
		$content_width = 720; //px
	}

	// Load text domain for translation-ready
	//load_theme_textdomain('stt', WL_TEMPLATE_DIR_CORE . '/lang');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails'); //supports featured image

	// This theme uses wp_nav_menu() in one location.
	//register_nav_menu('primary', __('Primary Menu', 'stt'));

	// Theme support
	$args = array('default-color' => '000000');
	add_theme_support('custom-background', $args);
	add_theme_support('automatic-feed-links');
}
add_action('after_setup_theme', 'stt_setup');

// Read more tag to formatting in blog page
function stt_content_more($more) {
	global $post;
	return '<div class="blog-post-details-item blog-read-more"><a href="' . get_permalink() . '">Read more...</a></div>';
}
add_filter('the_content_more_link', 'stt_content_more');

// Widget area
function stt_widgets_init() {
	register_sidebar(array(
		'name'          => __('Footer Widget Area', 'stt'),
		'id'            => 'footer-widget-area',
		'description'   => __('footer widget area', 'stt'),
		'before_widget' => '<div class="col-md-3 col-sm-3 footer-col">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="footer-title">',
		'after_title'   => '</div>',
	));
}
add_action('widgets_init', 'stt_widgets_init');

// Image resize and crop
function wpmayor_filter_image_sizes($sizes) {
	unset($sizes['thumbnail']);
	unset($sizes['medium']);
	unset($sizes['large']);

	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'wpmayor_filter_image_sizes');

function wpmayor_custom_image_sizes($sizes) {
	$myimgsizes = array(
		"image-in-post" => __("Image in Post"),
		"full"          => __("Original size")
	);
	return $myimgsizes;
}
add_filter('image_size_names_choose', 'wpmayor_custom_image_sizes');

add_filter('the_content', 'stt_replace_content', 1);
add_filter('wp_trim_excerpt', 'stt_replace_excerpt', 1);
add_filter('the_excerpt', 'shortcode_unautop');
add_filter('the_excerpt', 'do_shortcode');

function enqueue_theme_css() {
	wp_enqueue_style('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/'. BOOTSTRAP_VERSION .'/css/bootstrap.min.css');
  wp_enqueue_style('default', get_template_directory_uri() . '/css/style.min.css');
	wp_enqueue_style('stt-styles', get_template_directory_uri() . '/css/stt-styles.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_theme_css');

function stt_stylesheet_uri($uri) {
	return $uri . '?' . filemtime(get_stylesheet_directory() . '/css');
}
add_filter('stylesheet_uri', 'stt_stylesheet_uri');

?>