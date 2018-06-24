<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //user relation
    public function users(){
        return $this->belongsToMany('App\User','user_role','role_id','user_id');
    }
}
