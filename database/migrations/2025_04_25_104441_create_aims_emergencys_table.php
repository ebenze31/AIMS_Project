<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAimsEmergencysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aims_emergencys', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('aims_partner_id')->nullable();
            $table->string('aims_area_id')->nullable();
            $table->string('report_platform')->nullable();
            $table->string('name_reporter')->nullable();
            $table->string('type_reporter')->nullable();
            $table->string('phone_reporter')->nullable();
            $table->string('emergency_type')->nullable();
            $table->longText('emergency_detail')->nullable();
            $table->string('emergency_lat')->nullable();
            $table->string('emergency_lng')->nullable();
            $table->longText('emergency_location')->nullable();
            $table->string('emergency_photo')->nullable();
            $table->float('score_impression')->nullable();
            $table->float('score_period')->nullable();
            $table->float('score_total')->nullable();
            $table->longText('comment_help')->nullable();
            $table->string('patient_name')->nullable();
            $table->date('patient_birth')->nullable();
            $table->string('patient_identification')->nullable();
            $table->string('patient_gender')->nullable();
            $table->string('patient_blood_type')->nullable();
            $table->string('patient_phone')->nullable();
            $table->longText('patient_address')->nullable();
            $table->string('patient_congenital_disease')->nullable();
            $table->string('patient_allergic_drugs')->nullable();
            $table->string('patient_regularly_medications')->nullable();
            $table->longText('symptom')->nullable();
            $table->longText('symptom_other')->nullable();
            $table->string('idc')->nullable();
            $table->string('rc')->nullable();
            $table->string('rc_black_text')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aims_emergencys');
    }
}
