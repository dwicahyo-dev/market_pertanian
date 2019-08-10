<?php

namespace App\Policies;

use App\User;
use App\Checkout;
use Illuminate\Auth\Access\HandlesAuthorization;

class CheckoutPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the checkout.
     *
     * @param  \App\User  $user
     * @param  \App\Checkout  $checkout
     * @return mixed
     */
    public function view(User $user, Checkout $checkout)
    {
        return $user->id == $checkout->user_id;
    }

    public function cancelled(User $user, Checkout $checkout)
    {
        return $user->id == $checkout->user_id;        
    }

    public function store(User $user, Checkout $checkout)
    {
        // return $user->store->id == $checkout->product->store_id;
        $store = $user->store->id ?? null;
        
        return $store == $checkout->product->store_id;
    }

    /**
     * Determine whether the user can create checkouts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the checkout.
     *
     * @param  \App\User  $user
     * @param  \App\Checkout  $checkout
     * @return mixed
     */
    public function update(User $user, Checkout $checkout)
    {
        //
    }

    /**
     * Determine whether the user can delete the checkout.
     *
     * @param  \App\User  $user
     * @param  \App\Checkout  $checkout
     * @return mixed
     */
    public function delete(User $user, Checkout $checkout)
    {
        //
    }

    /**
     * Determine whether the user can restore the checkout.
     *
     * @param  \App\User  $user
     * @param  \App\Checkout  $checkout
     * @return mixed
     */
    public function restore(User $user, Checkout $checkout)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the checkout.
     *
     * @param  \App\User  $user
     * @param  \App\Checkout  $checkout
     * @return mixed
     */
    public function forceDelete(User $user, Checkout $checkout)
    {
        //
    }
}
