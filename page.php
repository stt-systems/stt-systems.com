<?php
if ($post->post_type == 'page') {
	add_action('wp_head', 'add_page_breadcrumblist');
}
get_header();
wp_enqueue_style('stt-styles');
wp_enqueue_style('columns');
print_page_title();
echo get_page_top_spacer(); ?>
<div class="content-wrapper body-wrapper blog-post blog-span container extra">
<?php
	the_post();
	get_template_part('content'); ?>
</div> <?php
get_footer(); ?>