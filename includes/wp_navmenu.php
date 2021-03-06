<?php
function my_wp_nav_menu_args($args = '') {
  $top_level_slug = get_top_level_slug();

	if (is_user_logged_in()) {
		$args['menu'] = "{$top_level_slug}_store";
	} else {
		$args['menu'] = "{$top_level_slug}";
	}
  
  if (!is_nav_menu($args['menu'])) {
    $args['menu'] = "{$top_level_slug}";
  }
  if (is_404() || !is_nav_menu($args['menu'])) {
    $args['menu'] = 'front-page';
  }
  
	return $args;
}
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args');

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
class wp_bootstrap_navwalker extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "<ul role=\"menu\" class=\"dropdown-menu multilevel\">";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$do_not_highlight_current = false;
    if (is_page_valid()) {
			$post = get_post(get_post_meta($item->ID, '_menu_item_object_id', true));
    } else {
      $do_not_highlight_current = true;
    }
		
		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
			$output .= '<li role="presentation" class="divider">';
		} else if (strcasecmp($item->title, 'divider') == 0 && $depth === 1) {
			$output .= '<li role="presentation" class="divider">';
		} else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
			$output .= '<li role="presentation" class="dropdown-header">' . esc_attr($item->title);
		} else if (strcasecmp($item->attr_title, 'disabled') == 0) {
			$output .= '<li role="presentation" class="disabled"><a href="#">' . esc_attr($item->title) . '</a>';
		} else {
			$classes = empty($item->classes) ? array() : (array) $item->classes;
			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
			if ($depth === 0) {
				$class_names .= ' dropdown';
			} else if ($args->has_children) {
				$class_names .= ' dropdown-submenu';
			} else {
				$class_names .= ' dropdown-menuitem';
			}
			
			if ($depth === 0 && $do_not_highlight_current == false) {
				global $wp;
				$url = home_url(add_query_arg(array(), $wp->request));
				$post_url = get_site_url() . '/' . $post->post_name;
				if ($post->post_name != 'motion-analysis' && // avoid highlighting the "Products" menu when navigating other parts of MA
						strpos($url, $post_url) !== false &&
            strpos($class_names, 'current_page_ancestor') === false) { // highlight parent menu
					$class_names .= ' current_page_ancestor';
				}
			}
			
			// Special states
			if ($do_not_highlight_current === true) {
				$class_names = str_replace('current_page_ancestor', '', $class_names);
				$class_names = str_replace('current_page_item', '', $class_names);
				$class_names = str_replace('current-menu-item', '', $class_names);
			} else if (in_array('current-menu-item', $classes)) { // highlight current
				$class_names .= ' active';
			}

			if ($class_names) {
				$output .= '<li class="' . esc_attr(trim($class_names)) . '">';
			} else {
				$output .= '<li>';
			}

			// Convert item properties into element attributes
			$atts = array();
			$atts['target'] = !empty($item->target) ? $item->target : '';
			$atts['rel']    = !empty($item->xfn) ? $item->xfn : '';

 			// Do not link to empty parent pages
			if ($args->has_children) {
				$atts['href'] = '';
			} else {
				$atts['href'] = $item->url;
			}

			// Top level pages
			if ($depth === 0) {
				if ($args->has_children) {
					$atts['class']					= 'dropdown-toggle';
					$atts['aria-haspopup']	= 'true';
					$atts['data-toggle']		= 'dropdown';
				} else if ($do_not_highlight_current === false) {
					$atts['class']					= 'dropdown-top-selected';
				}
			}

			$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

			// Attributes to HTML
			$attributes = '';
			foreach ($atts as $attr => $value) {
				if (!empty($value)) {
					$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
					$attributes .= " $attr=\"$value\"";
				}
			}
			
			// Title
			$title = apply_filters('the_title', $item->title, $item->ID);

			// WooCommerce specifics
			if (strcasecmp($item->title, 'cart') == 0) {
				$title .= get_cart_title();
			} else if (strcasecmp($item->title, 'checkout') == 0) {
				global $woocommerce;
				$cart_contents_count = $woocommerce->cart->cart_contents_count;
				if ($cart_contents_count == 0) return;
			} else if (strcasecmp($item->title, 'cart') == 0) {
				global $woocommerce;
				$cart_url = wc_get_cart_url();
				$cart_contents_count = $woocommerce->cart->cart_contents_count;
				$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
				$cart_total = $woocommerce->cart->get_cart_total();
				// Hide nav menu cart item when there are no items in the cart
				if ( $cart_contents_count > 0 ) {
					$title .= " <i class=\"fa fa-shopping-cart\"></i> $cart_contents - $cart_total";
				}
			}
			$item_output = "{$args->before}<a$attributes>{$args->link_before}$title{$args->link_after}</a>{$args->after}";

			$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
		if (!$element) return;

		$id_field = $this->db_fields['id'];

		// Display this element.
		if (is_object($args[0]))
			 $args[0]->has_children = !empty($children_elements[ $element->$id_field ]);

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}

add_filter('wp_get_nav_menu_items','nav_items', 11, 3);
function nav_items($items, $menu, $args) {
	if ($menu->slug == 'front-page') return $items; // do not modify URLs in front page

	foreach ($items as $item) {
		$transversal_menu = get_post_custom_values('transversal-menu', $item->object_id);
		if ($transversal_menu) {
			$item->url .= '?menu=' . $menu->slug;
		}
	}
	return $items;
}

// Remove unnecessary navbar classses
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current_page_item', 'current_page_ancestor')) : '';
}
