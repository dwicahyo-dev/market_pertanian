<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailedCheckoutProcess extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checkout_id', 'checkout_process_id', 
    ];

    public function checkoutProcess()
    {
        return $this->belongsTo('App\CheckoutProcess');
    }

    
}
