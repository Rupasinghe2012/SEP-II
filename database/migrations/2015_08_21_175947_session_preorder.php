<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SessionPreorder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_preorder', function (Blueprint $table) {
            $table->integer('customer_id'); //int(10) NOT NULL,
            $table->integer('item_id');// varchar(30) DEFAULT NULL,
            $table->integer('qty'); //varchar(100) DEFAULT NULL,

            $table->primary(['customer_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('session_preorder');
    }
}
