<?php
get_header();
wp_enqueue_style('columns', get_template_directory_uri() . '/css/columns.min.css');
print_page_title();
?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container extra">
  <div class="row">
  <div class="col-md-12 col-sm-12 col-extra style-white center">
    <h1>Blog</h1>
  </div>
  </div>
  <?php
  $top_level_slug = get_top_level_slug();
  $paged = get_query_var('paged') ? get_query_var('paged') : 1;
  query_posts(array(
    'category_name' => "blog-$top_level_slug",
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
      if ($wp_query->current_post % 2 == 0) {
        print_thumbnail($style);
      } ?>
      <div class="col-md-8 col-sm-8 col-extra <?php echo $style; ?>">
  		<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h3><?php
      get_template_part('content'); ?>
      </div><?php
      if ($wp_query->current_post % 2 == 1) {
        print_thumbnail($style);
      } ?>
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
