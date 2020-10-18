<?php

namespace App\Models\Deposit;

use Illuminate\Database\Eloquent\Model;

class Userdeposit extends Model
{

    public function userCreated() {
        return $this->belongsTo('App\User','user_id');
    }
    public function acceptedBy() {
        return $this->belongsTo('App\Admin','accepted_by');
    }

}
