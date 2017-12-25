<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('notification_id');
            $table->integer('to_doc_id'); // to which doctor
            $table->string('notification_text')->nullable();
            $table->integer('from_doc_id'); // from which doctor
            $table->integer('notification_status'); // by default 0 ; seen korle 1, means seen
            $table->integer('accept_status'); // by default 0 ;pa/assistant doc request accept korle 1, reject korle 2
            $table->string('notification_type');
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
        Schema::dropIfExists('notifications');
    }
}
