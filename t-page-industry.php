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
<div class="container" id="seccion2-home" style="display: none;">
  <div class="row">
    <h2 class="text-center">Industry 4.0</h2>
    <div class="col-md-6 col-sm-12 text-center"> 
      <noscript>
        <img  src="/wp-content/uploads/machine-vision.JPG" alt="Railway Motion Analysis example">
      </noscript>
      <img id="masAltura" class=" ls-is-cached lazyloaded" src="/wp-content/uploads/machine-vision.JPG" data-src="/wp-content/uploads/machine-vision.JPG" alt="Railway Motion Analysis example">
    </div>
    <div class="col-md-6 col-sm-12">
      <p><strong>Machine vision</strong> is the technology and methods used to provide automated inspection and analysis. At STT we have been developing our own resources and technologies based on <strong>image processing</strong> for years. We have a <strong>great project career and important clients</strong> in many diverse sectors, such as <strong>automotive</strong>, <strong>railway</strong>, <strong>robotics and automation</strong>, <strong>home appliances</strong>, <strong>packaging</strong>, <strong>paper</strong>, and more. Our machine vision solutions use the best technologies and algorithms, developed by our own team of <strong>engineers backed by years of experience</strong>.</p>
      <p>Our <strong>product configurations</strong> allow companies to interactively define all the variants of a certain product. We develop a <strong>completely customized software</strong> based on the requests and needs of the company. These solutions are <strong>particularly useful</strong> for those products or applications where dimensions, materials and other characteristics change significantly depending on the details of the order.</p>
    </div>
  </div>
</div>

<?php get_footer(); ?>