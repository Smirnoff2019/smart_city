<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbdatePointsTableTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('points', 'user_id')) {

            Schema::table('points', function (Blueprint $table) {

                $table->unsignedBigInteger('user_id')->after('id')->change();

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
        if (Schema::hasColumn('points', 'user_id')) {

            Schema::table('points', function (Blueprint $table) {

                $table->unsignedBigInteger('user_id')->after('id')->nullable()->change();

            });
        }
    }
}
