<?php
if (!class_exists('WooCommerce')) return;

require('woocommerce_shipping.php');

function wc_custom_shop_archive_title($title) {
	if (is_shop() && isset($title['title'])) {
		$title['title'] = 'Store';
	}

	return $title;
}
add_filter('document_title_parts', 'wc_custom_shop_archive_title');

function get_cart_title() {
	global $woocommerce;
	$cart_url = wc_get_cart_url();
	$cart_contents_count = $woocommerce->cart->cart_contents_count;
	$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'your-theme-slug'), $cart_contents_count);
	$cart_total = $woocommerce->cart->get_cart_total();

	if ($cart_contents_count == 0) return '';
	return ' <i class="fa fa-shopping-cart"></i> ' . $cart_contents. ' - ' . $cart_total;
}

/**
 * VAT Number in checkout
 */
add_action('woocommerce_after_checkout_billing_form', 'checkout_vat_field');
use Aelia\WC\EU_VAT_Assistant\WC_Aelia_EU_VAT_Assistant;
use Aelia\WC\EU_VAT_Assistant\Settings;
function checkout_vat_field($checkout) {
	$text_domain = WC_Aelia_EU_VAT_Assistant::$text_domain;
	$settings = WC_Aelia_EU_VAT_Assistant::settings();
	$current_user = wp_get_current_user();
	
	woocommerce_form_field('vat_number', array(
		'type' => 'text',
		'class' => array('aelia_wc_eu_vat_assistant vat_number update_totals_on_change address-field form-row-wide'),
		'label' => __($settings->get(Settings::FIELD_EU_VAT_FIELD_TITLE), $text_domain),
		'placeholder' => __($settings->get(Settings::FIELD_EU_VAT_FIELD_DESCRIPTION), $text_domain),
		'default' => is_object($current_user) ? $current_user->vat_number : '',
		'required' => true,
		'custom_attributes' => array(
			'valid' => 0,
		),
	), $checkout->get_value('vat_number'));
}

/**
 * Save VAT Number in the order meta
 */
add_action('woocommerce_checkout_update_order_meta', 'checkout_vat_field_order');
function checkout_vat_field_order($order_id) {
	if (!empty($_POST['vat_number'])) {
		update_post_meta($order_id, 'vat_number', sanitize_text_field($_POST['vat_number']));
	}
}

/**
 * Display VAT Number in order edit screen
 */
//add_action('woocommerce_admin_order_data_after_billing_address', 'checkout_vat_field_order_admin', 10, 1);
function checkout_vat_field_order_admin($order) {
	$vat_number = get_post_meta($order->id, 'vat_number', true);
	$validated = get_post_meta($order->id, '_vat_validated', true);
	if ($validated == 'valid') {
		echo '<p><strong>' . __('EU VAT number', 'woocommerce') . ':</strong> ' . get_post_meta($order->id, 'vat_number', true) . '</p>';
	} else {
		echo '<p><strong>' . __('Tax ID number', 'woocommerce') . ':</strong> ' . get_post_meta($order->id, 'vat_number', true) . '</p>';		
	}
}

/**
 * VAT Number in emails
 */
//add_action("woocommerce_email_after_order_table", "checkout_vat_field_email", 10, 1);
function checkout_vat_field_email($order) {
	$vat_number = get_post_meta($order->id, 'vat_number', true);
	$validated = get_post_meta($order->id, '_vat_validated', true);
	if ($validated == 'valid') {
		echo '<p><strong>' . __('EU VAT number', 'woocommerce') . ':</strong> ' . get_post_meta($order->id, 'vat_number', true) . '</p>';
	} else {
		echo '<p><strong>' . __('Tax ID number', 'woocommerce') . ':</strong> ' . get_post_meta($order->id, 'vat_number', true) . '</p>';		
	}
}

/**
 * Final conditions on tax exemption
 */
add_action('woocommerce_checkout_update_order_review', 'tax_exempt_checkout_if_no_company', 1000, 1);
function tax_exempt_checkout_if_no_company($post_data) {
	global $woocommerce;
	parse_str($post_data, $post_data);
	if ($post_data['billing_company'] == '') $woocommerce->customer->set_is_vat_exempt(false);
}

// Force shipping address to be displayed on checkout
add_filter('woocommerce_cart_needs_shipping_address', '__return_true', 50);

// Hides the product's weight and dimension in the single product page.
add_filter('wc_product_enable_dimensions_display', '__return_false');

// Remove quick actions from order list (dangerous)
function remove_processing_order_action_icon($actions){
		unset($actions['processing']);
		unset($actions['complete']);
		unset($actions['view']);
		return $actions;
}
add_filter('woocommerce_admin_order_actions', 'remove_processing_order_action_icon', 10, 3);

// Custom PDF name
add_filter('wpo_wcpdf_filename', 'wpo_wcpdf_secure_filename', 10, 4);
function wpo_wcpdf_secure_filename($filename, $template_type, $order_ids, $context) {
	$count = count($order_ids);

	switch ($template_type) {
	case 'invoice':
		$name = _n( 'invoice', 'invoices', $count, 'woocommerce-pdf-invoices-packing-slips' );
		break;
	case 'packing-slip':
		$name = _n( 'packing-slip', 'packing-slips', $count, 'woocommerce-pdf-invoices-packing-slips' );
		break;
	case 'proforma':
		$name = _n( 'proforma-invoice', 'proforma-invoices', $count, 'wpo_wcpdf_pro' );
		break;    
	case 'credit-note':
		$name = _n( 'credit-note', 'credit-notes', $count, 'wpo_wcpdf_pro' );
		break;
	default:
		$name = $template_type;
		break;
	}

	if ( $count == 1 ) {
		$document = wcpdf_get_document( $template_type, $order_ids );
		if ( $number = $document->get_number() ) {
			$suffix = $number;
		} elseif (isset($document->order) && method_exists($document->order, 'get_order_number')) {
			$number = $document->order->get_order_number();
		} else {
			$number = $order_ids[0];
		}
		$suffix = $number;
	} else {
		$suffix = date('Y-m-d'); // 2020-11-11
	}
	
	$base_name = 'STT-' . $name . '-' . $suffix;

	$filename = $base_name . '.pdf';

	return $filename;
}

// remove woocommerce scripts on unnecessary pages
function woocommerce_de_script() {
  if (function_exists( 'is_woocommerce' )) {
   if (!is_woocommerce() && !is_cart() && !is_checkout() && !is_account_page() ) { // if we're not on a Woocommerce page, dequeue all of these scripts
    wp_dequeue_script('wc-add-to-cart');
    wp_dequeue_script('jquery-blockui');
    wp_dequeue_script('jquery-placeholder');
    wp_dequeue_script('woocommerce');
    wp_dequeue_script('jquery-cookie');
    wp_dequeue_script('wc-cart-fragments');
    }
  }
}
add_action( 'wp_print_scripts', 'woocommerce_de_script', 100 );
add_action( 'wp_enqueue_scripts', 'remove_woocommerce_generator', 99 );
function remove_woocommerce_generator() {
  if (function_exists( 'is_woocommerce' )) {
    if (!is_woocommerce()) { // if we're not on a woo page, remove the generator tag
      remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
    }
  }
}
// remove woocommerce styles, then add woo styles back in on woo-related pages
function child_manage_woocommerce_css(){
  if (function_exists( 'is_woocommerce' )) {
    if (!is_woocommerce()) { // this adds the styles back on woocommerce pages. If you're using a custom script, you could remove these and enter in the path to your own CSS file (if different from your basic style.css file)
      wp_dequeue_style('woocommerce-layout');
      wp_dequeue_style('woocommerce-smallscreen');
      wp_dequeue_style('woocommerce-general');
    }
  }
}
add_action( 'wp_enqueue_scripts', 'child_manage_woocommerce_css' );
?>