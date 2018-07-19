<?php
get_header();
print_page_title(); ?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container"><?php
  $top_level_slug = get_top_level_slug();
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  query_posts(array(
    'category_name' => "blog-$top_level_slug",
    'posts_per_page' => 10,
    'paged' => $paged
  ));
  if (have_posts()) {
    while (have_posts()) { ?>
      <div class="row"><?php
      the_post();
      get_template_part('content'); ?>
      </div><?php
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
<?php get_footer(); ?>
