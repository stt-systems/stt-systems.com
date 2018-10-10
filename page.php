<?php
if ($post->post_type == 'page') {
	add_action('wp_head', 'add_page_breadcrumblist');
}
get_header();
wp_enqueue_style('stt-styles', get_template_directory_uri() . '/css/stt-styles.min.css');
wp_enqueue_style('columns', get_template_directory_uri() . '/css/columns.min.css');
print_page_title();
echo get_page_top_spacer(); ?>
<div class="content-wrapper body-wrapper blog-post blog-span container extra">
<?php
	the_post();
	get_template_part('content'); ?>
</div> <?php
if (get_post()->post_name == "contact-us") { ?>
	<div class="map-overlay" onClick="style.pointerEvents='none'"></div>
	<iframe class="boxshadow" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11899828.893803455!2d-0.04826216972901577!3d43.267522259849265!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51b06b579c8b15%3A0x2ad284836fa91c7!2sStt+Ingenier%C3%ADa+y+Sistemas+S.L.!5e0!3m2!1ses!2s!4v1422375720004" height="450" style="display:block;width:100%"></iframe><?php
}
get_footer(); ?>