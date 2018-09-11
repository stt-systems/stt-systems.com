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
	$content = preg_replace_callback("#\[gallery:([_a-zA-Z0-9/-]+)\]#", 'replace_gallery_cb', $content);

	//$content = "<div class=\"row\"><div class=\"col-md-12 col-sm-12\">$content";

	// Move the fullscreen galleries div outside the blog to avoid footer and header overlap it
	// Additionally, each gallery div is associated to a set of images by the gallery's ID
	$len = strlen($content);
	$content = preg_replace_callback('#[\s]*\[gallery_snippet-([_a-zA-Z0-9-]+)\][\s]*#', 'replace_gallery_snippet_cb', $content);
	if ($len != strlen($content)) { ?>
		<script type="text/javascript">window.onload=function(){$('body').append($('.blueimp-gallery'));};</script><?php
	}
	
	//$content .= '</div></div>';

	return $content;
}

// Callbacks for custom commands in post content
function replace_row_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
    'id' => '',
	), $atts, 'row'));

  if ($id != "") {
    $id = "id=$id";
	}
	
	$content = do_shortcode($content);
  
	return "<div $id class=\"row\">$content</div>";
}
function replace_column_shortcode($atts, $content = null) {
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
    $image_url = get_upload_url("$image");
    $height = $height . "px";
  
    $inner_html .= "<div class=\"extend-full\" style=\"background-image: url($image_url); height: $height;\"></div>";
    $stylesheet .= "padding-top:0;padding-bottom:0;";
  }
  
  if ($stylesheet != '') {
    $stylesheet = " style=\"$stylesheet\"";
  }
  
	$content = do_shortcode($content);

  return "<div class=\"$class col-extra style-$style\"$stylesheet>$inner_html$content</div>";
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
	if ($title == '') $title = $url;
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
		'shadow' => 'yes',
    'icon' => 'no',
		'alt' => '',
		'lazy' => 'no',
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
  if (strcasecmp($icon, 'true') == 0 || strcasecmp($icon, 'yes') == 0) {
    $size = 'width="80" height="80"';
    $class .= 'icon';
		$shadow = 'false';
  }
	
	if (strcasecmp($shadow, 'true') == 0 || strcasecmp($shadow, 'yes') == 0) {
		$class .= 'boxshadow';
	}
  
  if ($class != '') {
		$class = " class=\"$class\"";
  }

	$img = '';
	$image_url = get_upload_url("$name");
	if (strcasecmp($lazy, 'true') == 0 || strcasecmp($lazy, 'yes') == 0) {
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
	$path = get_upload_url($data['base'] . $value);
	$thumb = get_upload_url($data['base'] . "thumb-$value");
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
	$images = get_files_in_dir("galleries/$gallery", 'thumb-', array('txt'));
	array_walk($images, 'walk_gallery_cb', $walk_data);
	$gal_images = '<div id="links-' . $clean_name . '" style="text-align:center;" class="gallery">' . implode($images) . '</div>' . $title;

	return $gal_images . '[gallery_snippet-' . $clean_name . ']';
}

function walk_images_table_cb(&$value, $key, $base) {
	$path = get_upload_url("$base/$value");
	$value = "<td><img src=\"$path\" style=\"max-height: 100px;\"></img></td>";
}

function replace_image_table_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
		'columns' => '5',
	), $atts, 'images-table'));

	if ($name == '') return '';

	$images = get_files_in_dir($name, '', array('txt'));
	if (!count($images)) return '';
	
	if ($columns <= 2) {
		echo 'Error: wrong number of columns for image-table\n';
		return '';
	}
	array_walk($images, 'walk_images_table_cb', $name);

	// Create table
	$table = '';
	$i = 0;
	foreach ($images as $image) {
		if ($i % $columns == 0) {
			$table .= '<tr>';
		}
		$table .= $image;
		if ($i % $columns == $columns - 1) {
			$table .= '</tr>';
		}
		++$i;
	}

	if ($table == '') return '';
	return "<table class=\"clean images\">$table</table>";
}

// Videos
function replace_video_shortcode($atts) {
	extract(shortcode_atts(array(
		'name' => '',
		'caption' => '',
		'type' => 'youtube',
		'time' => '',
	), $atts, 'video'));
	
	if ($type == 'youtube') return get_youtube_video($name, $caption, $time);
	if ($type == 'facebook') return get_facebook_video($name, $caption);
	return '';
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
	), $atts, 'download'));
	
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
		'zip' => 'yes', // generates a zip file, valid only for gallery type
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
		$cols = min(count($downloads['files']), 5);
		$col_class = $cols > 3 ? 2 : 4;
		$col_spacer = (12 - $cols * $col_class) / 2;
		foreach ($downloads['files'] as $file) {
			$ext = strtolower(pathinfo($file['path'], PATHINFO_EXTENSION));
			$thumbnail_url = '';
			$thumbnail_alt = '';
			if ($ext == 'png' || $ext == 'jpg' || $ext == 'jpeg') {
				$thumbnail_url = $file['file'];
				$thumbnail_alt = $file['title'];
			} else {
				if ($ext == 'docx') $ext = 'doc';
				if ($ext == 'xlsx') $ext = 'xls';
				if ($ext == 'pptx') $ext = 'ppt';
				$thumbnail_url = my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . "/images/file-types/$ext.png");
			}
			if ($thumbnail_alt != '') {
				$thumbnail_alt = "alt=\"$thumbnail_alt\"";
			}

			if ($counter % $cols == 0) {
				$table .= '<div class="row compact">';
				if ($col_spacer > 0) {
					$table .= "<div class=\"col-md-$col_spacer col-sm-$col_spacer\"></div>";
				}
			}

			// NOFOLLOW: do not pass link juice for PDFs on sidebars
			$table .= "<div class=\"col-md-$col_class col-sm-$col_class center\">";
			$table .= '<a href="' . $file['file'] . '" rel="nofollow">';
			$table .= "<div class=\"image\"><img class=\"img img-responsive rounded\" src=\"$thumbnail_url\" height=\"128\" $thumbnail_alt/></div>";
			$table .= $file['title'];
			$table .= '</a></div>';

			if ($counter % $cols == $cols - 1) {
				if ($col_spacer > 0) {
					$table .= "<div class=\"col-md-$col_spacer col-sm-$col_spacer\"></div>";
				}
				$table .= '</div>';
			}

			++$counter;
		}

		if ($counter % $cols != 0) {
			while ($counter % $cols != 0) {
				$table .= "<div class=\"col-md-$col_class col-sm-$col_class center\"></div>";
				++$counter;
			}
			if ($col_spacer > 0) {
				$table .= "<div class=\"col-md-$col_spacer col-sm-$col_spacer center\"></div>";
			}
			$table .= '</div>';
		}

		if ($counter <= $cols) {
			// Add fake row to avoid overflowing the prvious row
			$table .= '<div class="row compact fake">';
			if ($col_spacer > 0) {
				$table .= "<div class=\"col-md-$col_spacer col-sm-$col_spacer center\"></div>";
			}
			++$counter;
			while ($counter % $cols != 0) {
				$table .= "<div class=\"col-md-$col_class col-sm-$col_class center\"></div>";
				++$counter;
			}
			if ($col_spacer > 0) {
				$table .= "<div class=\"col-md-$col_spacer col-sm-$col_spacer center\"></div>";
			}
			$table .= '</div>';
		}

		$download_all = '';
		if ($zip == 'yes') {
			$zip_file = new ZipArchive;
			if ($zip_file->open($downloads['base_dir'] . "/$name.zip", ZipArchive::CREATE)) {
					foreach ($downloads['files'] as $file) {
					$zip_file->addFile($file['path'], $file['filename']);
				}
				$zip_file->close();
				$zip_url = my_get_download_url("$name/$name.zip");
				$download_all = "<div><a href=\"$zip_url\">Download all (ZIP)</a></div>";
			}
		}

		return "<div class=\"container\">$table</div>$download_all";
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

function get_social_img($name) {
	$url = WL_TEMPLATE_DIR_URI . '/images/social-media/' . $name . '.png';	
	return '<img src="' . $url . '" width="32" height="32" alt="' . $name . '" />';
}
function replace_social_links_shortcode() {
	$code = "<div class=\"contact-social\">
		<a href=\"https://www.facebook.com/STTSystems\" title=\"Facebook\" target=\"_blank\">". get_social_img('facebook') . "</a>
		<a href=\"https://twitter.com/sttsystems\" title=\"Twitter\" target=\"_blank\">" . get_social_img('twitter') . "</a>
		<a href=\"https://www.instagram.com/stt.systems\" title=\"Instagram\" target=\"_blank\">" . get_social_img('instagram') . "</a>
		<a href=\"https://www.linkedin.com/company/stt-systems\" title=\"LinkedIn\" target=\"_blank\">" . get_social_img('linkedin') . "</a>
		<a href=\"https://www.youtube.com/user/SttSystems\" title=\"Youtube\" target=\"_blank\">" . get_social_img('youtube') . "</a>
		</div>";
	return $code;
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
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>" target="_blank" title="Share on Facebook"><?php echo get_social_img('facebook'); ?></a></li>
		<li><a href="https://twitter.com/intent/tweet?source=https%3A%2F%2Fwww.stt-systems.com&amp;text=<?php echo $title; ?>%20-%20<?php echo $url; ?>&amp;via=STTSystems" target="_blank" title="Tweet"><?php echo get_social_img('twitter'); ?></a></li>
		<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" title="Share on LinkedIn"><?php echo get_social_img('linkedin'); ?></a></li>
		<li><a href="mailto:?subject=<?php echo $title; ?>&amp;body=Read this: <?php echo $url; ?>" target="_blank" title="Email"><?php echo get_social_img('email'); ?></a></li>
	</ul><?php
}

function replace_post_list_shortcode($atts) {
	extract(shortcode_atts(array(
		'tag' => '',
		'category' => '',
		'count' => '100',
		'paged' => '1',
		'details' => false,
		'style1' => 'ultra-light',
		'style2' => 'white',
	), $atts, 'post-list'));

	global $wp_query;
  query_posts(array(
		'tag_name' => $tag,
		'category_name' => $category,
    'posts_per_page' => $count,
    'paged' => $paged
	));
	
	$post_list = '';
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      $style = "style-$style1";
      if ($wp_query->current_post % 2 == 1) {
        $style = "style-$style2";
      }
      $post_list .= '<div class="row">';
      $post_list .= get_post_thumbnail($style);
			$post_list .= "<div class=\"col-md-8 col-sm-8 col-extra $style\">";
			$post_list .= '<h3><a href="' . get_permalink() . '" title="' . the_title_attribute(array('echo' => false)) . '" >' . get_the_title() . '</a></h3>';
			ob_start();
			set_query_var('post_details', $details);
      get_template_part('content');
			$post_list .= ob_get_contents();
			ob_end_clean();
      $post_list .= '</div></div>';
    }
  }

	return $post_list;
}

function replace_collapse_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'id' => '',
		'title' => '',
		'class' => '',
		'collapsed' => 'true',
	), $atts, 'collapse'));

	$content = do_shortcode($content);

	$class_a = 'class="collapsed"';
	if ($collapsed == 'false') {
		$class_a = '';
		$class = "in $class";
	}

	$code = "<h3><a href=\"#$id\" $class_a data-toggle=\"collapse\">
  					<span class=\"if-collapsed\">&#9654; $title</span>
  					<span class=\"if-not-collapsed\">&#9660; $title</span>
					</a></h3>";
	$code .= "<div id=\"$id\" class=\"collapse $class\">$content</div>";

	return $code;
}

function add_stt_shortcodes() {
  add_shortcode('row',           'replace_row_shortcode');
  add_shortcode('column',        'replace_column_shortcode');
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
	add_shortcode('social-links',  'replace_social_links_shortcode');
	add_shortcode('image-table',   'replace_image_table_shortcode');
	add_shortcode('post-list',     'replace_post_list_shortcode');
	add_shortcode('collapse',      'replace_collapse_shortcode');
}

add_action('wp_loaded', 'add_stt_shortcodes', 99999);
?>