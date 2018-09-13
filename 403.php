<?php header('HTTP/1.0 403 forbidden');
get_header();
echo get_page_top_spacer(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="not-found-40x">
				<h2><?php echo 'Error 403'; ?><i class="iscon-remove-sign skin-text"></i></h2>
				<p><?php echo "We're sorry, you don't have access to this file."; ?></p> 
				<p class="search-404"><a href="<?php echo esc_html(site_url()); ?>" class="btn btn-primary search-submit"><?php echo 'Go to Homepage'; ?></a></p>					
			</div>
		</div>
	</div>
 </div>
<?php get_footer(); ?>
