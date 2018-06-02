<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function comment()
    {
        $this->belongsTo('App\Comment');
    }
}
