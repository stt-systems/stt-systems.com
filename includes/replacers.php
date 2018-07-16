<?php
/*
 * Functions ending with _cb are callbacks, used in manual replacements
 * Functions ending with _shortcode are used by WP for replacing the associated shortcode
 * *_cb are kept for backward compatibility and because the migration to shortcodes hasn't been completed yet.
 */

function stt_trim_words($text, $num_words = 55, $more = null) {
	global $search_term_search;
	if (!isset($search_term_search)) return $text;
	
	$text = wp_strip_all_tags($text);
	$words_array = preg_split('/[\n\r\t ]+/', $text, -1, PREG_SPLIT_NO_EMPTY);
	$sep = ' ';
	if (count($words_array) > $num_words) { // more words than required
		$matches = preg_grep($search_term_search, $words_array);
		if (count($matches) > 0) {
			reset($matches);
			$offset = key($matches); // position of first occurrence
			if ($offset < $num_words) { // if it is within the original trimmed text, keep it.
				$offset = 0;
			} else {
				$offset -= 5; // do not show the term at the beginning
			}
			
			$words_array = array_slice($words_array, $offset, $num_words);
			$text = implode($sep, $words_array) . ' ' .$more;
			if ($offset > 0) {
				$text = "$more $text";
			}
		} else {
			$text = implode($sep, $words_array);
		}
	} else {
		$text = implode($sep, $words_array);
	}
	
	return $text;
}

function stt_replace_excerpt($text, $raw_excerpt = '') {
	if ($raw_excerpt != '') return stt_replace_content($raw_excerpt, true);

	$content = stt_replace_content(get_the_content(''), true);
	$excerpt_length = apply_filters('excerpt_length', 60);
	$excerpt_more = apply_filters('excerpt_more', '[&hellip;]');
	
	return stt_trim_words($content, $excerpt_length, $excerpt_more);
}

function stt_replace_content($content, $excerpt = false) {
	$text_format = '[\'\.\p{L} 0-9():,;-]+';
	
	$content = str_replace(']]>', ']]&gt;', $content);

	$content = preg_replace_callback("/\[include:([_a-zA-Z0-9-]+)( values:((\([a-zA-Z0-9_-]+:\"$text_format\"\))+))?\]/u", 'replace_include_cb', $content);

	$content = preg_replace_callback("/\[link:([_a-zA-Z0-9-]+)( title:($text_format))?\]/u", 'replace_link_cb', $content);
	$content = preg_replace_callback("/\[email:([_a-zA-Z0-9-]+)( title:($text_format))?\]/u", 'replace_email_cb', $content);
	
	$len = 0; $len2 = 1;
	if ($excerpt) { // excerpts don't have some elements
		$content = preg_replace("#\[image:([/_a-zA-Z0-9-]+\.[a-zA-Z0-9]+)( (caption):($text_format))?( no-shadow)?\]#u", "", $content);
		$content = preg_replace("/\[images-table:([_a-zA-Z0-9-]+) cols:([0-9]+)\]/", "", $content);
		$content = preg_replace("#\[gallery:([_a-zA-Z0-9/-]+)\]#", "", $content);

		// Columns
		$content = str_replace(array('[/row]', '[/column]'), '', $content);
		
		//$content = preg_replace('#<ul>[^.]*?</ul>#', '', $content);
	} else {
		$content = preg_replace_callback("#\[image:([/_a-zA-Z0-9-]+\.[a-zA-Z0-9]+)( (caption):($text_format))?( no-shadow)?\]#u", 'replace_image_cb', $content);
		$content = preg_replace_callback("/\[images-table:([_a-zA-Z0-9-]+) cols:([0-9]+)\]/", 'replace_images_table_cb', $content);
		$content = preg_replace_callback("#\[gallery:([_a-zA-Z0-9/-]+)\]#", 'replace_gallery_cb', $content);

		// Columns
		$len = strlen($content);
		$content = str_replace(array('[/row]', '[/column]'), '</div>', $content);
		$len2 = strlen($content);
		if ($len == $len2) {
			$content = "<div class=\"row\"><div class=\"col-md-12 col-sm-12\">$content";
		}
	}
	
	$content = apply_filters('the_content', $content); // filter at the end to avoid ghost <br>'s to be included
	
	if (!$excerpt) {
		// Move the fullscreen galleries div outside the blog to avoid footer and header overlap it
		// Additionally, each gallery div is associated to a set of images by the gallery's ID
		$len3 = strlen($content);
		$content = preg_replace_callback('#[\s]*\[gallery_snippet-([_a-zA-Z0-9-]+)\][\s]*#', 'replace_gallery_snippet_cb', $content);
		if ($len3 != strlen($content)) { ?>
			<script type="text/javascript">window.onload=function(){$('body').append($('.blueimp-gallery'));};</script><?php
		}
	}
	
	if ($len == $len2) {
		$content .= '</div></div>';
	}
	
	return $content;
}

// Callbacks for custom commands in post content
function replace_row_shortcode($atts) {
	extract(shortcode_atts(array(
	), $atts, 'include'));

	return "<div class=\"row\">";
}
function replace_column_shortcode($atts) {
	extract(shortcode_atts(array(
		'size' => '100',
    'align' => 'left',
    'style' => 'white',
    'image' => '',
    'height' => '',
	), $atts, 'include'));

  $class = "";
  $stylesheet = "";
  if ($size == "100") {
    $class = "col-md-12 col-sm-12";
  } else if ($size == "66") {
    $class = "col-md-8 col-sm-8";
    $stylesheet = "padding-left:15px;";
  } else if ($size == "50") {
    $class = "col-md-6 col-sm-6";
  } else if ($size == "33") {
    $class = "col-md-4 col-sm-4";
  } else if ($size == "25") {
    $class = "col-md-3 col-sm-3";
  }
  
  if ($align == "center") {
    $stylesheet .= "text-align:center;";
  } else if ($align == "right") {
    $stylesheet .= "text-align:right;";
  }
  
  $inner_html = "";
  
  if ($image != "") {  
    $image_url = my_get_image_url("$image");
    $height = $height . "px";
  
    $inner_html .= "<div class=\"extend-full\" style=\"background-image: url($image_url); height: $height;\"></div>";
    $stylesheet .= "padding-top:0;padding-bottom:0;";
  }
  
  return "<div class=\"$class col-extra style-$style\" style=\"$stylesheet\">$inner_html";
}

function replace_vspace_shortcode($atts) {
	extract(shortcode_atts(array(
		'size' => '10',
	), $atts, 'include'));

	return "<div class=\"space-sep$size\"></div>";
}

// Include: insert another page into this
function replace_include_cb($match) {
	$page = get_page_by_path('templates/' . $match[1]);
	$content = $page ? $page->post_content : '';
	
	$n = count($match);
	if ($n > 3) {
		$values_str = str_replace('(', '', $match[3]);
		$values = explode(')', $values_str);
		foreach ($values as $value) {
			$kv = explode(':', $value);
			$text = str_replace('"', '', $kv[1]);
			$content = str_replace("{{{$kv[0]}}}", $text, $content);
		}
	}
	
	return $content;
}
function replace_include_shortcode($atts) {
	extract(shortcode_atts(array(
		'page' => '',
		'params' => '',
	), $atts, 'include'));

	$the_page = get_page_by_path("templates/$page");
	$content = $the_page ? $the_page->post_content : '';
	
	$n = count($params);
	if ($n > 0) {
		$values_str = str_replace('(', '', $params);
		$values = explode(')', $values_str);
		foreach ($values as $value) {
			$kv = explode(':', $value);
			$text = count($kv) > 1 ? str_replace("'", '', $kv[1]) : '';
			$content = str_replace("{{{$kv[0]}}}", $text, $content);
		}
	}
	
	return do_shortcode($content);
}

// Links
function replace_link_cb($match) {
	return get_page_url($match[1], count($match) > 3 ? $match[3] : '');
}
function replace_link_shortcode($atts) {
	extract(shortcode_atts(array(
		'page' => '',
		'url' => '',
		'title' => '',
	), $atts, 'link'));
	
	if ($page != '') return get_page_url($page, $title);
	if ($url != '') return "<a href=\"$url\" class=\"external\" target=\"_blank\">$title</a>";
	return $title;
}

// E-mail
function replace_email_cb($match) {
	return '<a href="mailto:' . $match[1] . '@stt-systems.com">' . (count($match) > 3 ? $match[3] : $match[1] . '@stt-systems.com') . '</a>';
}
function replace_email_shortcode($atts) {
	extract(shortcode_atts(array(
		'to' => '',
		'title' => '',
	), $atts, 'email'));
	
	if ($title == '') {
		$title = "$to@stt-systems.com";
	}
		
	return "<a href=\"mailto:$to@stt-systems.com\">$title</a>";
}

function replace_image_cb($match) {
	$caption_pre = '';
	$caption_post = '';
	if (count($match) > 4 and $match[3] == 'caption') { // use caption
		$caption_pre = '[caption width="5000" align="aligncenter"]';
		$caption_post = $match[4] . '[/caption]';
	}
	$class = ' class="boxshadow"';
	if (count($match) > 3 and end($match) == ' no-shadow') {
		$class = '';
	}

	return $caption_pre . '<img src="' . my_get_image_url('single/' . $match[1]) . '"' . $class .' alt="' . $match[1] . '" />' . $caption_post;
}
function replace_image_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
		'caption' => '',
		'shadow' => 'true',
		'alt' => '',
		'lazy' => 'false',
		'page' => '',
		'url' => ''
	), $atts, 'image'));
		
	$caption_pre = '';
	$caption_post = '';
	if ($caption != '') { // use caption
		$caption_pre = '[caption width="5000" align="aligncenter"]';
		$caption_post = $caption . '[/caption]';
	}
	$class = '';
	if (strcasecmp($shadow, 'true') == 0) {
		$class = ' class="boxshadow"';
	}
	if (empty($alt)) {
		if (!empty($caption)) {
			$alt = $caption;
		} else {
			$alt = $name;			
		}
	}
	
	$img = '';
	$image_url = my_get_image_url("$name");
	if ($lazy == 'true') {
		$loading_img = get_template_directory_uri() . "/images/loading.gif";
		$img = do_shortcode("$caption_pre<img src=\"$loading_img\" data-src=\"$image_url\" $class alt=\"$alt\" />$caption_post");
	} else {
		$img = do_shortcode("$caption_pre<img src=\"$image_url\" $class alt=\"$alt\" />$caption_post");
	}
	
	if (!empty($page)) return get_page_url($page, $img);
	if (!empty($url)) return "<a href=\"$url\" class=\"external\" target=\"_blank\">$img</a>";
	
	return $img;
}

function replace_gallery_snippet_cb($match) {
	return '<div id="blueimp-gallery-' . $match[1] . '" class="blueimp-gallery blueimp-gallery-controls"><div class="slides"></div><a class="prev">&lsaquo;</a><a class="next">&rsaquo;</a><a class="close">&times;</a><ol class="indicator"></ol></div>';
}

function walk_gallery_cb(&$value, $key, $data) {
	$path = my_get_image_url($data['base'] . $value);
	$thumb = my_get_image_url($data['base'] . "thumb-$value");
	$value = '<a href="' . $path . '" data-gallery="#blueimp-gallery-' . $data['gallery'] . '" class="thumb64" style="background-image:url(\'' . $thumb . '\');" data-thumbnail="' . $thumb . '"></a>';
}
function replace_gallery_cb($match) {
	$gallery = $match[1];
	$clean_name = str_replace('/', '-', $gallery);
	$config_file = "galleries/$gallery/gallery.txt";
	$title = '';
	$walk_data = array('base' => "galleries/$gallery/", 'subtitles' => array(), 'gallery' => $clean_name);
	$path = ABSPATH . "/images/$config_file";
	if (file_exists($path)) {
		$fh = fopen($path, 'r');
		$config = json_decode(fread($fh, filesize($path)), true);
		fclose($fh);
		$title = '<p class="gallery-caption">' . $config['title'] . '</p>';
		if (array_key_exists('images', $config)) {
			$walk_data['subtitles'] = $config['images'];
		}
	}
	$images = get_images('galleries/' . $gallery, 'thumb-');
	array_walk($images, 'walk_gallery_cb', $walk_data);
	$gal_images = '<div id="links-' . $clean_name . '" style="text-align:center;" class="gallery">' . implode($images) . '</div>' . $title;

	return $gal_images . '[gallery_snippet-' . $clean_name . ']';
}

function walk_images_table_cb(&$value, $key, $base) {
	$path = my_get_image_url($base . $value);
	$thumb = my_get_image_url($base . 'thumb-' . $value);
	$value = "<td><img src=\"$path\" style=\"max-height: 100px;\"></img></td>";
}

function replace_images_table_cb($match) {
	$gallery = $match[1];
	$images = get_images("galleries/$gallery");
	if (!count($images)) return '';
	
	if (count($match) < 3 || $match[2] <= 0) {
		echo 'Error: wrong number of columns for image-table\n';
		return '';
	}
	$cols = $match[2];
	array_walk($images, 'walk_images_table_cb', "galleries/$gallery/");

	// Create table
	$table = '';
	$i = 0;
	foreach ($images as $image) {
		if ($i % $cols == 0) {
			$table .= '<tr>';
		}
		$table .= $image;
		if ($i % $cols == $cols - 1) {
			$table .= '</tr>';
		}
		++$i;
	}

	if ($table == '') return '';
	return "<table class=\"clean\">$table</table>";
}

// Videos
function replace_youtube_cb($match) {
	$caption = '';
	if (count($match) > 3) { // use caption
		$caption = '<p>' . $match[3] . '</p>';
	}

	return '<div class="youtube"><iframe width="560" height="315" src="https://www.youtube.com/embed/' . $match[1]. '?rel=0;3&amp;autohide=1&amp;showinfo=0&amp;wmode=transparent&amp;player=html5" frameborder=0 allowfullscreen></iframe>' . $caption . '</div>';
}
function replace_facebook_cb($match) {
	$caption = '';
	if (count($match) > 3) { // use caption
		$caption = '<p>' . $match[3] . '</p>';
	}
	
	$url = $match[1];
	$url = str_replace('/', '%2F', $url);
	$url = str_replace(':', '%3A', $url);

	return '<div class="youtube" style="text-align: center"><iframe width="560" height="315" style="margin-top: 5px" src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F' . $url . '&amp;show_text=0&amp" frameborder=0 allowfullscreen></iframe>' . $caption . '</div>';
}
function replace_video_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
		'caption' => '',
		'type' => 'youtube',
		'time' => ''
	), $atts, 'video'));
	
	if ($caption != '') {
		$caption = "<p>$caption</p>";
	}
	
	if ($type == 'youtube') {
		if ($time != '') {
			$time = "&start=$time";
		}
		return "<div class=\"youtube\"><iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/$name?rel=0;3&amp;autohide=1&amp;showinfo=0&amp;wmode=transparent&amp;player=html5$time\" frameborder=0 allowfullscreen></iframe>$caption</div>";
	}
	if ($type == 'facebook') {
		$from = array('/'  , ':'  );
		$to   = array('%2F', '%3A');
		$url = str_replace($from, $to, $url);
		return "<div class=\"youtube\" style=\"text-align: center\"><iframe width=\"560\" height=\"315\" style=\"margin-top: 5px\" src=\"https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2F$name&amp;show_text=0&amp\" frameborder=0 allowfullscreen></iframe>$caption</div>";
	}
	return '';
}

function replace_quote_cb($match) {
	$author = '';
	if (count($match) > 3) { // has author
		$author = ' <span>' . $match[3] . '</span>';
	}

	return '<blockquote>"' . $match[1] . '"' . $author . '</blockquote>';
}
function replace_quote_shortcode($atts) {
	extract(shortcode_atts(array(
		'text' => '',
		'title' => '',
		'author' => '',
		'style' => '',
	), $atts, 'quote'));
	
	if (!empty($author)) { // has author
		$author = " <span>$author</span>";
	}
	
	if (empty($style)) {
		$style = 'quote';
	}
	
	if ($style == 'quote') {
		$text = "\"$text\"";
	}
	if (!empty($title)) {
		$title = "<span><h4>$title</h4></span>";
	}

	return "<blockquote>$title$text$author</blockquote>";
}

// Downloads
function replace_download_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
		'title' => 'Download'
	), $atts, 'downloads'));
	
	$download = my_get_download_url($name);
	if ($download == '') return '';
	// NOFOLLOW: do not pass link juice for PDFs on sidebars
	return "<a href=\"$download\" rel=\"nofollow\">$title</a>";
}
function replace_downloads_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
	), $atts, 'downloads'));
	
	if ($name == '') {
		global $post;
		$name = $post->post_name;
	}

	$downloads = get_downloads($name);
	if (!count($downloads['files'])) return '';
	
	$list = array();
	foreach ($downloads['files'] as $file) {
		// NOFOLLOW: do not pass link juice for PDFs on sidebars
		array_push($list, '<a href="' . $file['file'] . '" rel="nofollow">' . $file['title'] . '</a>');
	}

	return '<h4>Downloads</h4><p>' . implode($list, '<br>') . '</p>';
}
function replace_all_downloads_shortcode() {
	$downloads = get_downloads_area_list();
	$table = '';
	foreach ($downloads as $dir) {
		$table .= "<tr><th colspan=\"3\">{$dir['name']}</th></tr>";
		foreach ($dir['files'] as $file) { // here tell crawler to DOFOLLOW, since it comes from the downloads main page, not sidebar
			$path = $file['path'];
			$fdate = date('M j, Y', filemtime($path));
			$fsize = get_filesize_str($path);
			$table .= "<tr><td><a href=\"{$file['file']}\">{$file['title']}</a></td><td>$fdate</td><td align=\"right\">$fsize</td></tr>";
		}
	}

	if ($table == '') return '';
	return '<table>' . $table . '</table>';
}

function search_cmp($a, $b) {
	$field = 'id';
	if ($a[$field] == $b[$field]) return 0;
	return ($a[$field] < $b[$field]) ? -1 : 1;
}

function display_search_results($results, $title) {
	if (count($results) == 0) return;
	?>
	
	<div class="alternating-bg"><div class="container">
	<h3 style="text-align: center;"><?php echo $title; ?></h3><?php
		uasort($results, search_cmp);
		foreach ($results as $res) { ?>
			<div class="row" style="padding-bottom: 35px"><div class="col-md-12 col-sm-12">
				<h4 style="margin-bottom: 0px"><a href="<?php echo get_permalink($res['id']); ?>"><?php
					echo $res['title']; ?>
				</a></h4><?php
				if ($res['date']) {
					$date = new DateTime($res['date']);
					echo '<div style="padding-left: 20px; color: #848484;">' . $date->format('Y-M-d') . '</div>';
				}
				echo '<div style="padding-left: 20px">' . $res['excerpt'] . '</div>';
				?>
			</div></div>
			<?php
		} ?>
	</div></div><?php
}

function add_share_buttons() {
	$url = urlencode(get_permalink());
	$title = htmlentities(urlencode(get_the_title())); ?>
	<ul class="share-buttons">
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" title="Share on Facebook"><img src="<?php echo WL_TEMPLATE_DIR_URI . '/images/flat_web_icon_set/color/Facebook.png'; ?>" alt="Facebook" /></a></li>
		<li><a href="https://twitter.com/intent/tweet?source=https%3A%2F%2Fwww.stt-systems.com&amp;text=<?php echo $title; ?>%20-%20<?php echo $url; ?>&amp;via=STTSystems" target="_blank" title="Tweet"><img src="<?php echo WL_TEMPLATE_DIR_URI . '/images/flat_web_icon_set/color/Twitter.png'; ?>" alt="Twitter" /></a></li>
		<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" title="Share on LinkedIn"><img src="<?php echo WL_TEMPLATE_DIR_URI . '/images/flat_web_icon_set/color/LinkedIn.png'; ?>" alt="LinkedIn" /></a></li>
		<li><a href="mailto:?subject=<?php echo $title; ?>&amp;body=Read this: <?php echo $url; ?>" target="_blank" title="Email"><img src="<?php echo WL_TEMPLATE_DIR_URI . '/images/flat_web_icon_set/color/Email.png'; ?>" alt="Email" /></a></li>
	</ul><?php
}

function add_stt_shortcodes() {
	add_shortcode('v-space',       'replace_vspace_shortcode');
	add_shortcode('include',       'replace_include_shortcode');
	add_shortcode('link',          'replace_link_shortcode');
	add_shortcode('email',         'replace_email_shortcode');
	add_shortcode('image',         'replace_image_shortcode');
	add_shortcode('video',         'replace_video_shortcode');
	add_shortcode('quote',         'replace_quote_shortcode');
	add_shortcode('download',      'replace_download_shortcode');
	add_shortcode('downloads',     'replace_downloads_shortcode');
	add_shortcode('all-downloads', 'replace_all_downloads_shortcode');
  add_shortcode('row',           'replace_row_shortcode');
  add_shortcode('column',        'replace_column_shortcode');
}

add_action('wp_loaded', 'add_stt_shortcodes', 99999);
?>