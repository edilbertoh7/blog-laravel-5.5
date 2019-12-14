<?php

namespace App\Policies;

use App\User;
use App\Post;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function pass(User $user, Post $post)
    { /* se valida si el post al que se intenta acceder tiene en su user_id el mismo 
        id de la persona logueada si retorna true premite in gresar de lo contrario no*/
        return $user->id == $post->user_id;
    }
}
