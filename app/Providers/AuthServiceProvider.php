<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Address' => 'App\Policies\AddressPolicy',
        'App\ProductDiscussion' => 'App\Policies\ProductDiscussionPolicy',
        'App\Product' => 'App\Policies\ProductPolicy',
        'App\Store' => 'App\Policies\StorePolicy',
        'App\ShoppingCart' => 'App\Policies\ShoppingCartPolicy', 
        'App\Checkout' => 'App\Policies\CheckoutPolicy',   
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
