<?php

/**
 *   Here's where routes are normally added in Laravel, but
 *   for Aviate, we separate them out a bit more so the page
 *   doesn't get too crowded. Check out /app/routes.
 */

/**
 *   storefront.php contains all the public site routes that
 *   get powered by the theme.
 */
require_once 'routes/storefront.php';

/**
 *   The admin area isn't powered by the site and is completely
 *   separate from the shop so we'll split that up.
 */
require_once 'routes/admin.php';

/**
 *   The installer needs some routes, let's get them set up.
 */
require_once 'routes/install.php';