<?php
function sanitize_output($buffer) {
  $search = array(
  // Uglify HTML
	'/\>[^\S ]+/s' => '>',  // strip white spaces after tags, except space
	'/[^\S ]+\</s' => '<',  // strip white spaces before tags, except space
	'/\>[ ]+/s'    => '> ', // strip multiple spaces after tags
	'/[ ]+\</s'    => ' <',   // strip multiple spaces before tags
	'/ [ ]+/'      => ' ',
  // Remove unnecesary breaks
	'#(</div>)<br[ /]*>#' => '$1',
	'#<br[ /]*>(<div)#'   => '$1',
  '#<p>(<div)#'         => '$1',
  '#(</div>)</p>#'      => '$1',
  // everything below this point will be just deleted
  '#<p>\s*+(<br\s*/*>)?\s*</p>#i' => '',
	'~\s?<p>(\s|&nbsp;)+</p>\s?~'   => '',
	'/[\t]+/s'                      => '',
	'#\<br[ /]*\>#'                 => '',
  );

  return preg_replace(array_keys($search), array_values($search), $buffer);
}
ob_start("sanitize_output");
?>

<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<!--[if lt IE 10]><script>document.location="<?php echo get_site_url() . '/ie.html'; ?>";</script><![endif]--><?php
	wp_head();
	print_meta(); ?>

	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<?php if (!is_404() and !isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false):?>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-40441442-1"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)};gtag('js',new Date());gtag('config','UA-40441442-1');</script>
	<script>(function(a,e,c,f,g,h,b,d){var k={ak:"1013095491",cl:"BuU3CIrCv3cQw7iK4wM",autoreplace:"(+34) 943 31 77 77"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[g]||(a[g]=k.ak);b=e.createElement(h);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(h)[0];d.parentNode.insertBefore(b,d);a[f]=function(b,d,e){a[c](2,b,k,d,null,new Date,e)};a[f]()})(window,document,"_googWcmImpl","_googWcmGet","_googWcmAk","script");</script>
	<?php endif; ?>
</head>
<body <?php body_class(); ?> >
<?php if (!is_front_page()) { ?>
<div class="menu_wrapper top_wrapper">
	<div class="row">
		<nav class="navbar navbar-default" style="background:#f2f2f3">
			<div class="container-fluid">
				<div class="col-sm-12 col-md-3">
					<div class="navbar-left-header" id="navbar-left-header">
						<a href="<?php echo home_url('/'); ?>"><img src="<?php echo my_get_image_url('logos/logo.png', false); ?>" height="78" alt="STT's logo" rel="nofollow" style="margin-top:5px"/></a>
					</div>
					<button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#stt-navbar-collapse">
						<span class="sr-only"><?php _e('Toggle navigation', 'stt'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="collapse navbar-collapse" id="stt-navbar-collapse"><?php
						wp_nav_menu(array(
							'theme_location' => 'primary',
							'container'      => 'nav-collapse',
							'menu_class'     => 'nav navbar-nav navbar-left',
							'walker'         => new wp_bootstrap_navwalker())
						); ?>
					</div>
				</div>
				<div class="col-sm-12 col-md-3">
					<div class="image-text"><?php
					$area = get_top_level_slug();
					$area_url = home_url("/$area/");
					$area_logo = my_get_image_url("logos/$area.png", false);
					$area_name = "Motion Analysis Solutions";
					if ($area == 'industry') {
						$area_name = "Industry 4.0 Projects";
					}
					echo "<a href=\"$area_url\">";
					echo "<img src=\"$area_logo\" height=\"60\" alt=\"Area logo\" rel=\"nofollow\"/>";
					echo "<p>$area_name</p>"; ?>
					</a></div>
				</div>
			</div>
		</nav>
	</div>
</div>
<?php } ?>