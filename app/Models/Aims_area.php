<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_area extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_areas';

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
    protected $fillable = ['name_area', 'polygon', 'status', 'check_time_command', 'time_start_command', 'time_end_command', 'aims_partner_id','for_gen_code'];

    
}
