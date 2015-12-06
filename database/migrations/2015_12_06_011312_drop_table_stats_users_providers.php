<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTableStatsUsersProviders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('stats_users_providers');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('stats_users_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider');
            $table->integer('total')->unsigned()->default(0);
            $table->timestamps();
        });
    }
}
