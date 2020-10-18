<?php

namespace App\Models\Slide;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    public function userCreated()
    {
        return $this->belongsTo('App\Admin','created_by');
    }
}
