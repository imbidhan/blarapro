<?php

namespace App\Models\Withdraw;

use App\Admin;
use App\Models\Club\Club;
use Illuminate\Database\Eloquent\Model;

class Clubwithdraw extends Model
{
    protected $with = ['club','acceptBy'];
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
    public function acceptBy()
    {
        return $this->belongsTo(Admin::class, 'withdrawAcceptedBy','id');
    }
}
