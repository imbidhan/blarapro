<?php

namespace App\Models\Complain;

use App\Admin;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Usercomplain extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function acceptUser()
    {
        return $this->belongsTo(Admin::class, 'complainAcceptedBy','id');
    }
}
