<?php
get_header();
print_page_title();

$case_categories = get_categories(array(
	'parent' => get_category_by_slug('customer-cases')->term_id
));

$sections = array();
foreach ($case_categories as $cat) {
	$cases = get_posts_for_category($cat->term_id, 3);
	
	if (count($cases) > 0) {
		array_push($sections, array(
			'name' => $cat->name,
			'slug' => $cat->slug,
			'cases' => $cases
		));
	}
} ?>
<div id="cases-menu" class="cases-menu boxshadow">
	<table class="clean">
		<tr><?php
		$i = 0;
		foreach ($sections as $section) {?>
			<td id="<?php echo 'case-' . strval($i); ?>"><a href="#<?php echo $section['slug']; ?>" style="text-align:center;"><?php echo $section['name']; ?></a></td><?php
			++$i;
		} ?>
		</tr>
	</table>
</div>
<div class="content-wrapper body-wrapper blog-span blog-post-body"><?php
	foreach ($sections as $section) {
		print_category_section($section['slug'], $section['name'], $section['cases']);
	} ?>
</div>
<?php get_footer(); ?>
