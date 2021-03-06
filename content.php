<?php
$page_style_array = get_post_custom_values("style");
if (empty($page_style_array)) {
  $style_name = "base-class";
} else {
  $style_name = $page_style_array[0];
}
$page_style = "style-$style_name";
if (!is_page()) {
	if ($post->post_type == 'post' && get_query_var('post_details', true)) { ?>
		<div class="blog-post-details">
			<div class="blog-post-details-item blog-post-details-item-left">
				<span class="fa fa-calendar"></span><?php the_time('M j, Y'); ?>
			</div><?php
			
			/*
			if (get_the_category_list() != '' && false) { ?>
				<div class="blog-post-details-item blog-post-details-item-left">
					<span class="fa fa-folder-open"></span><?php the_category(', ', 'single', get_the_ID()); ?>
				</div><?php
			}
			
			if (get_the_tag_list() != '') { ?>
				<div class="blog-post-details-item blog-post-details-item-left">
					<span class="fa fa-tags"></span><?php the_tags('', ', ', '<br />'); ?>
				</div><?php
			} */?>
			<div class="space-sep<?php echo is_single() ? 20 : 10 ?>"></div>
		</div><?php
	}
} else {
	add_page_path();
}
?>
<div class="blog-post-body <?php echo "$page_style";?>"><?php
	if (!is_page() and !is_single()) {
		the_excerpt();
	} else {
		the_content();
	}
  if ($post->post_type == 'post' and is_single() and USE_STT_SHARE_BUTTONS) {
    add_share_buttons();
  } ?>
</div>
