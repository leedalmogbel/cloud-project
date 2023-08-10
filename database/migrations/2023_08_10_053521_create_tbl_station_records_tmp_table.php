<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_station_records_tmp', function (Blueprint $table) {
            $table->double('auto_num', 15, 0);
            $table->string('server_ip', 30)->nullable()->default('');
            $table->string('server_sn', 50)->nullable()->default('');
            $table->integer('id_code')->nullable()->default(0);
            $table->integer('start_no')->nullable()->default(0);
            $table->integer('loop_no')->nullable()->default(0);
            $table->string('start_code', 30)->nullable()->default('');
            $table->string('station_status', 100)->nullable()->default('');
            $table->string('start_time', 30)->nullable()->default('');
            $table->string('arrival_time', 30)->nullable()->default('');
            $table->string('vet_1st_insp', 30)->nullable()->default('');
            $table->string('vet_re_insp', 30)->nullable()->default('');
            $table->string('vet_re_exam', 30)->nullable()->default('');
            $table->string('departure_time', 30)->nullable()->default('');
            $table->string('vet_entries_1st_insp', 500)->nullable()->default('');
            $table->string('vet_entries_re_insp', 500)->nullable()->default('');
            $table->string('vet_entries_re_exam', 500)->nullable()->default('');
            $table->string('date_stamp', 30)->nullable()->default('');
            $table->string('datetime_stamp', 30)->nullable()->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_station_records_tmp');
    }
};
