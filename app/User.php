<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function roles(){
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }

    public function posts()
    {
        return $this->hasMany('App\post');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
