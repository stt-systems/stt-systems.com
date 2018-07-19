<?php
add_action('wp_head', 'schema_head');
get_header();
?>

<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/front-page.min.css'); ?>" />

<div class="row" style="display: table; height: 80vh; width: 100%; margin: 0; padding: 0">
  <div class="col-md-4 col-sm-4 panel">
    <a href="<?php echo get_page_permalink("cycling-3dma"); ?>">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <div class="content-box">
        <h1>3DMA</h1>
        <h3>Comprehensive solutions for 3D motion analysis</h3>
      </div>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    </a>
    <div class="panel-bg" style="background-image: <?php echo css_darken_image("3dma-background.jpg");?>"></div>
  </div>
  <div class="col-md-4 col-sm-4 panel">
    <a href="<?php echo get_page_permalink("2d-optical-motion-capture"); ?>">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <div class="content-box">
        <h1>2DMA</h1>
        <h3>Video-based mocap systems</h3>
      </div>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    </a>
    <div class="panel-bg" style="background-image: <?php echo css_darken_image("2dma-background.jpg");?>"></div>
  </div>
  <div class="col-md-4 col-sm-4 panel">
    <a href="<?php echo get_page_permalink("inertial-motion-capture"); ?>">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <div class="content-box">
        <h1>Inertial</h1>
        <h3>Premium IMU sensors and software</h3>
      </div>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    </a>
    <div class="panel-bg" style="background-image: <?php echo css_darken_image("inertial-background.jpg");?>"></div>
  </div>
</div>

<?php
$clients = get_images('clients');
$n = count($clients); ?>
<div class="container-fluid boxshadow">
<div id="clientsCarousel" class="carousel slide carousel-fade" data-ride="carousel" style="margin-bottom: 0px">
  <div class="carousel-inner" style="background: #565656;"><?php
  $i = 0;
  foreach ($clients as $client) {
    if ($i % 8 == 0) { ?>
      <div class="item<?php if ($i == 0) { echo ' active'; } ?>">
      <div class="row"><?php
    } ?>
    <img src="<?php echo my_get_image_url("clients/$client"); ?>" alt="Client <?php echo $client; ?>"/><?php
    if (($i + 1) % 8 == 0 || $i == $n - 1) { ?>
      </div></div><?php
    }
    ++$i;
  } ?>
  </div>
</div>

<?php get_footer(); ?>