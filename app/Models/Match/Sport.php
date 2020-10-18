<?php

namespace App\Models\Match;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $with = ['userCreated','userUpdated'];

    public function userCreated()
    {
        return $this->belongsTo('App\Admin','created_by');
    }

    public function userUpdated()
    {
        return $this->belongsTo('App\Admin','updated_by');
    }
}
