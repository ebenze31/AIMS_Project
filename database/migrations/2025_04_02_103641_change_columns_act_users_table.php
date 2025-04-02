<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsActUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('act');
            $table->dropColumn('ranking');
            $table->dropColumn('last_edit');
            $table->dropColumn('driver_license');
            $table->dropColumn('driver_license2');
            $table->dropColumn('location_P');
            $table->dropColumn('location_A');
            $table->dropColumn('organization');
            $table->dropColumn('branch');
            $table->dropColumn('branch_district');
            $table->dropColumn('branch_province');
            $table->dropColumn('add_line');
            $table->dropColumn('std_of');
            $table->dropColumn('student_id');
            $table->dropColumn('name_staff');
            $table->dropColumn('send_covid');
            $table->dropColumn('check_covid');
            $table->dropColumn('check_in_at');
            $table->dropColumn('sub_organization');
            $table->dropColumn('user_from');
            $table->dropColumn('block_sos');
            $table->dropColumn('lat');
            $table->dropColumn('lng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
