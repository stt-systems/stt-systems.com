<?php //Template Name:Empty
get_header();
echo get_page_top_spacer(); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">			
			<div class="not-found-40x">
				<h2><?php echo ':('; ?><i class="iscon-remove-sign skin-text"></i></h2>
				<p><?php echo "We're sorry, but the page you were looking for doesn't have any content."; ?></p> 
				<p class="search-404"><a href="<?php echo esc_html(site_url()); ?>" class="btn btn-primary"><?php echo 'Go to Homepage'; ?></a></p>
			</div>
		</div>
	</div>
 </div>
<?php get_footer(); ?>
