<?php
function sanitize_output($buffer)
{
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

function get_areas()
{
    return array(
        '' => 'STT Systems',
        'motion-analysis' => __('Motion Analysis', 'stt'),
        'industry' => __('Industry', 'stt'),
    );
}

function print_area_name()
{
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

function print_area_logo()
{
    $area = get_top_level_slug();
    if ($area != '' && array_key_exists($area, get_areas())) {
        $area_url = home_url("/$area/");
        $area_logo = get_upload_url("https://raw.githubusercontent.com/stt-systems/assets/main/logos/$area.png", false); ?>
        <a class="navbar-brand" id="area-logo" href="<?php echo $area_url; ?>"><img src="<?php echo $area_logo; ?>" alt="Area logo" rel="nofollow" /></a><?php
                                                                                                                                                        }
                                                                                                                                                    }

                                                                                                                                                    wp_enqueue_script('jquery');
                                                                                                                                                            ?>

<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <!--[if lt IE 10]><script>document.location="<?php echo get_site_url() . '/ie.html'; ?>";</script><![endif]--><?php
                                                                                                                    wp_head();
                                                                                                                    /* print_meta();  */ ?>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="stylesheet" id="admin-bar-css" href="https://www.stt-systems.com/wp-content/themes/STT/css/cta-styles.css" media="all">
</head>

<body <?php body_class(); ?>>


    <nav id="new-navbar">

        <div class="wrapper">
            <div class="logo">
                <a href=<?php _e("https://www.stt-systems.com/", "default") ?>><img src="/wp-content/themes/STT/images/logo-stt.png" alt="STT Systems"></a>
            </div>
            <input type="radio" name="slide" id="menu-btn">
            <input type="radio" name="slide" id="cancel-btn">
            <ul class="nav-links">
                <label for="cancel-btn" class="btn cancel-btn"><img src="/wp-content/themes/STT/images/times-solid.svg" alt="STT Systems"></label>
                <li>
                    <a href="#" class="desktop-item"><?php _e("Motion Analysis", "default") ?></a>
                    <input type="checkbox" id="showMega">
                    <label for="showMega" class="mobile-item"><?php _e("Motion Analysis", "default") ?></label>
                    <div class="mega-box">
                        <div class="content">
                            <div class="row">
                                <header><?php _e("3D Optical Motion Capture", "default") ?></header>
                                <ul class="mega-links">
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/", "default") ?>>3DMA Suite</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/sports-3dma/", "default") ?>>Sports 3DMA</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/cycling-3dma/", "default") ?>>Cycling 3DMA</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/golf-3dma/", "default") ?>>Golf 3DMA</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/clinical-3dma/", "default") ?>>Clinical 3DMA</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/running-3dma/", "default") ?>>Running 3DMA</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/human-3dma/", "default") ?>>Human 3DMA</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/3d-optical-motion-capture/eddo/", "default") ?>>EDDO Biomechanics</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header><?php _e("2D Optical Motion Capture", "default") ?></header>
                                <ul class="mega-links">
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/2d-optical-motion-capture/", "default") ?>>2DMA Suite</a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/2d-optical-motion-capture/cycling-2dma/", "default") ?>>Cycling 2DMA</a></li>
                                </ul>
                            </div>
                            <div class="row">
                                <header><?php _e("Inertial Motion Capture", "default") ?></header>
                                <ul class="mega-links" id="links-inertial">
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/inertial-motion-capture/", "default") ?>><?php _e("Inertial Suite", "default") ?></a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/inertial-motion-capture/isen/", "default") ?>><?php _e("Isen", "default") ?></a></li>
                                </ul>
                                <header><?php _e("Support", "default") ?></header>
                                <ul class="mega-links">
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/support/contact-support/", "default") ?>><?php _e("Contact Support", "default") ?></a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/faq/", "default") ?>><?php _e("FAQ", "default") ?></a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/support/support-plans/", "default") ?>><?php _e("Support Plans", "default") ?></a></li>
                                </ul>
                            </div>

                            <div class="row">
                                <header><?php _e("Downloads", "default") ?></header>
                                <ul class="mega-links">
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/downloads/products/software-downloads/", "default") ?>><?php _e("Software Downloads", "default") ?></a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/downloads/products/product-info/", "default") ?>><?php _e("Brochures and sample Reports", "default")?></a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/downloads/marketing-resources/", "default") ?>><?php _e("Marketing Resources", "default")?></a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/downloads/technical-documents/reference-publications/", "default") ?>><?php _e("Reference Publications", "default")?></a></li>
                                    <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/downloads/technical-documents/whitepapers/", "default") ?>><?php _e("Whitepapers", "default")?></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="desktop-item"><?php _e("Industry 4.0", "default") ?></a>
                    <input type="checkbox" id="showDrop1">
                    <label for="showDrop1" class="mobile-item"><?php _e("Industry 4.0", "default") ?></label>
                    <ul class="drop-menu">
                        <li><a href=<?php _e("https://www.stt-systems.com/industry/machine-vision/", "default") ?>><?php _e("Machine Vision", "default") ?></a></li>
                        <li><a href=<?php _e("https://www.stt-systems.com/industry/product-configurators/", "default") ?>><?php _e("Product Configurators", "default") ?></a></li>
                        <li><a href=<?php _e("https://www.stt-systems.com/industry/rdi/", "default") ?>><?php _e("R+D+I", "default")?></a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="desktop-item"><?php _e("About", "default") ?></a>
                    <input type="checkbox" id="showDrop2">
                    <label for="showDrop2" class="mobile-item"><?php _e("About", "default") ?></label>
                    <ul class="drop-menu">
                        <li><a href=<?php _e("https://www.stt-systems.com/contact-us/about-stt/", "default") ?>><?php _e("The company", "default") ?></a></li>
                        <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/distributors/", "default") ?>><?php _e("Distributors", "default") ?></a></li>
                    </ul>
                </li>
                <li><a href=<?php _e("https://www.stt-systems.com/motion-analysis/blog/", "default") ?>><?php _e("Blog", "default")?></a></li>
                <li>
                    <a href="#" class="desktop-item"><?php _e("Contact", "default") ?></a>
                    <input type="checkbox" id="showDrop3">
                    <label for="showDrop3" class="mobile-item"><?php _e("Contact", "default") ?></label>
                    <ul class="drop-menu">
                        <li><a href=<?php _e("https://www.stt-systems.com/contact-us/", "default") ?>><?php _e("Contact us", "default") ?></a></li>
                        <li><a href=<?php _e("https://www.stt-systems.com/contact-us/careers/", "default") ?>>Careers</a></li>
                    </ul>
                </li>
                <li id="enlace-tienda"><a href=<?php _e("https://store.stt-systems.com/es/shop", "default") ?> target="_blank"><?php _e("Store", "default") ?></a></li>
                <li id="idiomas">
                    <div>
                        <?php
                        $lang = do_shortcode("[wpml_language_selector_widget]");
                        $lang = str_replace('Español', 'Es', $lang);
                        $lang = str_replace('English', 'En', $lang);
                        echo $lang;
                        ?>
                    </div>
                </li>
                <li id="searchbtn">
                    <i class="fas fa-search"></i>
                </li>
                <li id="searchbar">
                    <div class="sidebar-content tags blog-search">
                        <form method="get" id="searchform" class="searchNavBar" action="https://www.stt-systems.com">
                            <input type="text" class="blog-search-input text-input barraBusqueda" name="s" id="s" placeholder="Search…">
                            <button class="blog-search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <button id="searchclose" class="blog-search-button">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </li>
            </ul>
            <label for="menu-btn" class="btn menu-btn"><img src="/wp-content/themes/STT/images/bars-solid.svg" alt="STT Systems"></label>
        </div>
    </nav>
