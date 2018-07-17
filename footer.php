<footer>
	<div class="footer boxshadow">
		<div class="container">
			<div class="footer-wrapper">
				<div class="row">
				<div class="col-md-2 col-sm-2 footer-col footer-logo-col">
					<img src="<?php echo my_get_image_url('logo/logo-footer.png', false); ?>" class="footer-logo" height="171" alt="STT's logo" />
				</div>
				<div class="col-lg-2 col-md-3 col-sm-3 footer-col">
					<div class="footer-title"><?php echo get_page_full_link('contact-info', 'Contact', 'page', !is_front_page() ? 'nofollow' : ''); ?></div>
					<div class="textwidget tight-paragraphs">
						<p>Phone: (+34) 943 31 77 77</p>
						<p>Fax: (+34) 943 31 64 31</p>
						<p><a href="mailto:info@stt-systems.com">info@stt-systems.com</a></p>
						<p>Zuatzu Business Park</p>
						<p>Easo Building, 2nd Floor</p>
						<p>20018 San Sebasti&aacute;n, Spain</p>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 footer-col">
					<div class="footer-title"><?php echo get_page_full_link('news', 'Recent', 'page', !is_front_page() ? 'nofollow' : ''); ?></div>
					<div class="textwidget">
						<?php get_widget_recent_posts(''); ?>
					</div>
				</div>
				<div class="col-lg-4 col-md-3 col-sm-3 footer-col">
					<div class="textwidget">
						<div class="sidebar-content tags blog-search">
						<form method="get" id="searchform" action="<?php echo site_url();?>">
							<input type="text" class="blog-search-input text-input" name="s" id="s" placeholder="Search&hellip;">
							<button class="blog-search-button icon-search ">&#xf002;</button>
						</form>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6" style="margin-bottom: 0px;">
						<div class="copyright-text">
							&copy; <?php echo date('Y'); ?> STT Systems
						</div>
					</div>
					<div class="col-md-6 col-sm-6"> 
						<div class="social-icons">
							<ul>
								<li><a href="https://www.youtube.com/user/SttSystems" title="Youtube" target="_blank" class="social-media-icon youtube-icon"></a></li>
								<li><a href="https://www.linkedin.com/company/stt-systems" title="LinkedIn" target="_blank" class="social-media-icon linkedin-icon"></a></li>
								<li><a href="https://twitter.com/sttsystems" title="Twitter" target="_blank" class="social-media-icon twitter-icon"></a></li>
								<li><a href="https://www.facebook.com/STTSystems" title="Facebook" target="_blank" class="social-media-icon facebook-icon"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</footer>
<?php wp_footer(); ?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/menu.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/youtube-autoresizer.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.blueimp-gallery.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.localScroll.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.scrollTo.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.unveil.min.js', false); ?>"></script>

<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/fonts/firasans/stylesheet.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/theme-menu.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/font-awesome.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/flat-blue.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/responsive.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/blueimp-gallery.min.css', false); ?>" />

<script src="//wurfl.io/wurfl.js"></script>
<script>if(!WURFL.is_mobile){var s=document.createElement("script");s.src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/retina.min.js', false); ?>",document.getElementsByTagName("body")[0].appendChild(s)}</script>
</body>
</html><?php
ob_end_flush(); ?>