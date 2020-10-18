<?php

namespace App\Models\Match;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $with = ['sport','userCreated','userUpdated'];
    public function sport()
    {
        return $this->belongsTo('App\Models\Match\Sport','sport_id');
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
