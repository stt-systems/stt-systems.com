<?php
get_header();
print_page_title(); ?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container">
	<div class="row">
		<div class="col-md-9 col-sm-9"> <?php
			the_post();
			get_template_part('content'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>