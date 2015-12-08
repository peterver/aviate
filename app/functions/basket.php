<?php

function basket_increase_url($item) {
	if(!is_object($item)) {
		return;
	}

	return basket_quantity_url($item, $item->quantity + 1);
}

function basket_decrease_url($item) {
	if(!is_object($item)) {
		return;
	}

	return basket_quantity_url($item, $item->quantity - 1);
}

function basket_remove_url($item) {
	if(!is_object($item)) {
		return;
	}

	return basket_quantity_url($item, 0);
}

function basket_quantity_url($item, $quantity = 0) {
	return URL::to(
		join('', ['basket/update/', $item->id, '?quantity=', $quantity])
	);
}