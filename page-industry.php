<?php
add_action('wp_head', 'schema_head');
get_header();
wp_enqueue_style('front-page', get_template_directory_uri() . '/css/front-page.min.css');
?>

<div class="row" style="display: table; height: 80vh; width: 100%; margin: 0; padding: 0">
  <div class="col-md-6 col-sm-6 panel">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <a href="<?php echo get_page_permalink("machine-vision"); ?>">
        <h1>Machine vision</h1>
        <h3>Video-based mocap systems</h3>
      </a>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    <div class="panel-bg" style="background-image: <?php echo css_darken_image("backgrounds/machine-vision.jpg");?>"></div>
  </div>
  <div class="col-md-6 col-sm-6 panel">
    <div class="col-md-2 col-sm-2"></div>
    <div class="col-md-8 col-sm-8">
      <a href="<?php echo get_page_permalink("product-configurators"); ?>">
        <h1>Product configurators</h1>
        <h3>Premium IMU sensors and software</h3>
      </a>
    </div>
    <div class="col-md-2 col-sm-2"></div>
    <div class="panel-bg" style="background-image: <?php echo css_darken_image("backgrounds/product-configurators.jpg");?>"></div>
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

<script>
$(document).ready(function() {
  $('#2dma-products .product').hover(function() {
    $('#current-2dma-product').text($(this).text())
  }, function() {
    $('#current-2dma-product').text('');    
  });
  $('#3dma-products .product').hover(function() {
    $('#current-3dma-product').text($(this).text())
  }, function() {
    $('#current-3dma-product').text('');    
  });
  $('#inertial-products .product').hover(function() {
    $('#current-inertial-product').text($(this).text())
  }, function() {
    $('#current-inertial-product').text('');    
  });
});
</script>

<?php get_footer(); ?>