<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $rememberTokenName = '';

    protected $fillable=["name","email","password","status","remember_token"];


    public function shop()
    {
        return $this->hasOne(Shop::class,"user_id");

    }


}
