<?php
$page_style_array = get_post_custom_values("style");
if (empty($page_style_array)) {
  $style_name = "base-class";
} else {
  $style_name = $page_style_array[0];
}
$page_style = "style-$style_name";
if (!is_page()) {
	if ($post->post_type == 'post') { ?>
		<div class="blog-post-details">
			<div class="blog-post-details-item blog-post-details-item-left">
				<span class="fa fa-calendar"></span><?php the_time('M j, Y'); ?>
			</div><?php
			
			if (get_the_category_list() != '' and false) { ?>
				<div class="blog-post-details-item blog-post-details-item-left">
					<span class="fa fa-folder-open"></span><?php the_category(', ', 'single', get_the_ID()); ?>
				</div><?php
			}
			
			if (get_the_tag_list() != '') { ?>
				<div class="blog-post-details-item blog-post-details-item-left">
					<span class="fa fa-tags"></span><?php the_tags('', ', ', '<br />'); ?>
				</div><?php
			} ?>
		</div><?php
	}
}

if ($post->post_type == 'page') {
	add_page_path();
} ?>
<div class="space-sep20"></div>
<div class="blog-post-body <?php echo "$page_style";?>"><?php
	if (!is_page() and !is_single()) {
		the_excerpt();
	} else {
		the_content();
	}
  if ($post->post_type == 'post' and is_single()) {
    add_share_buttons();
  } ?>
</div>
