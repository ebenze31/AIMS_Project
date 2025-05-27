<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsAimsOperatingOfficersIdToAimsEmergencyOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aims_emergency_operations', function (Blueprint $table) {
            $table->renameColumn('aims_operating_officers', 'aims_operating_officers_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aims_emergency_operations', function (Blueprint $table) {
            //
        });
    }
}
