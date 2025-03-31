<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aims_partner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'aims_partners';

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
    protected $fillable = ['name', 'full_name', 'type_partner', 'phone', 'mail', 'logo', 'color', 'province', 'district', 'sub_district'];

    
}
