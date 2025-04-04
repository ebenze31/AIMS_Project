<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsAimsTypeUnitIdToAimsOperatingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aims_operating_units', function (Blueprint $table) {
            $table->renameColumn('type_unit', 'aims_type_unit_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aims_operating_units', function (Blueprint $table) {
            //
        });
    }
}
