<?php

namespace App\Models\Deposit;

use Illuminate\Database\Eloquent\Model;

class Masterdepositdetail extends Model
{
    public function userCreated()
    {
        return $this->belongsTo('App\Admin','created_by');
    }
    public function userUpdated()
    {
        return $this->belongsTo('App\Admin','updated_by');
    }
}
