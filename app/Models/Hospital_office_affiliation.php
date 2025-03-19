<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital_office_affiliation extends Model
{

    protected $table = 'hospital_offices_affiliation';


    protected $primaryKey = 'id';


    protected $fillable = ['name'];


}
