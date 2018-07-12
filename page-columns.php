<?php //Template Name:Columns
if ($post->post_type == 'page') {
	add_action('wp_head', 'add_page_breadcrumblist');
}
get_header();
print_page_title(); ?>
<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/columns.min.css'); ?>" />
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container extra">
<?php
	the_post();
	get_template_part('content'); ?>
</div>
<?php get_footer(); ?>