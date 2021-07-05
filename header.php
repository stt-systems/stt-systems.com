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
		$area_logo = get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/$area.png", false); ?>
		<a class="navbar-brand" id="area-logo" href="<?php echo $area_url; ?>"><img src="<?php echo $area_logo; ?>" alt="Area logo" rel="nofollow"/></a><?php
	}
}

wp_enqueue_script('jquery');
?>

<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>"/>
	<!--[if lt IE 10]><script>document.location="<?php echo get_site_url() . '/ie.html'; ?>";</script><![endif]--><?php
	wp_head();
	print_meta(); ?>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<link rel="stylesheet" id="admin-bar-css" href="https://www.stt-systems.com/wp-content/themes/STT/css/cta-styles.css" media="all">
</head>
<body <?php body_class(); ?> >


<nav id="new-navbar">
        
        <div class="wrapper">
            <div class="logo">
                <a href="https://www.stt-systems.com/"><img src="/wp-content/themes/STT/images/logo-stt.png" alt="STT Systems"></a>
            </div>
            <input type="radio" name="slide" id="menu-btn">
            <input type="radio" name="slide" id="cancel-btn">
            <ul class="nav-links">
                <label for="cancel-btn" class="btn cancel-btn"><img src="/wp-content/themes/STT/images/times-solid.svg" alt="STT Systems"></label>
                <li>
                    <a href="#" class="desktop-item">Motion Analysis</a>
                    <input type="checkbox" id="showMega">
                    <label for="showMega" class="mobile-item">Motion Analysis</label>
                    <div class="mega-box">
                        <div class="content">
                            <div class="row">
                                <header>3D Optical Motion Capture</header>
                                <ul class="mega-links">
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/">3DMA
                                            Suite</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/sports-3dma/">Sports
                                            3DMA</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/cycling-3dma/">Cycling
                                            3DMA</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/golf-3dma/">Golf
                                            3DMA</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/clinical-3dma/">Clinical
                                            3DMA</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/running-3dma/">Running
                                            3DMA</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/human-3dma/">Human
                                            3DMA</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/eddo/">EDDO
                                            Biomechanics</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>2D Optical Motion Capture</header>
                                <ul class="mega-links">
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/2d-optical-motion-capture/">2DMA
                                            Suite</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/2d-optical-motion-capture/cycling-2dma/">Cycling
                                            2DMA</a></li>
                                </ul>
				<img id="img-mega-menu" src="https://www.stt-systems.com/wp-content/uploads/galleries/2dmacustomers/motion-capture-systems-cycling.jpg">
                            </div>
                            <div class="row">
                                <header>Inertial Motion Capture</header>
                                <ul class="mega-links">
                                    <li><a href="https://www.stt-systems.com/motion-analysis/inertial-motion-capture/">Inertial
                                            Suite</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/inertial-motion-capture/isen/">Isen</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Support</header>
                                <ul class="mega-links">
                                    <li><a href="https://www.stt-systems.com/motion-analysis/support/contact-support/">Contact
                                            Support</a></li>
                                    <li><a href="https://www.stt-systems.com/motion-analysis/faq/">FAQ</a></li>
                                    <li><a href="https://www.stt-systems.com/motion-analysis/support/support-plans/">Support
                                            Plans</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header>Downloads</header>
                                <ul class="mega-links">
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/downloads/products/software-downloads/">Software
                                            Downloads</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/downloads/products/product-info/">Brochures</a>
                                    </li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/downloads/marketing-resources/">Marketing
                                            Resources</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/downloads/technical-documents/reference-publications/">Reference
                                            Publications</a></li>
                                    <li><a
                                            href="https://www.stt-systems.com/motion-analysis/downloads/technical-documents/whitepapers/">Whitepapers</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="desktop-item">Industry 4.0</a>
                    <input type="checkbox" id="showDrop1">
                    <label for="showDrop1" class="mobile-item">Industry 4.0</label>
                    <ul class="drop-menu">
                        <li><a href="https://www.stt-systems.com/industry/machine-vision/">Machine Vision</a></li>
                        <li><a href="https://www.stt-systems.com/industry/product-configurators/">Product
                                Configurators</a></li>
                        <li><a href="https://www.stt-systems.com/industry/rdi/">R+D+I</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="desktop-item">About</a>
                    <input type="checkbox" id="showDrop2">
                    <label for="showDrop2" class="mobile-item">About</label>
                    <ul class="drop-menu">
                        <li><a href="https://www.stt-systems.com/contact/about-stt/?menu=motion-analysis">The
                                company</a></li>
                        <li><a href="https://www.stt-systems.com/motion-analysis/distributors/">Distributors</a></li>
                    </ul>
                </li>
                <li><a href="https://www.stt-systems.com/motion-analysis/blog/">Blog</a></li>
                <li>
                    <a href="#" class="desktop-item">Contact</a>
                    <input type="checkbox" id="showDrop3">
                    <label for="showDrop3" class="mobile-item">Contact</label>
                    <ul class="drop-menu">
                        <li><a href="https://www.stt-systems.com/contact/contact-us/">Contact us</a></li>
                        <li><a href="https://www.stt-systems.com/contact/careers/">Careers</a></li>
                    </ul>
                </li>
                <li id="enlace-tienda"><a href="https://store.stt-systems.com" target="_blank">Store</a></li>
                <li id="idiomas">
                    <div>
                        <?php
                            $lang = do_shortcode("[wpml_language_selector_widget]"); 
                            $lang = str_replace('Español', 'Es', $lang);
                            $lang = str_replace('English', 'En', $lang);
                            echo $lang;
                        ?>
                    </div>
                <li>
            </ul>
            <label for="menu-btn" class="btn menu-btn"><img src="/wp-content/themes/STT/images/bars-solid.svg" alt="STT Systems"></label>
        </div>
    </nav>
<!--
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header pull-left"><?php
			if (is_front_page()) { ?>
				<a class="navbar-brand"><?php
			} else { ?>
				<a class="navbar-brand" href="<?php echo home_url('/'); ?>"><?php
			} ?>
				<img src="<?php echo get_upload_url('https://raw.githubusercontent.com/stt-systems/assets/main/logos/logo.png', false); ?>" alt="STT's logo" rel="nofollow"/>
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
</nav>-->
