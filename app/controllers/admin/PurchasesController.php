<?php

class PurchasesController extends AdminController {
	/**
	 *   Show a list of all the latest users, purchases and
	 *   any other helpful information for the user.
	 */
	public function getDashboard() {
		return View::make('admin/index');
	}
}