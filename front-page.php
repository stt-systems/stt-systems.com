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
          <h3><?php _e("Premium technologies for human motion studies. Ready to use by sports scientists, clinicians and researchers", "default");?></h3>
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
          <h3><?php _e("Turn-key solutions for companies seeking smart and automated manufacturing &amp; monitoring processes", "default");?></h3>
        </div>
      </div>
      <div class="col-md-2"></div>
      </a>
      <div class="panel-bg bottom right" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/industry.jpg", 0);?>"></div>
    </div>
  </div>
</div>
<div class="container" id="seccion2-home">
    <div class="row">
      <h2 class="text-center">20 years creating motion capture systems</h2>
      <div class="col-md-6 col-sm-12 text-center">
        <img src="/wp-content/uploads/golf-motion-analysis.jpg" alt="Golf motion analysis">
      </div>
      <div class="col-md-6 col-sm-12">
        <p>STT systems was created by a group of engineers in 1998 in San Sebastian, with the aim of devising high quality <strong>motion capture technology</strong>. We work on the creation of multiple <strong>motion analysis</strong> products with different objectives, such as clinical studies, sport researchers or biomechanics. These products include both <strong>motion capture software</strong> and hardware, creating ready to be used and complete motion analysis systems.</p>
        <p>More specifically, most of our activity is focused on the development of <strong>3d motion capture</strong> systems for sport and human studies. For example, we create advanced systems to facilitate <strong>running, cycling or golf motion analysis</strong>. In addition to all this, we also create image processing software and hardware for industrial purposes. We invite you to browse our website and discover all these products and services in more depth.</p>
      </div>
    </div>
  </div>
<?php get_footer(); ?>
