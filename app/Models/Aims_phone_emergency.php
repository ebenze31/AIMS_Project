<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_phone_emergency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_phone_emergencys';

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
    protected $fillable = ['name', 'phone', 'country_code', 'priority', 'status'];

    
}
