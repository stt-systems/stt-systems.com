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

	if (!empty($_GET) && array_key_exists('menu', $_GET)) return $_GET['menu'];

	if (is_page_valid() === false) return '';

	$url_base = site_url();
	$url_base = substr($url_base, strpos($url_base, '://') + 3);

	$url = get_current_url();
	$url = substr($url, strpos($url, '://') + 3);

	if (strpos($url, $url_base) != 0) return '';

	$path = substr($url, strlen($url_base) + 1);
	
	return substr($path, 0, strpos($path, '/'));
}

function str2bool($str) {
	return strcasecmp($str, 'yes') == 0 || strcasecmp($str, 'true') == 0;
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

// Prints the banner of the page (or the title, if no banner)
function print_page_title($slug = '', $title = '') {
	global $post;
  
  if (is_page()) return;
  
	if ($slug == '') {
		if (is_category()) {
			$category = get_queried_object();
			$slug = $category->slug;
		} else if ($post) {
			$slug = $post->post_name;
		}
	}
	if ($title == '' && $post) {
		$title = $post->post_title;
	} ?>

	<div class="top-title-wrapper">
		<div class="container"><div class="row col-xs-12">
		<h1 class="page-title"><?php echo wptexturize($title); ?></h1>
		</div></div>
	</div><?php
}

// Helper functions to deal with uploads (images and downloadable material)
function my_get_url_for_path($path, $add_timestamp = true) {
	if (!file_exists(ABSPATH . $path)) return '';
	return site_url($path);
}

function get_upload_url($name) {
	$upload_dir = wp_upload_dir();
	$url = $upload_dir['baseurl'] . "/$name";

	if (is_ssl()) {
		$url = str_replace('http://', 'https://', $url);
	}

	return $url;
}

function get_post_thumbnail() {
	$thumbnail = '<div class="col-md-4 col-sm-4 center">';
	
	$fields = get_post_custom(get_the_ID());
	if (array_key_exists('youtube', $fields)) {
		$thumbnail .= get_youtube_video($fields['youtube'][0]);
	} else if (has_post_thumbnail()) {
		$post_thumbnail_id = get_post_thumbnail_id();
		$post_thumbnail_url = wp_get_attachment_url($post_thumbnail_id);
		$thumbnail .= '<img src="' . $post_thumbnail_url . '" class="rounded blog-thumbnail boxshadow"/>';
	}
	$thumbnail .= '</div>';
	
	return $thumbnail;
}

function get_youtube_video($name, $caption = '', $time = '', $size = '') {
	if ($caption != '') {
		$caption = "<p>$caption</p>";
	}

	if ($time != '') {
		$time = "&start=$time";
	}
	
	$max_width = '560px';
	if ($size != '') {
		$max_width = $size;
	}

	return "<div class=\"video youtube\" style=\"width:100%;max-width:$max_width\"><div><div><iframe src=\"\" width=\"560\" height=\"315\" data-src=\"https://www.youtube-nocookie.com/embed/$name?rel=0;3&amp;autohide=1&amp;showinfo=0&amp;wmode=transparent&amp;player=html5$time\" allowfullscreen></iframe></div></div>$caption</div>";
}

function get_facebook_video($name, $caption = '', $size = '') {
	if ($caption != '') {
		$caption = "<p>$caption</p>";
	}

	$from = array('/'  , ':'  );
	$to   = array('%2F', '%3A');
	$name = str_replace($from, $to, $name);

	if ($size != '') {
		$size = " $size";
	}

	return "<div class=\"video facebook$size\" style=\"width:100%\"><iframe src=\"\" data-src=\"https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F$name&amp;show_text=0&amp\" allowfullscreen></iframe>$caption</div>";
}

function css_darken_image($name, $alpha=0.55, $color='0, 0, 0') {
	$url = get_upload_url($name);
	$code = "url($url)";

	if ($alpha > 0) {
		$rgba = "rgba($color, $alpha)";
		$code = "linear-gradient($rgba, $rgba), $code";
	}
  
  return $code;
}

function get_files_in_dir($path, $exclude_preffix = '', $exclude_exts = array()) {
	$upload_dir = wp_upload_dir();
	$dir = $upload_dir['path'] . "/$path";
	if (!is_dir($dir)) return array();

	$extensions = count($exclude_exts) ? '|(.+\.' . join(')|(.+\.', $exclude_exts) . ')' : '';
	$files = preg_grep('/^(' . ($exclude_preffix != '' ? "{$exclude_preffix}[.]*|" : '') . "[\w0-9-_]+@2x\.[a-zA-Z0-9]+|\.|\.\.$extensions)/", scandir($dir), PREG_GREP_INVERT);

	return array_values($files);
}

function my_get_download_url($path) {
	return my_get_url_for_path("downloads/$path");
}

function walk_downloads_cb(&$value, $key, $base) {
	$download_file = "downloads/$base{$value['file']}";
	$value['path'] = ABSPATH . $download_file;
	$value['filename'] = $value['file'];
	if (!array_key_exists('url', $value) || empty($value['url'])) {
		$value['url'] = my_get_url_for_path($download_file);
	}

	$info = pathinfo($download_file);
	$ext = $value['ext'] = strtolower($info['extension']);

	$basename = "{$info['dirname']}/{$info['filename']}";
	if (file_exists(ABSPATH . "$basename-thumb.png")) {
		$value['thumbnail'] = my_get_url_for_path("$basename-thumb.png");
	} else if (file_exists(ABSPATH . "$basename-thumb.jpg")) {
		$value['thumbnail'] = my_get_url_for_path("$basename-thumb.jpg");
	} else if (file_exists(ABSPATH . "$basename-thumb.jpeg")) {
		$value['thumbnail'] = my_get_url_for_path("$basename-thumb.jpeg");
	} else if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
		$value['thumbnail'] = my_get_url_for_path("$basename.$ext");
	} else {
		$value['thumbnail'] = '';
	}
}

function get_downloads($dir, $index_name) {
	$path = ABSPATH . "downloads/$dir/$index_name";
	if (!file_exists($path)) return array('files' => array());

	$fh = fopen($path, 'r');
	$list_str = fread($fh, filesize($path));
	fclose($fh);
	$list = json_decode($list_str, true);
	$list['base_dir'] = ABSPATH . "/downloads/$dir";
	array_walk($list['files'], 'walk_downloads_cb', "$dir/");

	if (array_key_exists('zip', $list)) {
		$list['zip'] = my_get_download_url($dir . '/' . $list['zip']);
	}

	return $list;
}

function get_downloads_area_list() {
	$dirs = preg_grep('/^(\.|\.\.)/', scandir('./downloads/'), PREG_GREP_INVERT);

	$all = array();
	foreach ($dirs as $dir) {
		if ($dir == 'external') continue;

		$downloads = get_downloads($dir, 'index.json');
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

function get_page_url($slug, $type = 'page', $title = '') {
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

	$url = get_permalink($page->ID);

	return array(
		'url' => $url,
		'title' => $title,
	);
}

// Return a link to a page from its slug
function get_page_full_link($slug, $title = '', $type = 'page', $rel = '', bool $decorated = false) {
	$slug = explode('#', $slug);
	$page_url = get_page_url($slug[0], $type, $title);
	if ($page_url == '') return '';

	$url = $page_url['url'];
	if (count($slug) == 2) {
		$url .= "#{$slug[1]}";
	}
	$title = $page_url['title'];

	if ($rel != '') {
		$rel = " rel=\"$rel\"";
	}

	$class = '';
	if ($decorated) {
		$class = ' class="decorated"';
	}

	return "<a$class href=\"$url\"$rel>$title</a>";
}

function get_url_link($url, $title = '', $blank = true, $nofollow = false, bool $decorated = false) {
	$target = '';
	if ($blank) {
		$target = ' target="_blank"';
	}

	$rel = '';
	if ($nofollow) {
		$rel = ' rel="nofollow"';
	}

	if (empty($title)) {
		$title = $url;
	}

	$class = '';
	if ($decorated) {
		$class = ' class="decorated"';
	}
	return "<a$class href=\"$url\"$target$rel>$title</a>";
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

function get_product_icon_link(string $icon, string $shape = 'round', string $size = '', bool $link = true, bool $name = true) {
	$page_url = get_page_url($icon);
	if ($page_url == '') return '';

	$url = $page_url['url'];
	$title = '';
	if ($name) {
		$title = $page_url['title'];
	}

	if ($size != '') {
		$size = "-$size";
	}

	$span = "<span class=\"product $shape $icon$size\">$title</span>";
	if (!$link) {
		$url = '#';
	}
	
	return "<a href=\"$url\">$span</a>";
}

function get_products() {
	return array(
		'sports-3dma' => array(
			'family' => '3dma',
		),
		'cycling-3dma' => array(
			'family' => '3dma',
		),
		'golf-3dma' => array(
			'family' => '3dma',
		),
		'clinical-3dma' => array(
			'family' => '3dma',
		),
		'running-3dma' => array(
			'family' => '3dma',
		),
		'human-3dma' => array(
			'family' => '3dma',
		),
		'eddo' => array(
			'family' => '3dma',
		),
		'cycling-2dma' => array(
			'family' => '2dma',
		),
		'isen' => array(
			'family' => 'inertial',
		),
	);
}

function get_page_top_spacer($tight = false) {
	$size = $tight ? "-tight" : "";
	return "<div class=\"space-sep-top$size\"></div>";
}

function get_clients_carousel($name, $cols) {
	$clients = get_files_in_dir("clients/$name");

	$n = count($clients);
	if ($n == 0) return '';

	$html = '<div class="container-fluid">';
	$html .= '<div id="clients-carousel" class="carousel slide carousel-fade" data-ride="carousel" style="margin-bottom:0">';
	$html .= '<div class="carousel-inner" style="background:#fff">';
	$i = 0;
	foreach ($clients as $client) {
		if ($i % $cols == 0) {
			$active = $i == 0 ? ' active' : '';
			$html .= '<div class="item' . $active . '">';
			$html .= '<div class="row">';
		}
		$html .= '<img src="' . get_upload_url("clients/$name/$client") . '" alt="' . "Client $client" . '"/>';
		if (($i + 1) % $cols == 0 || $i == $n - 1) {
			$html .= '</div></div>';
		}
		++$i;
	}
	$html .= '</div></div></div>';

	return $html;
}

function split_csv(string $str) {
	if ($str == '') return array();
	return preg_split('/[,;: ]+/', $str);
}

if (!function_exists('post_is_in_descendant_category')) {
	function post_is_in_descendant_category($cats, $_post = null) {
		foreach ((array)$cats as $cat) {
			$descendants = get_term_children((int) $cat, 'category');
			if ($descendants && in_category($descendants, $_post)) return true;
		}
		return false;
	}
}

function get_file_icon_url($ext) {
	// Extension normalization
	if ($ext == 'docx') $ext = 'doc';
	if ($ext == 'xlsx') $ext = 'xls';
	if ($ext == 'pptx') $ext = 'ppt';

	$icon_file = WL_TEMPLATE_LOCAL_DIR . "/images/file-types/$ext.png";
	if (!file_exists(ABSPATH . $icon_file)) { // use a generic icon if no extension-specific exists
		$icon_file = WL_TEMPLATE_LOCAL_DIR . "/images/file-types/file.png";
	}
	
	return my_get_url_for_path($icon_file);
}
?>