<?php
/*
 * Functions ending with _cb are callbacks, used in manual replacements
 * Functions ending with _shortcode are used by WP for replacing the associated shortcode
 * *_cb are kept for backward compatibility and because the migration to shortcodes hasn't been completed yet.
 */

function stt_replace_excerpt($text, $raw_excerpt = '') {
	if ($raw_excerpt != '') return stt_replace_content($raw_excerpt, true);

	$content = stt_replace_content(get_the_content());
	$content = apply_filters('the_content', $content);

	return wp_trim_words($content);
}

function stt_replace_content($content) {
	$content = str_replace(']]>', ']]&gt;', $content);

	$len = 0; $len2 = 1;
	$content = preg_replace_callback("/\[images-table:([_a-zA-Z0-9-]+) cols:([0-9]+)\]/", 'replace_images_table_cb', $content);
	$content = preg_replace_callback("#\[gallery:([_a-zA-Z0-9/-]+)\]#", 'replace_gallery_cb', $content);

	$len = strlen($content);
	$content = str_replace(array('[/row]', '[/column]'), '</div>', $content);
	$len2 = strlen($content);
	if ($len == $len2) {
		$content = "<div class=\"row\"><div class=\"col-md-12 col-sm-12\">$content";
	}
	
	// Move the fullscreen galleries div outside the blog to avoid footer and header overlap it
	// Additionally, each gallery div is associated to a set of images by the gallery's ID
	$len3 = strlen($content);
	$content = preg_replace_callback('#[\s]*\[gallery_snippet-([_a-zA-Z0-9-]+)\][\s]*#', 'replace_gallery_snippet_cb', $content);
	if ($len3 != strlen($content)) { ?>
		<script type="text/javascript">window.onload=function(){$('body').append($('.blueimp-gallery'));};</script><?php
	}
	
	if ($len == $len2) {
		$content .= '</div></div>';
	}
	
	return $content;
}

// Callbacks for custom commands in post content
function replace_row_shortcode($atts) {
	extract(shortcode_atts(array(
    'id' => '',
	), $atts, 'row'));

  if ($id != "") {
    $id = "id=$id";
  }
  
	return "<div $id class=\"row\">";
}
function replace_column_shortcode($atts) {
	extract(shortcode_atts(array(
		'size' => '100',
    'align' => 'left',
    'style' => 'white',
    'image' => '',
    'height' => '',
	), $atts, 'column'));

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
    $class .= " center";
  } else if ($align == "right") {
    $class .= " right";
  } else if ($align == "left") {
    $class .= " left";
  }
  
  $inner_html = "";
  
  if ($image != "") {  
    $image_url = my_get_image_url("$image");
    $height = $height . "px";
  
    $inner_html .= "<div class=\"extend-full\" style=\"background-image: url($image_url); height: $height;\"></div>";
    $stylesheet .= "padding-top:0;padding-bottom:0;";
  }
  
  if ($stylesheet != '') {
    $stylesheet = "style=\"$stylesheet\"";
  }
  
  return "<div class=\"$class col-extra style-$style\" $stylesheet>$inner_html";
}

function replace_vspace_shortcode($atts) {
	extract(shortcode_atts(array(
		'size' => '10',
	), $atts, 'vspace'));

	return "<div class=\"space-sep$size\"></div>";
}

// Include: insert another page into this
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
function replace_link_shortcode($atts) {
	extract(shortcode_atts(array(
		'page' => '',
		'url' => '',
		'title' => '',
	), $atts, 'link'));
	
	if ($page != '') return get_page_full_link($page, $title);
	if ($url != '') return "<a href=\"$url\" target=\"_blank\">$title</a>";
	return $title;
}

// E-mail
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

function replace_image_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
		'caption' => '',
		'shadow' => 'true',
    'icon' => 'false',
		'alt' => '',
		'lazy' => 'false',
		'page' => '',
		'url' => '',
	), $atts, 'image'));

	$class = 'rounded ';
  
	$caption_pre = '';
	$caption_post = '';
	if ($caption != '') { // use caption
		$caption_pre = '[caption width="5000" align="aligncenter"]';
		$caption_post = $caption . '[/caption]';
	}

	if (empty($alt)) {
		if (!empty($caption)) {
			$alt = $caption;
		} else {
			$alt = $name;			
		}
	}
  
  $size = '';
  if (strcasecmp($icon, 'true') == 0) {
    $size = 'width="80" height="80"';
    $class .= 'icon';
    $shadow = 'false';
  }
	
	if (strcasecmp($shadow, 'true') == 0) {
		$class .= 'boxshadow';
	}
  
  if ($class != '') {
		$class = " class=\"$class\"";
  }

	$img = '';
	$image_url = my_get_image_url("$name");
	if ($lazy == 'true') {
		$loading_img = get_template_directory_uri() . "/images/loading.gif";
		$img = do_shortcode("$caption_pre<img src=\"$loading_img\" data-src=\"$image_url\" $class alt=\"$alt\" $size/>$caption_post");
	} else {
		$img = do_shortcode("$caption_pre<img src=\"$image_url\" $class alt=\"$alt\" $size/>$caption_post");
	}
	
	if (!empty($page)) return get_page_full_link($page, $img);
	if (!empty($url)) return "<a href=\"$url\" target=\"_blank\">$img</a>";
	
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
		'title' => 'Downloads',
		'type' => 'list', // list, gallery
	), $atts, 'downloads'));
	
	if ($name == '') {
		global $post;
		$name = $post->post_name;
	}

	$downloads = get_downloads($name);
	if (!count($downloads['files'])) return '';
	
	if (!empty($title)) {
		$title = "<h4>$title</h4>";
	}

	if ($type == 'gallery') {
		$table = '';
		$counter = 0;
		foreach ($downloads['files'] as $file) {
			if ($counter % 3 == 0) {
				$table .= '<div class="row compact">';
			}
			$ext = strtolower(pathinfo($file['path'], PATHINFO_EXTENSION));
			if ($ext == 'pdf') {
			}
			// NOFOLLOW: do not pass link juice for PDFs on sidebars
			$table .= '<div class="col-md-4 col-sm-4 center">';
			$table .= '<a href="' . $file['file'] . '" rel="nofollow">';;
			$table .= '<img src="' . my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . "/images/pdf.png") . '" />';
			$table .= $file['title'];
			$table .= '</a></div>';
			if ($counter % 3 == 2) {
				$table .= '</div>';
			}
			++$counter;
		}

		if ($counter % 3 != 0) {
			while ($counter % 3 != 0) {
				$table .= '<div class="col-md-4 col-sm-4"></div>';
				++$counter;
			}
			$table .= '</div>';
		}

		return "<div class=\"container\">$table</div>";
	}

	// $type == 'list'
	$list = array();
	foreach ($downloads['files'] as $file) {
		// NOFOLLOW: do not pass link juice for PDFs on sidebars
		array_push($list, '<a href="' . $file['file'] . '" rel="nofollow">' . $file['title'] . '</a>');
	}

	return "$title<p>" . implode($list, '</p><p>') . '</p>';
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
		uasort($results, 'search_cmp');
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