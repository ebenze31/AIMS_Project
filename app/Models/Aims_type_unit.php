<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_type_unit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_type_units';

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
    protected $fillable = ['name_type_unit', 'aims_partner_id', 'aims_area_id'];

    
}
