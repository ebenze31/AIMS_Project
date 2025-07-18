<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_command extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_commands';

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
    protected $fillable = ['name_officer_command', 'officer_role', 'number', 'status', 'creator', 'user_id', 'aims_partner_id', 'aims_area_id', 'last_active'];

    
}
