<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class MatchResult extends Model
{
    public function home()
    {
        return $this->belongsTo('App\Entities\Team', 'home');
    }

    public function away()
    {
        return $this->belongsTo('App\Entities\Team', 'away');
    }
}
