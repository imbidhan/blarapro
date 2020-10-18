<?php

namespace App\Models\AccessLevel;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    public function admin()
    {
        return $this->hasMany('App\Admin', 'role_id');
    }
}
