<?php
function sanitize_output($buffer) {
  $search = array(
	'/\>[^\S ]+/s', // strip white spaces after tags, except space
	'/[^\S ]+\</s', // strip white spaces before tags, except space
	'/\>[ ]+/s',    // strip multiple spaces after tags
	'/[ ]+\</s',    // strip multiple spaces before tags
	'/[\t]+/s',
	'/ [ ]+/',
	'#(</div>)<br[ /]*>#',
	'#<br[ /]*>(<div)#',
  '#<p>\s*+(<br\s*/*>)?\s*</p>#i',
	'~\s?<p>(\s|&nbsp;)+</p>\s?~'
  );

  $replace = array(
	'>',
	'<',
	'> ',
	' <',
	'',
	' ',
	'$1',
	'$1',
	'',
	''
  );

  return preg_replace($search, $replace, $buffer);
}
ob_start("sanitize_output");

wp_enqueue_style('style', get_stylesheet_uri());
//wp_enqueue_style('gallery', my_get_url_for_path(WL_TEMPLATE_LOCAL_DIR . '/css/blueimp-gallery.min.css', false));
wp_enqueue_style('bootstrap', 'https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css');

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
	<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments)};gtag('js',new Date());gtag('config','UA-40441442-1');</script>
	<script>(function(a,e,c,f,g,h,b,d){var k={ak:"1013095491",cl:"BuU3CIrCv3cQw7iK4wM",autoreplace:"(+34) 943 31 77 77"};a[c]=a[c]||function(){(a[c].q=a[c].q||[]).push(arguments)};a[g]||(a[g]=k.ak);b=e.createElement(h);b.async=1;b.src="//www.gstatic.com/wcm/loader.js";d=e.getElementsByTagName(h)[0];d.parentNode.insertBefore(b,d);a[f]=function(b,d,e){a[c](2,b,k,d,null,new Date,e)};a[f]()})(window,document,"_googWcmImpl","_googWcmGet","_googWcmAk","script");</script>
	<?php endif; ?>
</head>
<body <?php body_class(); ?> >
<?php if (!is_front_page()) { ?>
<div class="menu_wrapper top_wrapper">
	<div class="row">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="col-sm-12 col-md-3">
					<div class="navbar-header" id="navbar-header">
						<div class="logo pull-left">
						<a href="<?php echo home_url('/'); ?>"><img src="<?php echo my_get_image_url('logo/logo.png', false); ?>" height="86" alt="STT's logo" rel="nofollow"/></a>
						</div>
					</div>
					<button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#stt-navbar-collapse">
						<span class="sr-only"><?php _e('Toggle navigation','weblizar'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="col-sm-12 col-md-9">
					<div class="collapse navbar-collapse" id="stt-navbar-collapse"><?php
						wp_nav_menu(array(
							'theme_location' => 'primary',
							'container'      => 'nav-collapse',
							'menu_class'     => 'nav navbar-nav navbar-left',
							'walker'         => new wp_bootstrap_navwalker())
						); ?>
					</div>
				</div>
			</div>
		</nav>
	</div>
</div>
<?php } ?>