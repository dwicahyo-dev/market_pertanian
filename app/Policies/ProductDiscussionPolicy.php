<?php

namespace App\Policies;

use App\User;
use App\ProductDiscussion;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ProductDiscussionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product discussion.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return mixed
     */
    public function view(User $user, ProductDiscussion $discussion)
    {
        return $user->id == $discussion->user_id;
    }

    /**
     * Determine whether the user can create product discussions.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the product discussion.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return mixed
     */
    public function update(User $user, ProductDiscussion $productDiscussion)
    {
        return $user->id == $productDiscussion->user_id;
        
    }

    /**
     * Determine whether the user can delete the product discussion.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return mixed
     */
    public function delete(User $user, ProductDiscussion $discussion)
    {
        return $user->id == $discussion->user_id;
    }

    /**
     * Determine whether the user can restore the product discussion.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return mixed
     */
    public function restore(User $user, ProductDiscussion $productDiscussion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product discussion.
     *
     * @param  \App\User  $user
     * @param  \App\ProductDiscussion  $productDiscussion
     * @return mixed
     */
    public function forceDelete(User $user, ProductDiscussion $productDiscussion)
    {
        //
    }
}
