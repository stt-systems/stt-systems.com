<?php
add_action('wp_head', 'schema_head');
get_header();
?>

<style>
  h1 {
    font-size: 48px;
    font-weight: 200;
    color: #ffffff;
  }
  .panel {
    float: none;
    display: table-cell;
    vertical-align: middle;
    padding-top: 60px;
    padding-bottom: 70px;
    text-align: center;    
  }
</style>

<div>
	<div class="row" style="display: table">
    <div class="col-md-6 col-sm-6 panel" style="background: #2c73b5">
      <div class="cold-md-3 col-sm-3"></div>
      <div class="col-md-6 col-sm-6">
        <div class="content-box">
          <h1>Motion Analysis Solutions</h1>
          <a>Premium technologies for human motion studies. Ready to use by scientists, sports scientists and clinitians</a>
        </div>
      </div>
      <div class="cold-md-3 col-sm-3"></div>
    </div>
    <div class="col-md-6 col-sm-6 panel" style="background: #164f86">
      <div class="cold-md-3 col-sm-3"></div>
      <div class="col-md-6 col-sm-6">
        <div class="content-box">
          <h1>Industry 4.0</h1>
          <a>Turn-key solutions for companies seeking smart and automated manufacturing &amp; monitoring processes</a>
        </div>
      </div>
      <div class="cold-md-3 col-sm-3"></div>
    </div>
  </div>
</div>

<?php get_footer(); ?>