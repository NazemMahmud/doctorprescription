<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_medicines', function (Blueprint $table) {
            $table->increments('PMid');

            $table->integer('patient_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->integer('medicine_id')->nullable();

            $table->string('medicine_name')->nullable();
            $table->string('MedicineDose')->nullable();
            $table->string('MedicineDuration')->nullable();
            $table->string('before_after_meal')->nullable();
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
        Schema::dropIfExists('patient_medicines');
    }
}
