<?php

namespace App\Models\Withdraw;

use App\Admin;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Userwithdraw extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function acceptUser()
    {
        return $this->belongsTo(Admin::class, 'withdrawAcceptedBy','id');
    }
}
