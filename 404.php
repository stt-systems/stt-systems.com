<?php header('HTTP/1.0 404 not found');
get_header();
echo get_page_top_spacer(); ?>
<div class="container">
<div class="row">
		<div class="col-md-12 col-sm-12">			
			<div class="not-found-40x">
				<h2><i class="fas fa-unlink" style="font-size: 75%"></i> <?php echo 'Error 404'; ?> <i class="fas fa-unlink" style="font-size: 75%"></i></h2>
				<p><?php echo __("We're sorry, but the page you were looking for doesn't exist."); ?></p> 
				<p class="search-404"><a href="<?php echo esc_html(site_url()); ?>" class="btn btn-primary search-submit"><?php echo 'Go to Homepage'; ?></a></p>					
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
