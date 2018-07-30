<?php
function is_page_valid() {
  if (is_404() or strpos(get_page_template(), 'page-empty.php') !== false) return false;
  return true;
}

function get_current_url() {
	return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

function get_top_level_slug() {
	if (is_front_page()) return '';

	if (is_page_valid() === false) return 'capture';

	$ancestors = get_post_ancestors(get_post()->ID);
  if (count($ancestors) == 0) {
    $ancestors = array(get_post()->ID);
  }
	
  $top_level = get_post(end($ancestors));

  return $top_level->post_name;  
}

function my_file_get_contents($url) {	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$contents = curl_exec($ch);
	if (curl_errno($ch)) {
		echo curl_error($ch);
		echo "\n<br />";
		$contents = '';
	} else {
		curl_close($ch);
	}

	if (!is_string($contents) || $contents == '') {
		echo "Failed to get content.";
		$contents = '';
	}
	
	return $contents;
}

// Helper function to get current page path
function add_page_path() {
	$path = get_ancestors(get_the_ID(), 'page');
	if (count($path) > 0) { ?>
		<div class="blog-post-details page-path"><?php
		for ($i = count($path) - 1; $i >= 0; --$i) {
			$item = get_post($path[$i]);
			if ($item->post_password != '' || get_page_template_slug($item->ID) == 'template-empty.php') { // suggestion: use password 'hide' and page template 'redirect'
				echo $item->post_title . ' &raquo; ';
			} else {
				echo '<a href="' . get_permalink($path[$i]) . '">' . $item->post_title . '</a> &raquo; ';
			}
		}
		the_title(); ?>
		</div><?php
	}
}

function get_banner_code($slug) {
	global $post;
	$path = "/images/banners/$slug.jpg";
	if (!file_exists(ABSPATH . $path)) return ''; // no banner for the page
	return '<img class="banner" src="' . get_site_url() . $path . '" alt="' . $post->post_title . '" />';
}

// Prints the banner of the page (or the title, if no banner)
function print_page_title($slug = '', $title = '') {
	global $post;
  
  if (is_page()) return;
  
	if ($slug == '') {
		if (is_category()) {
			$category = get_queried_object();
			$slug = $category->slug;
		} else {
			$slug = $post->post_name;
		}
	}
	if ($title == '') {
		$title = $post->post_title;
	}
	
	$banner_code = get_banner_code($slug);
	$h1_hidden = '';
	if ($banner_code != '') {
		$h1_hidden = 'hidden';
	} ?>

	<div class="top-title-wrapper">
		<?php echo $banner_code; ?>
		<?php if ($banner_code == '') { ?><div class="container"><div class="row col-md-12 col-sm-12"><?php } ?>
		<h1 class="page-title" <?php echo $h1_hidden; ?>><?php echo wptexturize($title); ?></h1>
		<?php if ($banner_code == '') { ?></div></div><?php } ?>
	</div><?php
}

// Helper functions to deal with uploads (images and downloadable material)
function my_get_url_for_path($path, $add_timestamp = true) {
	if (!file_exists(ABSPATH . $path)) return '';
	return get_site_url() . $path;
}

function my_get_image_url($name) { // there is a WP method called get_image_url
	return my_get_url_for_path("/images/$name");
}

function print_thumbnail($style='') { ?>
  <div class="col-md-4 col-sm-4 col-extra <?php echo $style; ?>"><?php
    if (has_post_thumbnail()) {
      $post_thumbnail_id = get_post_thumbnail_id();
      $post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id); ?>
      <img src="<?php echo $post_thumbnail_url; ?>" class="rounded blog-thumbnail boxshadow" /><?php
    } ?>
  </div><?php
}

function css_darken_image($name, $alpha=0.55, $color='0, 0, 0') {
	$url = my_get_image_url($name);
  $rgba = "rgba($color, $alpha)";
  
  return "linear-gradient($rgba, $rgba), url($url)";
}

function get_images($path, $not_pre = '') {
	$dir = "./images/$path";
	if (!is_dir(ABSPATH . $dir)) return array();

	$files = preg_grep('/^(' . ($not_pre != '' ? "{$not_pre}[.]*|" : '') . '[\w0-9-_]+@2x\.[a-zA-Z0-9]+|\.|\.\.|(.+\.txt))/', scandir($dir), PREG_GREP_INVERT);

	return array_values($files);
}

function my_get_download_url($path) {
	return my_get_url_for_path("/downloads/$path");
}

function walk_downloads_cb(&$value, $key, $base) {
	$value['path'] = ABSPATH . "/downloads/$base" . $value['file'];
	$value['filename'] = $value['file'];
	$value['file'] = my_get_download_url($base . $value['file']);
}

function get_downloads($dir) {
	$path = ABSPATH . "/downloads/$dir/files.txt";
	if (!file_exists($path)) return array('files' => array());

	$fh = fopen($path, 'r');
	$list_str = fread($fh, filesize($path));
	fclose($fh);
	$list = json_decode($list_str, true);
	$list['base_dir'] = ABSPATH . "/downloads/$dir";
	array_walk($list['files'], 'walk_downloads_cb', "$dir/");

	return $list;
}

function get_downloads_area_list() {
	$dirs = preg_grep('/^(\.|\.\.)/', scandir('./downloads/'), PREG_GREP_INVERT);

	$all = array();
	foreach ($dirs as $dir) {
		if ($dir == 'external') continue;

		$downloads = get_downloads($dir);
		if ($downloads != null and count($downloads['files']) > 0) {
			array_push($all, $downloads);
		}
	}

	return $all;
}

function get_filesize_str($file) {
	if (!file_exists($file)) return 0;
	$size = filesize($file);

	$units = array('B', 'KB', 'MB', 'GB');
	foreach ($units as $unit) { // find nearest unit
		if ($size < 1000) {
			if ($unit == 'B' || $unit == 'KB') {
				$size = (int)$size;
			} else {
				$size = ((int)($size * 100)) / 100; // round up two decimals
			}
			return "$size $unit";
		}
		$size /= 1000;
	}

	return ((int)($size * 100)) / 100 . $units[$i];
}

function get_page_permalink($slug, $type = 'page') {
	$args = array(
		'name' => $slug,
		'post_type' => $type,
		'post_status' => 'publish',
		'showposts' => 1,
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 1
	);
	$pages = get_posts($args);

	if (!$pages) return '';
	$page = array_pop($pages);

  return get_permalink($page->ID);
}

// Return a link to a page from its slug
function get_page_full_link($slug, $title = '', $type = 'page', $rel = '') {
	$args = array(
		'name' => $slug,
		'post_type' => $type,
		'post_status' => 'publish',
		'showposts' => 1,
		'ignore_sticky_posts' => 1,
		'posts_per_page' => 1
	);
	$pages = get_posts($args);

	if (!$pages) return '';
	$page = array_pop($pages);

	if ($title == '') { // custom title
		$title = $page->post_title;
	}
	
	if ($rel != '') {
		$rel = " rel=\"$rel\"";
	}

	return '<a href="' . get_permalink($page->ID) . '"' . $rel . ">$title</a>";
}

function get_widget_recent_posts($cat) {
	$query = new WP_Query(array('category_name' => $cat, 'posts_per_page' => 5));
	if ($query->have_posts()) {
		echo '<div class="recent-posts">';
		while ($query->have_posts()) {
			$query->the_post();
			echo '<div class="recent-post"><a href="' . get_permalink() . '">' . get_the_title() . '</a></div>';
		}
		echo '</div>';
	}
	unset($query);
}

function get_posts_for_category($cat_id, $number_of_posts) {
	global $post;
	query_posts(array(
		'cat' => $cat_id,
		'posts_per_page' => $number_of_posts
	));

	$cases = array();
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			array_push($cases, array(
				'slug' => $post->post_name,
				'title' => $post->post_title,
				'date' => $post->post_date
			));
		}
	}
	
	return $cases;
}

if (!function_exists('post_is_in_descendant_category')) {
	function post_is_in_descendant_category($cats, $_post=null) {
		foreach ((array)$cats as $cat) {
			$descendants = get_term_children((int) $cat, 'category');
			if ($descendants && in_category($descendants, $_post)) return true;
		}
		return false;
	}
}
?>