<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sos_map extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sos_maps';

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
    protected $fillable = ['content', 'name', 'phone', 'lat', 'lng', 'area', 'user_id','photo','CountryCode','helper','helper_id','organization_helper','help_complete','score_impression','score_period','score_total','comment_help' , 'name_area' , 'help_complete_time' ,'notify','condo_id','photo_succeed','photo_succeed_by','remark','time_go_to_help','nationalities_id','title_sos','title_sos_other','tag_sos_or_repair','status','remark_status','time_to_the_scene','time_leave_the_scene','sos_1669_id','remark_command','wait_delete','type_reporter'];

    public function user(){
        return $this->belongsTo('App\User', 'user_id' , 'id'); 
    }

    public function user_helper(){
        return $this->belongsTo('App\User', 'helper_id' , 'id'); 
    }

    public function Report_repair(){
        return $this->hasOne('App\Models\Report_repair', 'sos_map_id');
    }

    public function Sos_map_wait_delete(){
        return $this->hasOne('App\Models\Sos_map_wait_delete', 'sos_map_id');
    }
}
