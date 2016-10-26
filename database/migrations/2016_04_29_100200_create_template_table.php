<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('price');
            $table->text('temp_source');
            $table->text('colour');
            $table->timestamps();
            $table->text('name');
            $table->string('temp_pic');
        });

        DB::table('templates')->insert(
            array(
                'description' => 'Indigo Themed',
                'price' => '200',
                'temp_source' => 'sasda-source.blade.php',
                'colour' => 'indigo',
                'name'=>'Dark-Forrest',
                'temp_pic'=>'sasda-image.png'
            )
        );

        DB::table('templates')->insert(
            array(
                'description' => 'Harry Potter Themed',
                'price' => '500',
                'temp_source' => 'refbzc-source.blade.php',
                'colour' => 'Black',
                'name'=>'Dark-Forrest',
                'temp_pic'=>'refbzc-image.jpg'
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
        Schema::drop('templates');
    }
}
