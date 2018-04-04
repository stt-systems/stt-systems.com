<?php get_header(); ?>
<header>
<div class="page-template top-title-wrapper boxshadow">
	<div class="container row col-md-12 col-sm-12 page-info">
		<h1 class="h1-page-title"><?php printf( 'Tag: %s', single_tag_title("", false)); ?></h1>				
	</div>
</div>
</header>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container">
<div class="blog-post-body">
	<div class="row">
		<div class="col-md-9 col-sm-9"><?php
			if (have_posts()) {
				while (have_posts()) {
					the_post();
					get_template_part('content');
				}
			} ?>
			<div class="pagination"><?php
				if (get_next_posts_link()) {
					next_posts_link('<span class="prev">&larr;</span>'.__('Older posts', 'weblizar' ) );
				}
				if (get_previous_posts_link()) {
					previous_posts_link( __( 'Newer posts', 'weblizar' ). '<span class="next">&rarr;</span>' );
				} ?>
			</div>
		</div>
		<div class="col-md-3 col-sm-3">
			<div class="space-sep20"></div>
			<?php print_related_pages(); ?>
		</div>
	</div>
</div>
</div>
<?php get_footer(); ?>
