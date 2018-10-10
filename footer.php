<footer>
	<div class="footer boxshadow">
		<div class="container">
			<div class="footer-wrapper">
				<div class="row">
				<div class="col-md-2 col-sm-2 footer-col footer-logo-col">
					<img src="<?php echo get_upload_url('logos/logo-footer.png', false); ?>" class="footer-logo" height="171" alt="STT's logo" />
				</div>
				<div class="col-md-2 col-sm-3 footer-col">
					<div class="footer-title"><?php echo get_page_full_link('contact-us', 'Contact', 'page', !is_front_page() ? 'nofollow' : ''); ?></div>
					<div class="textwidget tight-paragraphs">
						<p>Phone: (+34) 943 31 77 77</p>
						<p>Fax: (+34) 943 31 64 31</p>
						<p><a href="mailto:info@stt-systems.com">info@stt-systems.com</a></p>
						<p>Zuatzu Business Park</p>
						<p>Easo Building, 2nd Floor</p>
						<p>20018 San Sebasti&aacute;n, Spain</p>
					</div>
				</div>
				<div class="col-md-1 col-sm-1 footer-col ghost"></div>
				<div class="col-md-4 col-sm-6 footer-col">
				<div class="footer-title">SITEMAP</div>
					<div class="textwidget">
					<div style="padding-left:15px">
						<div class="row">
						<?php
						wp_reset_query();
						$top_slug = get_top_level_slug();
						if ($top_slug == 'motion-analysis') { ?>
							<div class="col-md-4 col-sm-4"><?php
								echo '<p><strong>' . get_page_full_link('3d-optical-motion-capture', '3DMA') . '</strong></p>';
								echo '<p>' . get_page_full_link('sports-3dma') . '</p>';
								echo '<p>' . get_page_full_link('cycling-3dma') . '</p>';
								echo '<p>' . get_page_full_link('golf-3dma') . '</p>';
								echo '<p>' . get_page_full_link('clinical-3dma') . '</p>';
								echo '<p>' . get_page_full_link('running-3dma') . '</p>';
								echo '<p>' . get_page_full_link('human-3dma') . '</p>';
								echo '<p>' . get_page_full_link('eddo', 'EDDO') . '</p>'; ?>
							</div>
							<div class="col-md-3 col-sm-3"><?php
								echo '<p><strong>' . get_page_full_link('2d-optical-motion-capture', '2DMA') . '</strong></p>';
								echo '<p>' . get_page_full_link('bikefit', 'BikeFit') . '</p>'; ?>
							</div>
							<div class="col-md-4 col-sm-4"><?php
								echo '<p><strong>' . get_page_full_link('inertial-motion-capture', 'INERTIAL') . '</strong></p>';
								echo '<p>' . get_page_full_link('isen') . '</p>'; ?>
							</div><?php
						} else if ($top_slug == 'industry') { ?>
							<div class="col-md-6 col-sm-6"><?php
								echo '<p><strong>' . get_page_full_link('industry', 'INDUSTRY') . '</strong></p>';
								echo '<p>' . get_page_full_link('machine-vision', 'Machine vision') . '</p>';
								echo '<p>' . get_page_full_link('product-configurators', 'Product configurators') . '</p>';
								echo '<p>' . get_page_full_link('rdi', 'R+D+i') . '</p>'; ?>
							</div><?php
						} else { ?>
							<div class="col-md-6 col-sm-6"><?php
								echo '<p><strong>' . get_page_full_link('motion-analysis', 'MOTION ANALYSIS') . '</strong></p>';
								echo '<p>' . get_page_full_link('3d-optical-motion-capture', '3DMA') . '</p>';
								echo '<p>' . get_page_full_link('2d-optical-motion-capture', '2DMA') . '</p>';
								echo '<p>' . get_page_full_link('inertial-motion-capture', 'Inertial') . '</p>';
								echo '<p>' . get_page_full_link('contact-support', 'Support') . '</p>'; ?>
							</div>
							<div class="col-md-6 col-sm-6"><?php
								echo '<p><strong>' . get_page_full_link('industry', 'INDUSTRY') . '</strong></p>';
								echo '<p>' . get_page_full_link('machine-vision', 'Machine vision') . '</p>';
								echo '<p>' . get_page_full_link('product-configurators', 'Product configurators') . '</p>';
								echo '<p>' . get_page_full_link('rdi', 'R+D+i') . '</p>'; ?>
							</div><?php
						} ?>
						</div>
					</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 footer-col">
					<div class="sidebar-content tags blog-search">
					<form method="get" id="searchform" action="<?php echo site_url();?>">
						<input type="text" class="blog-search-input text-input" name="s" id="s" placeholder="Search&hellip;">
						<button class="blog-search-button"><i class="fas fa-search"></i></button>
					</form>
					</div>
				</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
				<div class="col-md-2 col-sm-4" style="margin-bottom:0">
						<div class="copyright-text">
							&copy; <?php echo date('Y'); ?> STT Systems
						</div>
					</div>
					<div class="col-md-4 col-sm-2" style="margin-bottom:0">
						<div class="copyright-text">
							<a href="<?php echo get_page_permalink("credits"); ?>">Credits</a>
						</div>
					</div>
					<div class="col-md-6 col-sm-6"> 
						<div class="social-icons">
							<ul>
								<li><a href="https://www.youtube.com/user/SttSystems" title="Youtube" target="_blank" class="social-media-icon youtube-icon"></a></li>
								<li><a href="https://www.linkedin.com/company/stt-systems" title="LinkedIn" target="_blank" class="social-media-icon linkedin-icon"></a></li>
								<li><a href="https://twitter.com/sttsystems" title="Twitter" target="_blank" class="social-media-icon twitter-icon"></a></li>
								<li><a href="https://www.instagram.com/stt.systems" title="Instagram" target="_blank" class="social-media-icon instagram-icon"></a></li>
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

<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/font-sourcesanspro.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/theme-menu.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/flat-blue.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/responsive.min.css', false); ?>" />
<link rel="stylesheet" property="stylesheet" type="text/css" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/blueimp-gallery.min.css', false); ?>" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/<?php echo BOOTSTRAP_VERSION; ?>/js/bootstrap.min.js"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/menu.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/youtube-autoresizer.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.blueimp-gallery.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.localScroll.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.scrollTo.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/jquery.unveil.min.js', false); ?>"></script>
<script async src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/links-index.min.js', false); ?>"></script>
<script async id="match_height" src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<script async id="wurfl" src="//wurfl.io/wurfl.js"></script>

<script>$(document).ready(function(){$('.banner').each(function(){var l=$(this);l.css('background-image','url("'+l.attr('data-src')+'")');l.find('img.spinner').remove();});});</script>
<script>window.addEventListener('load',function(){if($('.col-extra').length)$('.col-extra').matchHeight();});</script>
<script>wurfl.addEventListener('load',function(){if(!WURFL.is_mobile){var s=document.createElement("script");s.src="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/js/retina.min.js', false); ?>",document.getElementsByTagName("body")[0].appendChild(s)}});</script>
</body>
</html><?php
ob_end_flush(); ?>
