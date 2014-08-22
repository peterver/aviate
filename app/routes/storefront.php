<?php

/**
 *   Dime
 *   Storefront routes
 *
 *   Here's where all the URL schemas for the public-facing part
 *   of your Dime app live. You can change the first argument for
 *   every route (at your own risk!) but changing the second
 *   argument will probably break things.
 */

Route::get('/', 'SiteController@homepage');