<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTableStatsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('stats_images');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('stats_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_mime');
            $table->integer('total')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
