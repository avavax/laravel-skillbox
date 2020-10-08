<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = [];
}
