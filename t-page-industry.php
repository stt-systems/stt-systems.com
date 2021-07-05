<?php
  /**
    * Template Name: Industry 4.0
  */
  add_action('wp_head', 'schema_head');
  get_header();
  wp_enqueue_style('front-page');
?>

<div class="container-fluid front-page area-industry">
<div class="row">
  <div class="col-md-6 col-xs-12 panel">
    <div class="col-md-2"></div>
    <div class="col-md-8 col-sm-12">
      <a href="<?php echo get_page_permalink("machine-vision"); ?>">
        <h1><?php _e("Machine vision" ,"default")?></h1>
      </a>
    </div>
    <div class="col-md-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/machine-vision.jpg", 0);?>"></div>
  </div>
  <div class="col-md-6 col-xs-12 panel">
    <div class="col-md-2"></div>
    <div class="col-md-8 col-sm-12">
      <a href="<?php echo get_page_permalink("product-configurators"); ?>">
        <h1><?php _e("Product configurators" ,"default")?></h1>
      </a>
    </div>
    <div class="col-md-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/product-configurators.jpg", 0);?>"></div>
  </div>
</div>
</div>

<?php
echo get_clients_carousel('industry', 8);
?>

<?php get_footer(); ?>