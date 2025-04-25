<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAimsEmergencyOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aims_emergency_operations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('aims_emergency_id')->nullable();
            $table->string('notify')->nullable();
            $table->string('command_by')->nullable();
            $table->string('operating_code')->nullable();
            $table->string('waiting_reply')->nullable();
            $table->string('officer_refuse')->nullable();
            $table->string('status')->nullable();
            $table->string('remark_status')->nullable();
            $table->string('treatment')->nullable();
            $table->string('sub_treatment')->nullable();
            $table->string('aims_operating_unit_id')->nullable();
            $table->string('aims_operating_officers')->nullable();
            $table->dateTime('time_create_sos')->nullable();
            $table->dateTime('time_command')->nullable();
            $table->dateTime('time_go_to_help')->nullable();
            $table->dateTime('time_to_the_scene')->nullable();
            $table->dateTime('time_leave_the_scene')->nullable();
            $table->dateTime('time_hospital')->nullable();
            $table->dateTime('time_to_the_operating_base')->nullable();
            $table->dateTime('time_sos_success')->nullable();
            $table->string('time_sum_sos')->nullable();
            $table->string('time_sum_to_base')->nullable();
            $table->string('km_before')->nullable();
            $table->string('km_to_the_scene')->nullable();
            $table->string('km_hospital')->nullable();
            $table->string('km_operating_base')->nullable();
            $table->string('km_sum')->nullable();
            $table->string('photo_by_officer')->nullable();
            $table->string('remark_photo_by_officer')->nullable();
            $table->string('photo_succeed')->nullable();
            $table->string('remark_by_helper')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aims_emergency_operations');
    }
}
