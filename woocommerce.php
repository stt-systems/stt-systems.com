<?php
if (!is_user_logged_in()) { // do not show Store during development
	require('404.php');
} else {
  get_header();
  print_page_title('store', 'Store'); ?>
<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/woocommerce.min.css'); ?>" />
<?php require_once('includes/woocommerce_subbanner.php'); ?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container">
	<div class="row">
		<div class="col-md-9 col-sm-9">
		<?php woocommerce_content(); ?>
		</div>
	</div>
</div>
<?php
  get_footer();
} ?>