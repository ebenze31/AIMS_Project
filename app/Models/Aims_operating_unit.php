<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_operating_unit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_operating_units';

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
    protected $fillable = ['name_unit', 'aims_type_unit_id', 'status', 'creator', 'aims_partner_id', 'aims_area_id'];

    
}
