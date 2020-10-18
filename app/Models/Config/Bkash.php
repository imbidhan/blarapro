<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Model;

class Bkash extends Model
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
