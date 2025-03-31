<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAimsAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aims_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_area')->nullable();
            $table->longText('polygon')->nullable();
            $table->string('status')->nullable();
            $table->string('check_time_command')->nullable();
            $table->dateTime('time_start_command')->nullable();
            $table->dateTime('time_end_command')->nullable();
            $table->string('aims_partner_id')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aims_areas');
    }
}
