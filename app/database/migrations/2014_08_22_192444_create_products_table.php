<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('name');
			$table->string('slug');
			$table->text('description');

			//  Should never need to cost more than $999,999,999.99
			$table->decimal('price', 9, 2);
			$table->integer('stock')->default(-1);

			$table->integer('gallery_id')->default(0);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
