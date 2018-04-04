<?php
get_header();
print_page_title(); ?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container">
	<div class="row">
		<div class="col-md-9 col-sm-9"><?php
			$paged = get_query_var('paged') ? get_query_var('paged') : 1;
			query_posts(array(
				'category_name' => 'news',
				'posts_per_page' => 5,
				'paged' => $paged
			));
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					get_template_part('content');
				}
			} ?>
			<div class="pagination"><?php
				if (get_next_posts_link()) {
					next_posts_link('<span class="prev">&larr;</span>' . __('Older news', 'weblizar'));
				}
				if (get_previous_posts_link()) {
					previous_posts_link(__('Newer news', 'weblizar') . '<span class="next">&rarr;</span>');
				} ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
