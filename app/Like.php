<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // set up for like

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
   }

}
