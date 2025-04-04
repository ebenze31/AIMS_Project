<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAimsTypeUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aims_type_units', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_type_unit')->nullable();
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
        Schema::drop('aims_type_units');
    }
}
