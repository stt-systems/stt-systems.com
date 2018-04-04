<?php //Template Name:Contact
get_header();
print_page_title();

function print_social_img($name) {
	$url = WL_TEMPLATE_DIR_URI . '/images/social-media/' . $name . '.png';
	
	echo '<img src="' . $url . '" width="32" height="32" alt="' . $name . '" />';
}
?>
<div class="space-sep20"></div>
<div class="content-wrapper body-wrapper blog-post blog-span container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php add_page_path(); ?>
		</div>
	</div>
	<div class="space-sep20"></div>
	<div class="row">
		<div class="blog-post-body">
			<div class="col-md-4 col-sm-4">
				<b>STT Systems</b><br>
				Zuatzu Business Park<br>
				Easo Building, 2nd Floor<br>
				20018 San Sebastian, Spain<br>
			</div>
			<div class="col-md-4 col-sm-4">
				<br>
				Phone: (+34) 943 31 77 77<br>
				Fax: (+34) 943 31 64 31<br>
				<a href="mailto:info@stt-systems.com">info@stt-systems.com</a><br>
				<!-- Social icons by Martz: http://martz90.deviantart.com/art/Circle-Icons-Pack-371172325 -->
				<div class="contact-social">
					<a href="https://www.facebook.com/STTSystems" title="Facebook" target="_blank"><?php print_social_img('facebook'); ?></a>
					<a href="https://twitter.com/sttsystems" title="Twitter" target="_blank"><?php print_social_img('twitter'); ?></a>
					<a href="https://www.linkedin.com/company/stt-systems" title="LinkedIn" target="_blank"><?php print_social_img('linkedin'); ?></a>
					<a href="https://www.youtube.com/user/SttSystems" title="Youtube" target="_blank"><?php print_social_img('youtube'); ?></a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4">
				<img src="<?php echo my_get_image_url('single/stt_building_1_sm.jpg'); ?>" class="boxshadow" alt="STT's building"/>
			</div>
		</div>
	</div>
</div>
<div class="space-sep20"></div>
<div class="map-overlay" onClick="style.pointerEvents='none'"></div>
<iframe class="boxshadow" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11899828.893803455!2d-0.04826216972901577!3d43.267522259849265!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd51b06b579c8b15%3A0x2ad284836fa91c7!2sStt+Ingenier%C3%ADa+y+Sistemas+S.L.!5e0!3m2!1ses!2s!4v1422375720004" height="450" style="display:block;width:100%"></iframe>
<?php get_footer(); ?>