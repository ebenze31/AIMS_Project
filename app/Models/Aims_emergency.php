<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_emergency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_emergencys';

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
    protected $fillable = ['aims_partner_id', 'aims_area_id', 'report_platform', 'name_reporter', 'type_reporter', 'phone_reporter', 'emergency_type', 'emergency_detail', 'emergency_lat', 'emergency_lng', 'emergency_location', 'emergency_photo', 'score_impression', 'score_period', 'score_total', 'comment_help', 'patient_name', 'patient_birth', 'patient_identification', 'patient_gender', 'patient_blood_type', 'patient_phone', 'patient_address', 'patient_congenital_disease', 'patient_allergic_drugs', 'patient_regularly_medications', 'symptom', 'symptom_other', 'idc', 'rc', 'rc_black_text'];

    
}
