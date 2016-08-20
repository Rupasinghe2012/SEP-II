<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('type');
            $table->rememberToken();
            $table->timestamps();
        });


        /**
         * Insert some dummy user data into the database - Database Seeding
         */


        DB::table('users')->insert(
            array(
                'name' => 'Bruce Wayne',
                'email' => 'irukaavantha@yahoo.com',
                'password' => bcrypt('password'),
                'type' => 'client'
            )
        );
        

        DB::table('users')->insert(
            array(
                'name' => 'Mary Watson',
                'email' => 'castilahadies@gmail.com',
                'password' => bcrypt('password'),
                'type' => 'admin'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
