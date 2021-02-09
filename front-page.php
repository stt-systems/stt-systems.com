<?php
add_action('wp_head', 'schema_head');
get_header();
wp_enqueue_style('front-page');
?>

<div class="container-fluid front-page main">
	<div class="row">
    <div class="col-md-6 col-xs-12 panel">
      <a style="display:block" href="<?php echo get_page_permalink("motion-analysis"); ?>">
      <div class="col-md-2"></div>
      <div class="col-md-8 col-sm-12">
        <div class="content-box">
          <img src="<?php echo get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/motion-analysis-single.png"); ?>" alt="Motion analysis solution"/>
          <h1>Motion Analysis Solutions</h1>
          <h3>Premium technologies for human motion studies. Ready to use by sports scientists, clinicians and researchers</h3>
        </div>
      </div>
      <div class="col-md-2"></div>
      </a>
      <div class="panel-bg bottom left" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/motion-analysis.jpg", 0);?>"></div>
    </div>
    <div class="col-md-6 col-xs-12 panel">
      <a style="display:block" href="<?php echo get_page_permalink("industry"); ?>">
      <div class="col-md-2"></div>
      <div class="col-md-8 col-sm-12">
        <div class="content-box">
          <img src="<?php echo get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/industry-single.png"); ?>" alt="Industry 4.0"/>
          <h1>Industry 4.0</h1>
          <h3>Turn-key solutions for companies seeking smart and automated manufacturing &amp; monitoring processes</h3>
        </div>
      </div>
      <div class="col-md-2"></div>
      </a>
      <div class="panel-bg bottom right" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/industry.jpg", 0);?>"></div>
    </div>
  </div>
</div>

<?php get_footer(); ?>