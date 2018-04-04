<?php /*
<div class="col-md-3 col-sm-3"><?php
	if (function_exists('wp_tag_cloud')) {
		$cats = wp_tag_cloud('echo=0&smallest=15&largest=15&unit=px&format=list&taxonomy=category&exclude=' . get_cat_ID('news') . ',' . get_cat_ID('customer cases'));
		if (count($cats) > 0) { ?>
			<div class="widget">
				<h2 class="widgettitle"><span class="fa fa-folder-open"></span>Categories</h2><?php
				echo $cats;
				unset($cats); ?>
			</div><?php
		}
	}
	if (function_exists('wp_tag_cloud')) {
		$tags = wp_tag_cloud('echo=0&smallest=12&largest=24&unit=px&separator= ');
		if (count($tags) > 0) { ?>
			<div class="widget">
				<h2 class="widgettitle"><span class="fa fa-tags"></span>Tags</h2><?php
				echo $tags;
				unset($tags); ?>
			</div><?php
		}
	} ?>
</div><?php */ ?>