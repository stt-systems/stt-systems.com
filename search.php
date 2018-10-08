<?php
// Disable some specific shortcodes
function dummy_shortcode($atts, $content = null) {
	return '';
}
function disable_shortcodes() {
	$disabled_shortcodes = array(
		'collapse',
		'post-list'
	);
	foreach ($disabled_shortcodes as $shortcode) {
		remove_shortcode($shortcode);
		add_shortcode($shortcode, 'dummy_shortcode');
	}
}

function trim_to_search_result($text, $num_words = 55, $more = null) {
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

disable_shortcodes();
get_header();
echo get_page_top_spacer(true);
print_page_title('', sprintf(__('Search results for: %s', 'stt'), '<span>' . get_search_query() . '</span>'));
?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span">
	<?php
	$search_string = get_search_query();
	$search_string = str_replace(array(
			'\\',
			'[',
			']',
			'(',
			')',
			'{',
			'}',
			'.',
			'/',
			'?',
			'+',
			'-',
			'$',
			'^',
			'*',
			'|',
		), array(
			'\\\\',
			'\\[',
			'\\]',
			'\\(',
			'\\)',
			'\\{',
			'\\}',
			'\\.',
			'\\/',
			'\\?',
			'\\+',
			'\\-',
			'\\$',
			'\\^',
			'\\*',
			'\\|',
		), $search_string);
	$search_terms = preg_split('/[\s,;]+/', $search_string);
	$search_term_search = '/(' . implode('|', $search_terms) . ')/iu';
	
	$results = array(
		'page' => array(),
		'post' => array(),
	);

	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[&hellip;]');

	$any_result = false;
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			if ($post->post_password == '') {
				$content = apply_filters('the_content', get_the_content());
				$excerpt = trim_to_search_result($content, $excerpt_length, $excerpt_more);
				$excerpt = preg_replace($search_term_search, '<mark>\0</mark>', $excerpt);
				$title = preg_replace($search_term_search, '<mark>\0</mark>', $post->post_title);
				array_push($results[$post->post_type], array(
					'title' => $title,
					'date' => $post->post_type == 'page' ? null : $post->post_date,
					'slug' => $post->post_name,
					'id' => $post->ID,
					'excerpt' => $excerpt
				));
				$any_result = true;
			}
		}

		if ($any_result) {
			display_search_results($results['page']);
			display_search_results($results['post']);
		}
	}

	if (!$any_result) { ?>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="not-found-40x">
				<h2><?php echo __('Nothing Found'); ?><i class="iscon-remove-sign skin-text"></i></h2>
				<p><?php echo __('Sorry, but nothing matched your search criteria. Please try again with some different keywords.'); ?></p> 
			</div>
		</div>
	</div><?php
	} ?>
</div>
<?php get_footer(); ?>