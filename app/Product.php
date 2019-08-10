<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agriculture_id', 'quality_id', 'product_name', 'store_id',
        'thumbnail', 'price', 'stock', 'product_status', 'description', 'quality_id'
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

    public function productDiscussions()
    {
        return $this->hasMany('App\ProductDiscussion');
    }

}
