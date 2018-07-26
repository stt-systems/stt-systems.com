<?php //Template Name:Posts index
$cat = get_category_by_slug(get_post()->post_name);
if ($cat === False) {
	header('Location: ' . get_site_url());
	exit;
}

get_header();
wp_enqueue_style('columns', get_template_directory_uri() . '/css/columns.min.css');
print_page_title();
?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container extra"> <?php
  add_page_path(); ?>
  <div class="space-sep20"></div>
  <div class="row">
  <div class="col-md-12 col-sm-12 col-extra style-white center"><?php
    echo '<h1>' . $cat->name . '</h1>';
		$cat_description = category_description($cat->term_id);
		if (!empty($cat_description)) {
			echo $cat_description;
		} ?>
  </div>
  </div>
  <?php
  $category_name = get_top_level_slug();
  if ($category_name == 'capture') {
    $category_name = 'blog';
  }
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  query_posts(array(
    'category_name' => $category_name,
    'posts_per_page' => 10,
    'paged' => $paged
  ));
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      $style = 'style-ultra-light';
      if ($wp_query->current_post % 2 == 1) {
        $style = 'style-white';
      } ?>
      <div class="row"><?php
      print_thumbnail($style); ?>
      <div class="col-md-8 col-sm-8 col-extra <?php echo $style; ?>">
  		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h3><?php
      get_template_part('content'); ?>
      </div>
      </div><?php
    }
  } ?>
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
