<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateslidealbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slidealbums', function (Blueprint $table) {
            $table->integer('id');
            $table->timestamps();
            $table->text('name');
            $table->string('description');
            $table->string('slide_pic');
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('slidealbums');
    }
}