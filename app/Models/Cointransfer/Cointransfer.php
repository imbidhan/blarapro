<?php

namespace App\Models\Cointransfer;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cointransfer extends Model
{
    public function fromUser()
    {
        return $this->belongsTo(User::class, 'fromuserid' , 'id');
    }
    public function toUser()
    {
        return $this->belongsTo(User::class, 'touserid' , 'id');
    }
}
