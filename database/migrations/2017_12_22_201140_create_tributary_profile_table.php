<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTributaryProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tributary_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->text('company_legalName')->nullable();
            $table->string('rfc')->nullable();
            $table->text('country')->nullable();
            $table->text('state')->nullable();
            $table->text('delegation')->nullable();
            $table->text('colony')->nullable();
            $table->text('exteriorNumber')->nullable();
            $table->text('interiorNumber')->nullable();
            $table->text('codePostal')->nullable();
            $table->integer('user')->unsigned();
            $table->foreign('user')->references('id')->on('users');
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
        Schema::dropIfExists('tributary_profile');
    }
}
