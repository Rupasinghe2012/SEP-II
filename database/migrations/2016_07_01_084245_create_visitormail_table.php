<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitormailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitormails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sender_name');
            $table->string('sender_email');
            $table->string('subject');
            $table->string('description');
            $table->string('reply')->default("not yet reply");
            $table->string('reply_by');
            $table->integer('view_status')->default(0);
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
        Schema::drop('visitormails');
    }
}
