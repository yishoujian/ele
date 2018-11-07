<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable=["id","user_id","name","tel","provence","city","area","detail_address"];
}
