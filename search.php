<?php get_header(); ?>
<div class="top-title-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 page-info">
                <h1 class="h1-page-title"><?php printf(__('Search Results for: %s', 'weblizar'), '<span>' . get_search_query() . '</span>'); ?></h1>
            </div>
        </div>
    </div>
</div>
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
			'|'
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
			'\\|'
		), $search_string);
	$search_terms = preg_split('/[\s,;]+/', $search_string);
	$search_term_search = '/(' . implode('|', $search_terms) . ')/iu';
	
	$results = array(
		'pages' => array(),
		'news' => array(),
		'customer-cases' => array()
	);
	$news_cat_id = get_category_by_slug('news')->term_id;
	$customer_cases_cat_id = get_category_by_slug('customer-cases')->term_id;

	$any_result = false;
	if (have_posts()) {
		while (have_posts()) {
			the_post();
			$type = '';
			if ($post->post_name != 'home') {
				if (in_category('news')) {
					$type = 'news';
				} else if (post_is_in_descendant_category($customer_cases_cat_id)) {
					$type = 'customer-cases';
				} else {
					$type = 'pages';
				}
			}

			if ($type != '' and $post->post_password == '') {
				$excerpt = get_the_excerpt();
				$excerpt = preg_replace($search_term_search, '<mark>\0</mark>', $excerpt);
				$title = preg_replace($search_term_search, '<mark>\0</mark>', $post->post_title);
				array_push($results[$type], array(
					'title' => $title,
					'date' => ($type == 'pages') ? null : $post->post_date,
					'slug' => $post->post_name,
					'id' => $post->ID,
					'excerpt' => $excerpt
				));
				$any_result = true;
			}
			unset($type);
		}

		if ($any_result) {
			display_search_results($results['pages'], 'Pages');
			display_search_results($results['customer-cases'], 'Customer cases');
			display_search_results($results['news'], 'News');
		}
	}

	if (!$any_result) { ?>
		<div class="blog-span">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e('Nothing Found', 'weblizar'); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php _e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'weblizar'); ?></p>
			</div>
		</div><?php
	} ?>
</div>
<?php get_footer(); ?>