<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreatePreordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preorders', function (Blueprint $table) {
            $table->increments('preorder_id');
			$table->integer('customer_id');
			$table->float('value');
            $table->time('ready_time')->default(Carbon::now()->addHours(2));
            $table->string('description')->default('No remarks.');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->integer('paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('preorders');
    }
}
