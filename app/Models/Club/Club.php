<?php
namespace App\Models\Club;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPasswordNotification;

class Club extends Authenticatable
{
    use Notifiable;
    protected $with = ['userCreated','userUpdated'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userCreated()
    {
        return $this->belongsTo('App\Admin','created_by');
    }

    public function userUpdated()
    {
        return $this->belongsTo('App\Admin','updated_by');
    }
    public function users(){
        return $this->hasMany('App\User','club_id');
    }
}
