<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horses', function (Blueprint $table) {
            $table->id('horse_id');
            $table->string('name')->index();
            $table->string('colour')->nullable();
            $table->string('age')->index();
            $table->string('gender')->nullable()->index();
            $table->string('owner_name')->index();
            $table->string('owner_mobile')->nullable()->index();
            $table->string('is_microchip')->nullable();
            $table->string('microchip_no')->nullable()->index();
            $table->string('is_passport')->nullable();
            $table->string('passport_no')->nullable()->index();
            $table->string('passport_photo')->nullable()->index();
            $table->string('horse_photo')->nullable()->index();
            $table->integer('stable_id')->index();
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
        Schema::dropIfExists('horses');
    }
}
