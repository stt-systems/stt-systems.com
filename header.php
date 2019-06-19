<?php
function sanitize_output($buffer) {
	$search = array(
  // Uglify HTML
	'/\>[^\S ]+/s' => '>',  // strip white spaces after tags, except space
	'/[^\S ]+\</s' => '<',  // strip white spaces before tags, except space
	'/\>[ ]+/s'    => '> ', // strip multiple spaces after tags
	'/[ ]+\</s'    => ' <', // strip multiple spaces before tags
	'/ [ ]+/'      => ' ',
	'#\s*<p>\s*(<a .*>)?\s*(<img .*/>)\s*(</a>)?\s*</p>\s*#iU' => '$1$2$3', // remove <p> around images
  // Remove unnecesary breaks
	'#(</div>)<br[ /]*>#' => '$1',
	'#<br[ /]*>(<div)#'   => '$1',
  '#<p>\s*(<div)#'      => '$1',
	'#(</div>)\s*</p>#'   => '$1',
	// Remove malformed HTML
	'#(<[a-zA-Z0-9]+>)\s*</p>#' => '$1',
  '#<p>\s*(</[a-zA-Z0-9]+>)#' => '$1',
  // Everything below this point will be just deleted
  '#<p>\s*+(<br\s*/*>)?\s*</p>#i' => '',
	'~\s?<p>(\s|&nbsp;)+</p>\s?~'   => '',
	'/[\t]+/s'                      => '',
	'#\<br[ /]*\>#'                 => '',
  '#<p>\s*</p>#'                  => '',
  );

	return preg_replace(array_keys($search), array_values($search), $buffer);
}
ob_start("sanitize_output");

function get_areas() {
	return array(
		'' => 'STT Systems',
		'motion-analysis' => __('Motion Analysis', 'stt'),
		'industry' => __('Industry', 'stt'),
	);
}

function print_area_name() {
	$areas = get_areas();
	$area = get_top_level_slug();
	if (array_key_exists($area, $areas)) {
		$title = "<h3 class=\"navbar-text hide-desktop\">{$areas[$area]}</h3>";
		global $post;
		if ($area != '' && $area != $post->post_name) {
			echo get_page_full_link($area, $title);
		} else {
			echo $title;
		}
	}
}

function print_area_logo() {
	$area = get_top_level_slug();
	if ($area != '' && array_key_exists($area, get_areas())) {
		$area_url = home_url("/$area/");
		$area_logo = get_upload_url("logos/$area.png", false); ?>
		<a class="navbar-brand" id="area-logo" href="<?php echo $area_url; ?>"><img src="<?php echo $area_logo; ?>" alt="Area logo" rel="nofollow"/></a><?php
	}
}
?>

<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<!--[if lt IE 10]><script>document.location="<?php echo get_site_url() . '/ie.html'; ?>";</script><![endif]--><?php
	wp_head();
	print_meta(); ?>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
</head>
<body <?php body_class(); ?> >
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header pull-left"><?php
			if (is_front_page()) { ?>
				<a class="navbar-brand"><?php
			} else { ?>
				<a class="navbar-brand" href="<?php echo home_url('/'); ?>"><?php
			} ?>
				<img src="<?php echo get_upload_url('logos/logo.png', false); ?>" alt="STT's logo" rel="nofollow"/>
			</a>
		</div>
		<?php print_area_name(); ?>
		<div class="navbar-header pull-right">
			<?php print_area_logo(); ?>
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
				<span class="sr-only"><?php _e('Toggle navigation', 'stt'); ?></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-collapse"><?php
			wp_nav_menu(array(
				'theme_location' => 'primary',
				'container'      => 'nav-collapse',
				'menu_class'     => 'nav navbar-nav',
				'walker'         => new wp_bootstrap_navwalker())
			); ?>
		</div>
	</div>
</nav>
