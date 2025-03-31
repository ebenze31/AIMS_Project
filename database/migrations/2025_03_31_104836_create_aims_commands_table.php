<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAimsCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aims_commands', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name_officer_command')->nullable();
            $table->string('officer_role')->nullable();
            $table->string('number')->nullable();
            $table->string('status')->nullable();
            $table->string('creator')->nullable();
            $table->string('user_id')->nullable();
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
        Schema::drop('aims_commands');
    }
}
