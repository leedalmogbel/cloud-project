<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stables', function (Blueprint $table) {
            $table->id('stable_id');
            $table->string('name')->index();
            $table->string('stable_no')->nullable()->index();
            $table->string('owner_name')->nullable()->index();
            $table->string('owner_eid')->nullable()->index();
            $table->string('owner_eid_photo')->nullable()->index();
            $table->string('owner_mobile')->nullable()->index();
            $table->string('foreman_name')->nullable()->index();
            $table->string('foreman_eid')->nullable()->index();
            $table->string('foreman_eid_photo')->nullable()->index();
            $table->string('foreman_mobile')->nullable()->index();
            $table->integer('total_horses');
            $table->integer('user_id')->index();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('stable');
    }
}
