<?php
add_action('wp_head', 'schema_head');
get_header();
wp_enqueue_style('front-page', get_template_directory_uri() . '/css/front-page.min.css');
?>

<div style="height: 80vh">
	<div class="row" style="display: table; height: 100%">
    <div class="col-md-6 col-sm-6 panel">
      <a style="display: block" href="<?php echo get_page_permalink("capture"); ?>">
      <div class="col-md-2 col-sm-2"></div>
      <div class="col-md-8 col-sm-8">
        <div class="content-box">
          <h1>Motion Analysis Solutions</h1>
          <h3>Premium technologies for human motion studies. Ready to use by scientists, sports scientists and clinitians</h3>
        </div>
      </div>
      <div class="col-md-2 col-sm-2"></div>
      </a>
      <div class="panel-bg"></div>
    </div>
    <div class="col-md-6 col-sm-6 panel">
      <a style="display: block" href="<?php echo get_page_permalink("industry"); ?>">
      <div class="col-md-2 col-sm-2"></div>
      <div class="col-md-8 col-sm-8">
        <div class="content-box">
          <h1>Industry 4.0 Projects</h1>
          <h3>Turn-key solutions for companies seeking smart and automated manufacturing &amp; monitoring processes</h3>
        </div>
      </div>
      <div class="col-md-2 col-sm-2"></div>
      </a>
      <div class="panel-bg"></div>
    </div>
  </div>
</div>

<?php get_footer(); ?>