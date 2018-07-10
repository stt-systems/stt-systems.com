<?php
add_action('wp_head', 'schema_head');
get_header();
?>

<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/front-page.min.css'); ?>" />

<div>
	<div class="row" style="display: table">
    <div class="col-md-6 col-sm-6 panel">
      <div class="cold-md-3 col-sm-3"></div>
      <div class="col-md-6 col-sm-6">
        <div class="content-box">
          <h1>Motion Analysis Solutions</h1>
          <h3>Premium technologies for human motion studies. Ready to use by scientists, sports scientists and clinitians</h3>
        </div>
      </div>
      <div class="cold-md-3 col-sm-3"></div>
    </div>
    <div class="col-md-6 col-sm-6 panel">
      <div class="cold-md-3 col-sm-3"></div>
      <div class="col-md-6 col-sm-6">
        <div class="content-box">
          <h1>Industry 4.0</h1>
          <h3>Turn-key solutions for companies seeking smart and automated manufacturing &amp; monitoring processes</h3>
        </div>
      </div>
      <div class="cold-md-3 col-sm-3"></div>
    </div>
  </div>
</div>

<?php get_footer(); ?>