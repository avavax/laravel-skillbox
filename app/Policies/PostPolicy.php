<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class  PostPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function create(User $user)
    {
        return auth()->check();
    }

    public function update(User $user, Post $post)
    {
        return $post->author_id == $user->id;
    }

    public function delete(User $user, Post $post)
    {
        return $post->author_id == $user->id;
    }
}
