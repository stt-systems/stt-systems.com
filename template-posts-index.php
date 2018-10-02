<?php //Template Name:Posts index
$category_name = get_post()->post_name;
$cat = get_category_by_slug($category_name);
if ($cat === False) {
	header('Location: ' . get_site_url());
	exit;
}

get_header();
wp_enqueue_style('columns', get_template_directory_uri() . '/css/columns.min.css');
print_page_title();
echo get_page_top_spacer(); ?>
<div class="content-wrapper body-wrapper blog-post blog-span container extra"> <?php
  add_page_path(); ?>
  <div class="space-sep20"></div>
  <div class="row">
  <div class="col-md-12 col-sm-12 col-extra style-white center"><?php
    echo '<h1>' . $cat->name . '</h1>';
		$cat_description = category_description($cat->term_id);
		if (!empty($cat_description)) {
			echo "<i>$cat_description</i>";
		} ?>
  </div>
  </div><?php
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  echo replace_post_list_shortcode(array(
    'category' => $category_name,
    'count' => 10,
    'paged' => $paged,
    'details' => true,
  )); ?>
  <div class="pagination"><?php
    if (get_next_posts_link()) {
      next_posts_link(__('&larr; Older posts', 'stt'));
    }
    if (get_previous_posts_link()) {
      previous_posts_link(__('Newer posts &rarr;', 'stt'));
    } ?>
	</div>
</div>
<?php get_footer(); ?>
