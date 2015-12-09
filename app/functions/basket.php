<?php

/*
 *   aviate - Basket functions
 *
 *   Here's where all the stock functions for Aviate live.
 *   Anything to do with setting items and its basket data
 *   are in here.  
 */


/*
 *   basket_increase_url(Product $item)
 *
 *   If you don't pass an instance of the Product model,
 *   this will fail and return null.
 *
 *   Will return a URL string to a page that increases
 *   the product by 1 when visited.
 */
function basket_increase_url($item) {
	return basket_quantity_url($item, $item->quantity + 1);
}

/*
 *   basket_decrease_url(Product $item)
 *
 *   If you don't pass an instance of the Product model,
 *   this will fail and return null.
 *
 *   This is the opposite of basket_increase_url(). It
 *   will return a URL string to a page that *decreases*
 *   the product by 1 when visited.
 */
function basket_decrease_url($item) {
	return basket_quantity_url($item, $item->quantity - 1);
}

/*
 *   basket_remove_url(Product $item)
 *
 *   If you don't pass an instance of the Product model,
 *   this will fail and return null.
 *
 *   Will generate a URL that will remove the product/item
 *   from the basket by setting its quantity to 0.
 */
function basket_remove_url($item) {
	return basket_quantity_url($item, 0);
}

/*
 *   basket_quantity_url(Product $item, $quantity)
 *
 *   If you don't pass an instance of the Product model,
 *   this will fail and return null.
 *
 *   Set the quantity of an item in the basket to a specific
 *   amount. This will over-ride whatever the current
 *   quantity of the product is.
 */
function basket_quantity_url($item, $quantity = 0) {
	//  Make sure we're using a product to check
	//  There's more elegant ways of doing this, but
	//  just checking if it's an object will do for now.
	if(!is_object($item)) return;

	return URL::to(
		join('', ['basket/update/', $item->id, '?quantity=', $quantity])
	);
}