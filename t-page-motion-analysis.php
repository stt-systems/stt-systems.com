<?php
  /**
    * Template Name: Motions-Analysis
  */
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
          <h1><?php _e("2DMA", "default")?></h1>
          <h3><?php _e("Video-based motion analysis systems", "default")?></h3>
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
          <h3><?php _e("Comprehensive solutions for full-body 3D motion analysis", "default")?></h3>
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
          <h1><?php _e("Inertial", "default")?></h1>
          <h3><?php _e("Flexible IMU configurations for full-body kinematic analysis", "default")?></h3>
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
?>
<div class="container" id="seccion2-home" style="display: none;">
  <div class="row">
    <h2 class="text-center">Greatest motion analysis solutions</h2>
    <div class="col-md-6 col-sm-12 text-center"> 
      <noscript>
        <img src="/wp-content/uploads/golf-motion-analysis.jpg" alt="Golf motion analysis">
      </noscript>
      <img class=" ls-is-cached lazyloaded" src="/wp-content/uploads/yeyo_ppal.jpg" data-src="/wp-content/uploads/yeyo_ppal.jpg" alt="Geatest motion analysis solutions.">
    </div>
    <div class="col-md-6 col-sm-12">
      <p>Since the creation of our first motion capture product, we began to accumulate <strong>extensive experience in optical motion capture</strong>. We would soon learn to integrate cameras from various manufacturers, to calibrate them, and to synthesize clean and accurate 3D points based on passive or active marker tracking. Thanks to our careful software design and constant interaction with end users, <strong>we were able to offer innovative products in the field of biomechanics.</strong></p>
      <p>Most of our activity is focused on the development of <strong>3d motion capture</strong> systems for sport and human studies. We create advanced systems to facilitate <strong>running, cycling or golf motion analysis</strong>. In 2010 a new technology was incorporated to our product range: Inertial sensors or IMUs. At that point, <strong>STT was the only company in the world offering off-the-shelf packages both for ‘optical’ and ‘inertial’ motion tracking & analysis.</strong></p>
      <p></p>
    </div>
  </div>
</div>
<?php
  get_footer(); 
?>