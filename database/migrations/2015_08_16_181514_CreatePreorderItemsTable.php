<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreorderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
        Schema::create('preorderItems', function (Blueprint $table) {
            $table->integer('preorder_id');
            $table->integer('item_id');
			$table->integer('qty');
            $table->float('uvalue');
            $table->string('item_name');
            $table->float('discount');

            $table->primary(['preorder_id', 'item_id']);
        });*/
		Schema::create('preorderitems', function (Blueprint $table) {
            $table->increments('preorder_item_id');
            $table->integer('item_id');
			$table->integer('qty');
            $table->double('uvalue', 8, 2);
            $table->string('item_name');
            $table->double('discount', 8, 2);
			$table->integer('preorder_id');

            //$table->primary('preorder_item_id');
        });
		/*
		$preorderitems = array(
		[13, 60, 3, 10.00, 'signal toothbrush', 0.00, 0],
		[14, 59, 3, 39.00, 'prima noodles koththumi', 0.00, 0],
		[15, 59, 4, 39.00, 'prima noodles koththumi', 0.00, 0],
		[16, 60, 3, 10.00, 'signal toothbrush', 0.00, 0],
		[17, 59, 4, 39.00, 'prima noodles koththumi', 0.00, 36],
		[18, 60, 4, 10.00, 'signal toothbrush', 0.00, 3]
		);
		
		DB::table('preorderitems')->insert($preorderitems);
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preorderItems');
    }
}
