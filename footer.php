<footer>
	<div class="footer boxshadow">
		<div class="container">
			<div class="footer-wrapper">
				<div class="row">
				<div class="col-md-2 col-sm-2 footer-col footer-logo-col">
					<img src="<?php echo get_upload_url('https://raw.githubusercontent.com/stt-systems/assets/main/logos/logo-footer.png', false); ?>" class="footer-logo" height="171" alt="STT's logo"/>
				</div>
				<div class="col-md-2 col-sm-3 footer-col">
					<div class="footer-title"><?php echo get_page_full_link('contact-us', 'Contact', 'page', !is_front_page() ? 'nofollow' : ''); ?></div>
					<div class="textwidget tight-paragraphs">
						<p><?php _e("Phone:", "default") ?><?php echo get_phone_link(''); ?></p>
						<p><?php _e("Fax: +34 943 31 64 31", "default")?></p>
						<p><?php echo get_email_link(''); ?></p>
						<p><?php _e("Zuatzu Business Park", "default")?></p>
						<p><?php _e("Easo Building, 2nd Floor", "default")?></p>
						<p><?php _e("20018 San Sebasti&aacute;n, Spain", "default")?></p>
					</div>
				</div>
				<div class="col-md-1 col-sm-1 footer-col ghost"></div>
				<div class="col-md-4 col-sm-6 footer-col">
					<div class="footer-title"><?php _e("Featured Pages", "default")?></div>
					<div id='textwidgetPaddinLeft' class="textwidget">
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
								echo '<p>' . get_page_full_link('cycling-2dma') . '</p>'; ?>
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
								echo '<p>' . get_page_full_link('contact-support', 'Support') . '</p>';
								echo '<p>' . get_page_full_link('downloads', 'Downloads') . '</p>'; ?>
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
					<div class="col-md-2 col-sm-3 col-xs-6 footerMarginBottom">
						<div class="copyright-text">
							&copy; <?php echo date('Y'); ?> STT Systems
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 footerMarginBottom">
						<div class="copyright-text">
							<?php echo get_page_full_link('privacy-policy', 'Privacy Policy', 'page', !is_front_page() ? 'nofollow' : ''); ?>
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 footerMarginBottom">
						<div class="copyright-text">
							<?php echo get_page_full_link('cookies-policy', 'Cookies Policy', 'page', !is_front_page() ? 'nofollow' : ''); ?>
						</div>
					</div>
					<div class="col-md-2 col-sm-3 col-xs-6 footerMarginBottom">
						<div class="copyright-text">
							<?php echo get_page_full_link('credits', 'Credits', 'page', !is_front_page() ? 'nofollow' : ''); ?>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12"> 
						<div class="social-icons">
							<ul>
								<li><a href="https://www.instagram.com/stt.systems" title="Instagram" target="_blank" class="social-media-icon instagram-icon"></a></li>
								<li><a href="https://www.linkedin.com/company/stt-systems" title="LinkedIn" target="_blank" class="social-media-icon linkedin-icon"></a></li>
								<li><a href="https://www.youtube.com/user/SttSystems" title="Youtube" target="_blank" class="social-media-icon youtube-icon"></a></li>
								<li><a href="https://www.facebook.com/STTSystems" title="Facebook" target="_blank" class="social-media-icon facebook-icon"></a></li>
								<li><a href="https://twitter.com/sttsystems" title="Twitter" target="_blank" class="social-media-icon twitter-icon"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</footer>
<nav id="contacto-permanente">
	<div class="position-relative" id="izqTel">
		<a href="tel:+34943317777" class="stretched-link">
			<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-alt" class="svg-inline--fa fa-phone-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
				<path fill="currentColor" d="M497.39 361.8l-112-48a24 24 0 0 0-28 6.9l-49.6 60.6A370.66 370.66 0 0 1 130.6 204.11l60.6-49.6a23.94 23.94 0 0 0 6.9-28l-48-112A24.16 24.16 0 0 0 122.6.61l-104 24A24 24 0 0 0 0 48c0 256.5 207.9 464 464 464a24 24 0 0 0 23.4-18.6l24-104a24.29 24.29 0 0 0-14.01-27.6z"></path>
			</svg>
				<span class="d-none d-sm-block"><?php _e("Llámanos", "default")?></span>
		</a>
	</div>
	<div class="position-relative" id="derechaCont">
		<a href="#" class="stretched-link" data-toggle="modal" data-target="#exampleModal">
			<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="comment-dots" class="svg-inline--fa fa-comment-dots fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
				<path fill="currentColor" d="M256 32C114.6 32 0 125.1 0 240c0 49.6 21.4 95 57 130.7C44.5 421.1 2.7 466 2.2 466.5c-2.2 2.3-2.8 5.7-1.5 8.7S4.8 480 8 480c66.3 0 116-31.8 140.6-51.4 32.7 12.3 69 19.4 107.4 19.4 141.4 0 256-93.1 256-208S397.4 32 256 32zM128 272c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32zm128 0c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"></path>
			</svg>
			<span class="d-none d-sm-block"><?php _e("Contactar", "default")?></span>
		</a>
	</div>
</nav>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo do_shortcode('[wpforms id="5586"]'); ?>
      </div>
    </div>
  </div>
</div>
<?php wp_footer(); ?>

<script>window.addEventListener('load',function(){$('.banner').each(function(){var l=$(this);l.css('background-image','url("'+l.attr('data-src')+'")');l.find('img.spinner').remove();});});</script>
<script>window.addEventListener('load',function(){if($('.col-extra').length)$('.col-extra').matchHeight();});</script>

<link rel="stylesheet" property="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,300i,400,400i" crossorigin="anonymous"/>
<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/theme-menu.min.css', false); ?>"/>
<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/responsive.min.css', false); ?>"/>
<link rel="stylesheet" property="stylesheet" href="//use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous"/>
</body>
</html><?php
ob_end_flush(); ?>
