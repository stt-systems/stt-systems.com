<?php
add_action('wp_head', 'schema_head');
get_header();
wp_enqueue_style('front-page', get_template_directory_uri() . '/css/front-page.min.css');
wp_enqueue_script('product-hovering');
?>

<div class="row" style="display:table;height:100vh;width:100%;margin:0">
  <div class="col-md-4 col-sm-4 panel">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <a href="<?php echo get_page_permalink("2d-optical-motion-capture"); ?>">
        <h1>2DMA</h1>
        <h3 style="height:2em">Video-based motion analysis systems</h3>
      </a>
      <div id="2dma-products" class="product-links"><?php
        echo get_product_icon_link('bikefit', 'cycling');
        echo get_product_icon_link('cycling-2dma', 'cycling');
      ?></div>
      <div id="current-2dma-product" class="product-name"></div>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("backgrounds/2dma.jpg", 0);?>"></div>
  </div>
  <div class="col-md-4 col-sm-4 panel">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <a href="<?php echo get_page_permalink("3d-optical-motion-capture"); ?>">
        <h1>3DMA</h1>
        <h3 style="height:2em">Comprehensive solutions for full-body 3D motion analysis</h3>
      </a>
      <div id="3dma-products" class="product-links"><?php
        echo get_product_icon_link('sports-3dma', 'sports');
        echo get_product_icon_link('cycling-3dma', 'cycling');
        echo get_product_icon_link('golf-3dma', 'golf');
        echo get_product_icon_link('running-3dma', 'running');
        echo get_product_icon_link('clinical-3dma', 'clinical');
        echo get_product_icon_link('human-3dma', 'human');
        echo get_product_icon_link('eddo', 'eddo');
      ?></div>
      <div id="current-3dma-product" class="product-name"></div>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("backgrounds/3dma.jpg", 0);?>"></div>
  </div>
  <div class="col-md-4 col-sm-4 panel">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <a href="<?php echo get_page_permalink("inertial-motion-capture"); ?>">
        <h1>Inertial</h1>
        <h3 style="height:2em">Flexible IMU configurations for full-body kinematic analysis</h3>
      </a>
      <div id="inertial-products" class="product-links"><?php
        echo get_product_icon_link('isen', 'clinical');
        echo get_product_icon_link('stt-iws', 'clinical');
      ?></div>
      <div id="current-inertial-product" class="product-name"></div>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    <div class="panel-bg" style="background-image:<?php echo css_darken_image("backgrounds/inertial.jpg", 0);?>"></div>
  </div>
</div>

<?php
$clients = get_files_in_dir('clients/capture');
$n = count($clients); ?>
<div class="container-fluid">
<div id="clientsCarousel" class="carousel slide carousel-fade" data-ride="carousel" style="margin-bottom:0">
  <div class="carousel-inner" style="background:#fff"><?php
  $i = 0;
  foreach ($clients as $client) {
    if ($i % 8 == 0) { ?>
      <div class="item<?php if ($i == 0) { echo ' active'; } ?>">
      <div class="row"><?php
    } ?>
    <img src="<?php echo get_upload_url("clients/capture/$client"); ?>" alt="Client <?php echo $client; ?>"/><?php
    if (($i + 1) % 8 == 0 || $i == $n - 1) { ?>
      </div></div><?php
    }
    ++$i;
  } ?>
  </div>
</div>
</div>

<?php get_footer(); ?>