<?php
if (!is_page()) {
	if (!is_single()) { ?>
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_title(); ?></a></h2><?php
	} else { ?>
		<div class="space-sep20"></div><?php
	}
	if ($post->post_type == 'post') { ?>
		<div class="blog-post-details">
			<div class="blog-post-details-item blog-post-details-item-left">
				<span class="fa fa-calendar"></span><?php the_time('M j, Y'); ?>
			</div><?php
			
			if(get_the_category_list() != '' and false) { ?>
				<div class="blog-post-details-item blog-post-details-item-left">
					<span class="fa fa-folder-open"></span><?php the_category(', ', 'single', get_the_ID()); ?>
				</div><?php
			}
			
			if(get_the_tag_list() != '') { ?>
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
<div class="blog-post-body"><?php
	echo stt_replace_content(get_the_content());
	if ($post->post_type == 'post') {
		add_share_buttons();
	} ?>
</div>
