<?php
add_action('wp_head', 'schema_head');
get_header();
wp_enqueue_style('front-page', get_template_directory_uri() . '/css/front-page.min.css');
?>

<div class="row" style="display:table;height:100vh;width:100%;margin:0;padding:0">
  <div class="col-md-6 col-sm-6 panel">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <a href="<?php echo get_page_permalink("machine-vision"); ?>">
        <h1 style="margin-bottom: 221px">Machine vision</h1>
      </a>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("backgrounds/machine-vision.jpg", 0);?>"></div>
  </div>
  <div class="col-md-6 col-sm-6 panel">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <a href="<?php echo get_page_permalink("product-configurators"); ?>">
        <h1 style="margin-bottom: 221px">Product configurators</h1>
      </a>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("backgrounds/product-configurators.jpg", 0);?>"></div>
  </div>
</div>

<?php
echo get_clients_carousel('industry', 8);
?>

<?php get_footer(); ?>