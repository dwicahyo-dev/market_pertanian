<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Auth;

use App\Checkout;

class User extends Authenticatable implements MustVerifyEmail
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phonenumber', 'gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The relationship
     */
    public function store()
    {
        return $this->hasOne('App\Store');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function carts()
    {
        return $this->hasMany('App\ShoppingCart');
    }

    public function checkouts()
    {
        return $this->hasMany('App\Checkout');
    }

    public function countCheckoutTransaction()
    {
        $store = auth()->user()->store->id ?? null;

        return Checkout::with([
            'product.store', 'order_detail'
        ])
            ->where('is_arrived', false)
            ->whereIn('is_approved', [true, false])
            ->where('is_rejected', false)
            ->whereHas('product.store', function ($query) use($store){
                $query->where('store_id', $store);
            })
            ->whereHas('order_detail', function ($query) {
                $query->whereIn('transaction_status', ['settlement', 'success']);
            })->count();
    }

    public function countCheckoutInvoices()
    {
        return Checkout::with(['order_detail'])
            ->where('user_id', Auth::id())
            ->where('is_arrived', false)
            ->whereIn('is_approved', [true, false])
            ->where('is_rejected', false)
            ->whereHas('order_detail', function ($query) {
                $query->whereIn('transaction_status', ['pending', 'settlement', 'capture', 'success']);
            })->count();
    }

    public function countTransactions()
    {
        return $this->countCheckoutInvoices() + $this->countCheckoutTransaction();
        // return $this->countCheckoutTransaction();
    }

    public function beep()
    {
        $count = $this->countTransactions();

        if ($count >= 1) {
            return 'beep';
        }
    }
}
