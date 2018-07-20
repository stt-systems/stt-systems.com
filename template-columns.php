<?php //Template Name:Columns
if ($post->post_type == 'page') {
	add_action('wp_head', 'add_page_breadcrumblist');
}
get_header();
wp_enqueue_style('columns', get_template_directory_uri() . '/css/columns.min.css');
print_page_title();
?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container extra">
<?php
	the_post();
	get_template_part('content'); ?>
</div>
<?php get_footer(); ?>