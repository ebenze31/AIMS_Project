<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAimsOperatingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aims_operating_units', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_unit')->nullable();
            $table->string('type_unit')->nullable();
            $table->string('status')->nullable();
            $table->string('creator')->nullable();
            $table->string('aims_partner_id')->nullable();
            $table->string('aims_area_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aims_operating_units');
    }
}
