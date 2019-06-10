<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_credentials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('site_url');
            $table->string('site_port');
            $table->string('login');
            $table->string('password');
            $table->string('remarks');
            $table->string('user_id');
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
        Schema::dropIfExists('site_credentials');
    }
}
