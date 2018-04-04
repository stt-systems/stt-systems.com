<?php
add_filter('woocommerce_cart_contents_weight', 'compute_cart_final_weight', 1000, 1);
function compute_cart_final_weight($weight) {
	return $weight;
}

//remove_all_filters( 'was_match_condition_weight' );
//add_filter( 'was_match_condition_weight', 'new_was_match_condition_weight', 10, 4 );
/**
 * Stock status.
 *
 * Match the stock status to one or more products in the cart.
 *
 * @global object $woocommerce WooCommerce object.
 *
 * @param 	bool 	$match		Current match value.
 * @param 	string 	$operator	Operator selected by the user in the condition row.
 * @param 	mixed 	$value		Value given by the user in the condition row.
 * @return 	BOOL 				Matching result, TRUE if results match, otherwise FALSE.
 */
function new_was_match_condition_weight( $match, $operator, $value, $package ) {

	if ( ! isset( WC()->cart ) ) :
		return $match;
	endif;

	$weight = 0;

	foreach ( $package['contents'] as $key => $item ) :
		$weight += $item['data']->weight;
	endforeach;

	$value = $value;

	// Make sure its formatted correct
	$value = str_replace( ',', '.', $value );

	if ( '==' == $operator ) :
		$match = ( $weight == $value );
	elseif ( '!=' == $operator ) :
		$match = ( $weight != $value );
	elseif ( '>=' == $operator ) :
		$match = ( $weight >= $value );
	elseif ( '<=' == $operator ) :
		$match = ( $weight <= $value );
	endif;

	return $match;
}

?>
