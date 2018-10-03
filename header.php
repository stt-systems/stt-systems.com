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

function print_area_logo() {
	$areas = array(
		'motion-analysis',
		'industry',
	);

	$area = get_top_level_slug();
	if (in_array($area, $areas)) {
		$area_url = home_url("/$area/");
		$area_logo = get_upload_url("logos/$area.png", false); ?>
		<a class="navbar-brand" id="area-logo" href="<?php echo $area_url; ?>"><img src="<?php echo $area_logo; ?>" alt="Area logo" rel="nofollow"/></a><?php
	}
}
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)};gtag('js',new Date());gtag('config','UA-40441442-1');</script>
	<script>(function(a,e,c,f,g,h,b,d){var k={ak:"1013095491",cl:"BuU3CIrCv3cQw7iK4wM",autoreplace:"(+34) 943 31 77 77"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[g]||(a[g]=k.ak);b=e.createElement(h);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(h)[0];d.parentNode.insertBefore(b,d);a[f]=function(b,d,e){a[c](2,b,k,d,null,new Date,e)};a[f]()})(window,document,"_googWcmImpl","_googWcmGet","_googWcmAk","script");</script>
	<?php endif; ?>
</head>
<body <?php body_class(); ?> >
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header pull-left">
			<a class="navbar-brand" href="<?php echo home_url('/'); ?>">
				<img src="<?php echo get_upload_url('logos/logo.png', false); ?>" alt="STT's logo" rel="nofollow"/>
			</a>
		</div>
		<div class="navbar-header pull-right">
			<?php print_area_logo(); ?>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#stt-navbar-collapse" aria-expanded="false">
				<span class="sr-only"><?php _e('Toggle navigation', 'stt'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
		</div>
		<div class="collapse navbar-collapse" id="stt-navbar-collapse"><?php
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'container'      => 'nav-collapse',
				'menu_class'     => 'nav navbar-nav',
				'walker'         => new wp_bootstrap_navwalker())
			); ?>
		</div>
	</div>
</nav>
