<?php
global $woocommerce;
$cart_url = $woocommerce->cart->get_cart_url();
$shop_page_url = get_permalink( woocommerce_get_page_id('shop'));
$cart_contents_count = $woocommerce->cart->cart_contents_count;
$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'STT'), $cart_contents_count);
$cart_total = $woocommerce->cart->get_cart_total();

// Hide nav menu cart item when there are no items in the cart
if ($cart_contents_count > 0) { ?>
	<div id="cases-menu" class="cases-menu boxshadow"><table class="clean"><tr><?php
	echo "<td class=\"right\"><a class=\"wcmenucart-contents\" href=\"$cart_url\" title=\"View your shopping cart\"><i class=\"fa fa-shopping-cart\"></i> $cart_contents - $cart_total</a></td>";
	?>
	</tr></table></div><?php
}
?>
