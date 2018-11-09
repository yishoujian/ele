<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $fillable=["event_id","name","description","user_id"];

    public function event()
    {
        $this->belongsTo(Event::class,"event_id");

   }

    public function user()
    {
        $this->belongsTo(Event::class,"user_id");

    }


}
