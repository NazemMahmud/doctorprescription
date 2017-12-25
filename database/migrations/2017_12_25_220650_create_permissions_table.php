<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('permissionId');

            $table->integer('CreatePatient')->default(0); // to which doctor
            $table->integer('ViewAllPatient')->default(0);
            $table->integer('ViewPatientDetails')->default(0);
            $table->integer('CreateSession')->default(0);
            $table->integer('EditSession')->default(0);
            $table->integer('ViewAllSession')->default(0);
            $table->integer('ViewSessionDetails')->default(0);
            $table->integer('DownloadTest')->default(0);

            $table->integer('doctorId')->nullable();

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
        Schema::dropIfExists('permissions');
    }
}
