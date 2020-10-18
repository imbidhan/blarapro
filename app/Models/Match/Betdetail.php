<?php

namespace App\Models\Match;

use App\Events\betdetailUpdateEvent;
use Illuminate\Database\Eloquent\Model;

class Betdetail extends Model
{
    protected $fillable = ['status'];

    public function match()
    {
        return $this->belongsTo('App\Models\Match\Match','match_id');
    }
    public function betoption()
    {
        return $this->belongsTo('App\Models\Match\Betoption','betoption_id');
    }

    protected $dispatchesEvents = [
        'updated' => betdetailUpdateEvent::class,
    ];

}
