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

    public function posts()
    {
        return $this->hasMany('App\Post', 'author_id');
    }

    public function postHistory()
    {
        return $this->hasMany(PostHistory::class);
    }
}
