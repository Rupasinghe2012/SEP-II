<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendereventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calenderevents', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->string('user_name');
            $table->string('title');
            $table->string('description');
            $table->string('event_date');
            $table->string('venue');
            $table->time('s_time');
            $table->time('e_time');
            $table->string('type');
            $table->integer('repeat_time');
            $table->date('date_added');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('calenderevents');
    }
}