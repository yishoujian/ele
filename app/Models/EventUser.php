<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    protected $fillable=["event_id","user_id"];

//    public function event()
//    {
//        $this->belongsTo(Event::class,"event_id");
//
//    }

    public function user()
    {
        $this->belongsTo(Event::class,"event_id");

    }



}
