<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PointLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('point_likes')) {

            Schema::create('point_likes', function (Blueprint $table) {

                $table->bigIncrements('id');

                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users');

                $table->unsignedBigInteger('point_id');
                $table->foreign('point_id')->references('id')->on('points');

                $table->enum('level', ['like', 'dislike']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('point_likes')) {

            Schema::drop('point_likes');

        }
    }
}
