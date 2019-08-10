<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'product_real_id', 'address_id', 'qty', 'seller_note',
        'total_price', 'status', 'order_id', 'is_approved', 'is_arrived', 'is_rejected', 'is_sented', 'rejected_reason',
        'courrier_code', 'courrier_name', 'service',
        'service_description', 'service_value', 'etd'
    ];

    public function product()
    {
        return $this->belongsTo('App\ProductHistory');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address()
    {
        return $this->belongsTo('App\AddressHistory');
    }

    public function order_detail()
    {
        return $this->hasOne('App\OrderDetail');
    }

    public function review()
    {
        return $this->hasOne('App\Review');
    }

    public function order_details()
    {
        return $this->hasMany('App\OrderDetail');
    }

    public function checkout_processes()
    {
        return $this->hasMany('App\DetailedCheckoutProcess');
    }
}
