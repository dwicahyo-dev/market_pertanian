<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'thumbnail', 'product_real_id', 'agriculture_id', 'quality_id', 'product_name', 'store_id', 'price', 'stock', 'description'
    ];

    /**
     * The relationship
     */
    public function quality()
    {
        return $this->belongsTo('App\Quality');
    }

    public function checkout()
    {
        return $this->hasOne('App\Checkout');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function agriculture()
    {
        return $this->belongsTo('App\Agriculture');
    }

    public function productReal()
    {
        return $this->belongsTo('App\Product');
    }
}
