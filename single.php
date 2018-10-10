<?php
get_header();
wp_enqueue_style('stt-styles');
wp_enqueue_style('columns');
echo get_page_top_spacer(true);
print_page_title(); ?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container">
<div class="blog-post-body">
	<div class="row">
		<div class="col-md-9 col-sm-9"> <?php
			the_post();
			get_template_part('content'); ?>
		</div>
		<div class="col-md-3 col-sm-3 related-pages">
			<div class="space-sep50"></div>
			<?php print_related_pages(); ?>
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>