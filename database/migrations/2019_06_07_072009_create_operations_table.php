<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_type');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('size');
            $table->string('status');
            $table->string('duration');
            $table->dateTime('last_success_on');
            $table->string('policy');
            $table->string('server');
            $table->integer('user_id')->unsigned();
            $table->string('license_id');
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
        Schema::dropIfExists('operations');
    }
}
