<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToStationRecordsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_station_records', function (Blueprint $table) {
            //
            $table->string('recovery_time', 30)->nullable()->default('');
            $table->string('loop_time', 50)->nullable()->default('');
            $table->string('loop_speed', 50)->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_station_records', function (Blueprint $table) {
            //
        });
    }
}
