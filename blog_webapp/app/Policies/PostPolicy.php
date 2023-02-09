<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Post $post)
    {
        $authorized = false;

        if ($user->id == $post->user_id) {
            $authorized = true;
        }

        return $authorized;
    }

    public function published(?User $user, Post $post) {
        $authorized = false;

        if ($post->status == 2) {
            $authorized = true;
        }

        return $authorized;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
