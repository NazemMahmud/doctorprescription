<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('contact')->nullable();
            $table->string('academic_qualification')->nullable();
            $table->string('address')->nullable();
            $table->string('chamber_address')->nullable();
            $table->string('hospital_name')->nullable();
            $table->string('admin_type')->nullable(); // newly added
            $table->integer('active')->nullable(); // newly added
            $table->integer('senior_docid')->nullable(); // newly added
            $table->rememberToken();
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
        Schema::dropIfExists('doctors');
    }
}
