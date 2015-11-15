<?php

Route::group(array('before' => 'installed|auth'), function() {
	Route::controller('admin', 'AdminController');
});