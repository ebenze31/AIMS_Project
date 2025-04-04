<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_operating_officer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_operating_officers';

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
    protected $fillable = ['name_officer', 'type', 'level', 'amount_help', 'status', 'lat', 'lng', 'user_id', 'aims_operating_unit_id', 'aims_partner_id', 'aims_area_id','vehicle_type'];

    
}
