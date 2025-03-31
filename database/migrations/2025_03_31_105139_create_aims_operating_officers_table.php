<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAimsOperatingOfficersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aims_operating_officers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_officer')->nullable();
            $table->string('type')->nullable();
            $table->string('level')->nullable();
            $table->string('amount_help')->nullable();
            $table->string('status')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('user_id')->nullable();
            $table->string('aims_operating_unit_id')->nullable();
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
        Schema::drop('aims_operating_officers');
    }
}
