<?php

namespace App;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];

    public function isAdmin()
    {
        return $this->role == 'admin';
    }
}
