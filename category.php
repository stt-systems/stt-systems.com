<?php
$categories = get_the_category();
if (count($categories) == 0) {
	header('Location: ' . get_site_url());
	exit;
}
$cat = $categories[0];

get_header();
print_page_title($cat->slug, $cat->name);

$cat_description = category_description($cat->term_id);
if (!empty($cat_description)) {?>
	<div class="space-sep20"></div>
	<div class="content-wrapper body-wrapper blog-post blog-span container">
	<div class="row"><div class="col-md-12 col-sm-12">
	<div class="blog-post-body"><p>
	<?php
	echo $cat_description;
	?>
	</p></div></div></div></div><?php
}

$cases = get_posts_for_category($cat->term_id, -1);
?>
<div class="content-wrapper body-wrapper blog-span blog-post-body">
	<?php
	print_category_section($cat->name, $cat->cat_name, $cases, false);
	?>
</div>
<?php get_footer(); ?>
