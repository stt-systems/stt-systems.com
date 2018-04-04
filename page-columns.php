<?php //Template Name:Columns
if ($post->post_type == 'page') {
	add_action('wp_head', 'add_page_breadcrumblist');
}
get_header();
print_page_title(); ?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container"><?php
	the_post();
	get_template_part('content'); ?>
</div>
<?php get_footer(); ?>