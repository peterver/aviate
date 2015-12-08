<?php

class Basket extends Eloquent {

	protected $table = 'baskets';

	/*
	 *   We store everything in an Aviate basket under two
	 *   keys: "session", which is a Laravel session ID,
	 *   and "data", which is a json_encode'd array of
	 *   product IDs and quantities.
	 */
	protected $fillable = array('session', 'data');

	/*
	 *   "Cache" our basket so we're not duplicating
	 *   requests to the database a lot. This should be
	 *   read-only, don't make any adjustments to this.
	 */
	protected static $basket;

	/*
	 *   This is a Laravel magic method. We can use this
	 *   to magically decode our JSON for us when we
	 *   query the database so we can save on having to
	 *   do it manually each time. Lovely!
	 */
	public function getDataAttribute($value) {
		$data = array();

		//  If it's 2 characters or less, it's
		//  not a valid JSON string.
		if(empty($value) or strlen($value) < 3) return $data;

		//  We need to convert the JSON into a key => value
		//  array, but for some reason it's returning the keys
		//  as strings which we can't look up for properly.
		//  So we'll cast $key as an integer.
		foreach(json_decode($value) as $key => $row) {
			$data[(int) $key] = $row;
		}

		return $data;
	}

	/*
	 *   Generate a basket.
	 *
	 *   This shouldn't ever be called on its own. It's used
	 *   mainly as a utility function for grabbing basket
	 *   data without throwing errors.
	 */
	public static function generate() {
		//  A bit of sanity-checking. Don't keep creating
		//  more and more baskets.
		if(Session::get('aviate_basket')) {
			return;
		}

		//  Generate a hash for our session and database to
		//  share. We want to make sure there's no collisions.
		$hash = Hash::make(time());
		
		//  Save the basket in the user's computer
		Session::set('aviate_basket', $hash);

		//  And create the basket in the database
		return self::create(array(
			'session' => $hash,
			'data' => false
		));
	}

	/*
	 *   Empty the basket and remove from the database entirely.
	 *   This will remove EVERYTHING in the basket. If you want
	 *   to just remove an item from the basket, call
	 *   -> Basket::quantity($product_id, 0);
	 */
	public static function flush() {
		//  Find our basket in the database and remove it
		self::whereSession(Session::get('aviate_basket'))->delete();

		//  Do the same for our local session.
		return Session::forget('aviate_basket');
	}

	/*
	 *   Get our basket's data. This doesn't return the actual
	 *   items in our basket, just the basket itself.
	 */
	public static function getBasket() {
		//  Make sure we've actually got a basket to get first
		//  if not - we need to create it.
		if(!Session::get('aviate_basket')) {
			self::generate();
		}

		//  Use our "cache" to see if we've already queried
		//  the database for this basket.
		if(!self::$basket) {
			//  If not, we'll create it ourselves.
			//  Use fallback() as returning an empty basket can
			//  throw errors sometimes.
			self::$basket = fallback(
				self::whereSession(Session::get('aviate_basket'))->first(),

				//  Make sure whatever gets returned is an object.
				(object) ['data' => []]
			);
		}

		//  Give the basket back
		return self::$basket;
	}

	/*
	 *   Get the contents of our basket.
	 *   There's probably a better way of doing this, but
	 *   I'm too tired to work it out properly.
	 *
	 *   The $products object lets you prepend any items
	 *   to the basket if you want to for some reason, like:
	 *
	 *   Product::getContents([Product::whereId(2)])
	 *   -> returns the contents of the basket plus
	 *      the product with ID of 2.
	 */
	public static function getContents($products = array()) {
		//  If we have an empty basket it's not worth
		//  doing any processing on. Just give an empty array
		//  back.
		if(!self::items()) {
			return $products;
		}

		//  Loop all of the items in our basket.
		foreach(self::items() as $product => $quantity) {
			//  Grab the product data
			$product = Products::whereId($product)->first();

			//  Add some useful information that Products model
			//  doesn't give us.
			$product->total_price = $product->price * $quantity;
			$product->quantity = $quantity;

			//  Add it to our array.
			$products[] = $product;
		}

		return $products;
	}

	/*
	 *    Update product quantity.
	 *
	 *    Basket::quantity(int $product_id, int $amount)
	 *    -> product_id = the ID as used in the Products database
	 *    -> amount = what you'd like the new quantity to be.
	 */
	public static function quantity($product, $quantity) {
		//  Get our item straight from the database.
		$item = self::getBasket();

		//  Grab the data separately. Don't use items().
		$data = $item->data;

		//  Cast $quantity into an integer - some of Laravel's
		//  routes cast an integer to a string for some reason.
		$quantity = (int) $quantity;

		//  If there's a product there and we've set the 
		//  quantity to 0, it means we want to remove it!
		if($quantity <= 0 and isset($data[$product])) {
			unset($data[$product]);
		} else {
			//  Otherwise, we update the quantity.
			$data[$product] = $quantity;
		}

		//  Turn the data back into JSON in order to allow us
		//  to save it into the database.
		$item->data = json_encode($data);

		//  And save it.
		return $item->save();
	}

	/*
	 *   Add a new item into the database.
	 *
	 *   Basket::add(int $product_id, int $quantity)
	 */
	public static function add($product, $quantity = 1) {
		$item = self::getBasket();
		$data = $item->data;

		if(isset($data[$product])) {
			//  Add our quantity
			$quantity += $data[$product];
		}

		$data[$product] = $quantity;

		$item->data = json_encode($data);

		return $item->save();
	}

	public static function items() {
		return self::getBasket()->data;
	}

	public static function itemCount($quantity = 0) {
		if(self::items()) {
			foreach(self::items() as $product => $amount) {
				$quantity += $amount;
			}
		}

		return $quantity;
	}

	public static function priceCount($price = 0) {
		foreach(self::getContents() as $product) {
			$price += $product->total_price;
		}

		return Currency::price($price);
	}
}
