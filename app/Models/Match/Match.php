<?php

namespace App\Models\Match;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $with = ['score','sport','tournament','teamOne','teamTwo','userCreated','userUpdated'];

    public function score()
    {
        return $this->belongsTo('App\Models\Match\Score','score_id');
    }

    public function sport()
    {
        return $this->belongsTo('App\Models\Match\Sport','sport_id');
    }

    public function tournament()
    {
        return $this->belongsTo('App\Models\Match\Tournament','tournament_id');
    }

    public function teamOne()
    {
        return $this->belongsTo('App\Models\Match\Team','teamOne_id');
    }

    public function teamTwo()
    {
        return $this->belongsTo('App\Models\Match\Team','teamTwo_id');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Admin','created_by');
    }

    public function userUpdated()
    {
        return $this->belongsTo('App\Admin','updated_by');
    }
}
