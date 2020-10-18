<?php

namespace App\Models\Match;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    #Match
    public function match()
    {
        return $this->belongsTo('App\Models\Match\Match','match_id');
    }

}
