<?php

namespace App\Models\Betplace;

use App\Models\Club\Club;
use App\Models\Match\Betdetail;
use App\Models\Match\Betoption;
use App\Models\Match\Match;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Betplace extends Model
{
    protected $with = ['user','club','match','betoption','betdetail',"winnerItem"];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id');
    }
    public function match()
    {
        return $this->belongsTo(Match::class, 'match_id');
    }
    public function betoption()
    {
        return $this->belongsTo(Betoption::class, 'betoption_id');
    }
    public function betdetail()
    {
        return $this->belongsTo(Betdetail::class, 'betdetail_id');
    }
    public function winnerItem()
    {
        return $this->belongsTo(Betdetail::class, 'winner_id');
    }
}
