<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_emergency_operation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_emergency_operations';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['aims_emergency_id', 'notify', 'command_by', 'operating_code', 'waiting_reply', 'officer_refuse', 'status', 'remark_status', 'treatment', 'sub_treatment', 'aims_operating_unit_id', 'aims_operating_officers', 'time_create_sos', 'time_command', 'time_go_to_help', 'time_to_the_scene', 'time_leave_the_scene', 'time_hospital', 'time_to_the_operating_base', 'time_sos_success', 'time_sum_sos', 'time_sum_to_base', 'km_before', 'km_to_the_scene', 'km_hospital', 'km_operating_base', 'km_sum', 'photo_by_officer', 'remark_photo_by_officer', 'photo_succeed', 'remark_by_helper'];

    
}
