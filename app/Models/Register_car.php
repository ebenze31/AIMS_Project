<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register_car extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'register_cars';

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
    protected $fillable = ['brand', 'generation', 'year', 'registration_number', 'province', 'name', 'phone', 'user_id', 'provider_id', 'active', 'car_type', 'brand_other', 'generation_other', 'motor_brand', 'motor_generation','sex' , 'act' , 'insurance', 'alert_act', 'alert_insurance' , 'now' , 'location', 'juristicNameTH' ,'organization_mail' , 'branch' , 'branch_district' , 'branch_province','name_insurance','phone_insurance','CountryCode','type_car_registration'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id' , 'id'); 
    }

    public function organization(){
        return $this->belongsTo('App\Models\Organization', 'organization_id' , 'id'); 
    }

    public function guests(){
        return $this->hasMany('App\Models\Guest');
    }

    public function sos_insurances(){
        return $this->hasMany('App\Models\Sos_insurance', 'car_id');
    }
    
}
