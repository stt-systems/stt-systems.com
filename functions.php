<?php
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2); 

// Remove emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');

ini_set('display_errors', WP_DEBUG);

require('includes/wp_setup.php');
require('includes/globals.php');
require('includes/seo.php');
require('includes/replacers.php');

if (is_user_logged_in()) {
	add_theme_support('woocommerce');
	require('includes/woocommerce.php');
}

/* LINEA IMPORTANTE PARA QUE EL IDIOMA SE VEA BIEN EL MENU */
add_filter( 'walker_nav_menu_start_el', 'htmlspecialchars_decode'); 
do_action('wpml_add_language_selector');

require('includes/wp_navmenu.php'); // for menus
require('includes/tags.php');




// Entradas blog en la home
function entradas_blog()
{
    $args = array(
        'posts_per_page' => 3
    );

    $str = '<div class="row no-gutters"><div class="col-xs-12"><div id="home-noticias-carousel" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
    $posts = get_posts($args);
    $active = true;
    for ($i = 0; $i < count($posts); $i++) {

        $post = $posts[$i];

        $post_cont = apply_filters('the_content', $post->post_content);
        if (strlen($post_cont) > 200) {
            $post_cont_res = substr($post_cont, 0, strpos($post_cont, ' ', 200));
        } else {
            $post_cont_res = $post_cont;
        }

        $str .= '<div class="item';
        if ($active) {
            $str .= ' active';
        }
        $str .= '"><div class="container-fluid px-0"><div class="row no-gutters"><div class="col-lg-8 col-md-8 col-sm-12 home-noticias-foto" style="background-image:';
        if (get_the_post_thumbnail_url($post)) {
            $str .= 'url(' . get_the_post_thumbnail_url($post) . '"></div>';
        } else {
            $str .= 'url("' . get_stylesheet_directory_uri() . '/assets/img/prueba.jpg"></div>';
        }
        $str .= '<div class="col-lg-4 col-md-4 col-sm-12"><div class="home-noticias-resumen">';
        $str .= '<h3><a href="' . get_post_permalink($post) . '">' . apply_filters('the_title', $post->post_title) . '</a></h3>';
        //$str .= '<p>'. apply_filters( 'the_date', $post->post_date ) . '</p>';
        $str .= '<span class="fecha_publicacion_home">Publicada el ' . date('j-n-Y', strtotime($post->post_date)) . '</span>';
        if ($post_cont_res) {
            $str .= '<p>' . strip_tags($post_cont_res) . '...</p>';
        }
        $str .= '<p><a class="btn btn-outline-dark" href="' . get_post_permalink($post) . '">Leer más</a></p>';
        $str .= '</div></div></div>';

        $str .= '</div>';
        $str .= '</div>';
        $active = false;
    }
    $str .= '</div>';
    $str .= '<a class="left carousel-control" href="#home-noticias-carousel"" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#home-noticias-carousel"" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>';
    $str .= '<ol class="carousel-indicators">
  <li data-target="#home-noticias-carousel" data-slide-to="0" class="active"></li>
  <li data-target="#home-noticias-carousel" data-slide-to="1"></li>
  <li data-target="#home-noticias-carousel" data-slide-to="2"></li>
</ol>';
    $str .= '</div></div></div>';
    return $str;
}



//Aside para tienda
add_action('widgets_init','sidebar_shop_widgets_init');

function sidebar_shop_widgets_init(){
    $args = array(
        'name'          => 'Menu Top' ,
        'id'            => 'top-menu',
        'description'   => 'Add widgets here.',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>');
        register_sidebar($args);
}
