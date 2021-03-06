<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomebannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_path');
            $table->integer('ordering')->default(0);
            $table->tinyInteger('show')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('link_path');
            $table->string('title');
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
        Schema::drop('home_banners');
    }
}
