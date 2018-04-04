<?php
add_action('wp_head', 'schema_head');
get_header();

$slides_path = ABSPATH . '/images/front-page/slides.txt';
if (file_exists($slides_path)) {
	$fh = fopen($slides_path, 'r');
	$slides = json_decode(fread($fh, filesize($slides_path)), true);
	fclose($fh); ?>
	<div id="homeCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators"> <?php
			$n_slides = count($slides);
			for ($i = 0; $i < $n_slides; ++$i) { ?>
				<li data-target="#homeCarousel" data-slide-to="<?php echo $i; ?>" <?php echo $i == 0 ? ' class="active"' : ''; ?>></li><?php
			} ?>
		</ol>
		<div class="carousel-inner"><?php
			$i = 0;
			foreach ($slides as $slide) { ?>
				<div class="item<?php echo $i == 0 ? ' active' : ''; ++$i; ?> boxshadow">
					<img src="<?php echo my_get_image_url("front-page/{$slide['image']}"); ?>" width="1300" height="400" alt="<?php echo $slide['title']; ?>" />
					<div class="container carousel-caption">
						<h1><?php echo get_page_url($slide['url'], $slide['title']); ?></h1>
						<h2><?php echo get_page_url($slide['url'], $slide['subtitle']); ?></h2>
					</div>
				</div><?php
			}
			unset($slides, $slide); ?>
		</div>
		<a class="left carousel-control" href="#homeCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#homeCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div><?php
} ?>

<div class="content-wrapper body-wrapper container" style="padding-bottom: 30px;">
	<div class="row">
		<div class="col-md-3 col-sm-3">
			<div class="content-box content-style2">
				<div class="glyph-icon flaticon-running30"></div><h4 class="h4-body-title">Motion labs</h4>
				<div class="content-box-text"><?php echo get_page_url('neurology-and-rehab', 'Neurology &amp; rehab'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('sports-analysis'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('cycling-systems'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('biomechanics-and-research', 'Biomechanics &amp; research'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('podiatry'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('human-factors-and-ergonomics', 'Human factors &amp; ergonomics'); ?></div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3">
			<div class="content-box content-style2">
				<div class="glyph-icon flaticon-peephole1"></div><h4 class="h4-body-title">Motion capture</h4>
				<div class="content-box-text"><?php echo get_page_url('character-animation'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('facial-tracking'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('vr-applications'); ?></div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3">
			<div class="content-box content-style2">
				<div class="glyph-icon flaticon-3d76"></div><h4 class="h4-body-title">3D scanning</h4>
				<div class="content-box-text"><?php echo get_page_url('insole-orthotics-manufacturing'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('scanning-shoe-design'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('body-anthropometry'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('custom-scanning'); ?></div>
				<div class="content-box-text"><?php echo get_page_url('industry-applications'); ?></div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3">
			<div class="content-box content-style2">
				<div class="glyph-icon flaticon-view5"></div><h4 class="h4-body-title">Machine vision</h4>
				<div class="content-box-text"><?php echo get_page_url('machine-vision-industrial-projects'); ?></div>
			</div>
		</div>
	</div>
</div><?php

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
</div>

<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/carousel.min.css'); ?>" />
<link rel="stylesheet" property="stylesheet" href="<?php echo my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/fonts/service-icons/flaticon.css'); ?>" />

<?php get_footer(); ?>