<?php

namespace App\Policies;

use App\User;
use App\ShoppingCart;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingCartPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the shopping cart.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function view(User $user, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Determine whether the user can create shopping carts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the shopping cart.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function update(User $user, ShoppingCart $shoppingCart)
    {
        return $user->id == $shoppingCart->user_id;
    }

    /**
     * Determine whether the user can checkout the shopping cart.
     *
     * @param User $user
     * @param ShoppingCart $shoppingCart
     * @return void
     */
    public function checkOut(User $user, ShoppingCart $shoppingCart)
    {
        return $user->id == $shoppingCart->user_id;
    }

    /**
     * Determine whether the user can delete the shopping cart.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function delete(User $user, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Determine whether the user can restore the shopping cart.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function restore(User $user, ShoppingCart $shoppingCart)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the shopping cart.
     *
     * @param  \App\User  $user
     * @param  \App\ShoppingCart  $shoppingCart
     * @return mixed
     */
    public function forceDelete(User $user, ShoppingCart $shoppingCart)
    {
        //
    }
}
