<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SessionId')->nullable();

            $table->integer('doctor_id')->nullable();
            $table->string('doctor_name')->nullable();
            $table->integer('patient_id')->nullable();
            $table->string('patient_name')->nullable();

            $table->date('SessionDate')->nullable();
            $table->date('ReturnDate')->nullable();

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
        Schema::dropIfExists('sessions');
    }
}
