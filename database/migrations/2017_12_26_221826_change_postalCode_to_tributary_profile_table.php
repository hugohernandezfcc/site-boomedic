<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePostalCodeToTributaryProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tributary_profile', function (Blueprint $table) {
            //
             $table->dropColumn('codePostal');
            $table->text('postalCode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tributary_profile', function (Blueprint $table) {
            //
        });
    }
}
