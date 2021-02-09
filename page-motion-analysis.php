<?php
add_action('wp_head', 'schema_head');
get_header();
wp_enqueue_style('front-page');
wp_enqueue_script('product-hovering');
?>

<div class="container-fluid front-page area-motion-analysis">
<div class="row">
  <div id="panel-2dma" class="col-md-4 col-xs-12 panel">
    <div class="col-md-2"></div>
    <div class="col-md-8 col-sm-12">
      <a href="<?php echo get_page_permalink("2d-optical-motion-capture"); ?>">
        <h1>2DMA</h1>
        <h3>Video-based motion analysis systems</h3>
      </a>
      <div id="2dma-products" class="product-links"><?php
        echo get_product_icon_link('cycling-2dma');
      ?></div>
      <div id="current-2dma-product" class="product-name"></div>
    </div>
    <div class="col-md-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/2dma.jpg", 0);?>"></div>
  </div>
  <div id="panel-3dma" class="col-md-4 col-xs-12 panel">
    <div class="col-md-2"></div>
    <div class="col-md-8 col-sm-12">
      <a href="<?php echo get_page_permalink("3d-optical-motion-capture"); ?>">
        <h1>3DMA</h1>
        <h3>Comprehensive solutions for full-body 3D motion analysis</h3>
      </a>
      <div id="3dma-products" class="product-links"><?php
        echo get_product_icon_link('sports-3dma');
        echo get_product_icon_link('cycling-3dma');
        echo get_product_icon_link('golf-3dma');
        echo get_product_icon_link('running-3dma');
        echo get_product_icon_link('clinical-3dma');
        echo get_product_icon_link('human-3dma');
        echo get_product_icon_link('eddo');
      ?></div>
      <div id="current-3dma-product" class="product-name"></div>
    </div>
    <div class="col-md-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/3dma.jpg", 0);?>"></div>
  </div>
  <div id="panel-inertial" class="col-md-4 col-xs-12 panel">
    <div class="col-md-2"></div>
    <div class="col-md-8 col-sm-12">
      <a href="<?php echo get_page_permalink("inertial-motion-capture"); ?>">
        <h1>Inertial</h1>
        <h3>Flexible IMU configurations for full-body kinematic analysis</h3>
      </a>
      <div id="inertial-products" class="product-links"><?php
        echo get_product_icon_link('isen');
      ?></div>
      <div id="current-inertial-product" class="product-name"></div>
    </div>
    <div class="col-md-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("https://raw.githubusercontent.com/stt-systems/assets/main/web-backgrounds/inertial.jpg", 0);?>"></div>
  </div>
</div>
</div>

<?php
echo get_clients_carousel('capture', 8);
get_footer(); ?>
