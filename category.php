<?php
$categories = get_the_category();
if (count($categories) == 0) {
	header('Location: ' . get_site_url());
	exit;
}
$cat = $categories[0];

get_header();
print_page_title($cat->slug, 'Customer cases: ' . $cat->name);

$cases = get_customer_cases($cat->term_id, -1);

?>
<div class="content-wrapper body-wrapper blog-span blog-post-body">
	<?php
	print_case_section($cat->name, $cat->cat_name, $cases, false);
	?>
</div>
<?php get_footer(); ?>
