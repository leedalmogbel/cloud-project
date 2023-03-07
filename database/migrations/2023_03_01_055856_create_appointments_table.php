<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->integer('user_id')->nullable()->index();
            $table->integer('doctor_id')->nullable()->index();
            $table->date('appointment_date')->nullable();
            $table->string('status')->index();
            $table->smallInteger('active')->default(1)->index();
            $table->integer('horse_id')->nullable()->index();
            $table->json('metadata')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('total_payable')->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
