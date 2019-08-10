<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Store extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'store_name', 'city_id', 'thumbnail', 'slogan', 'cover'
    ];

    /**
     * The Relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function checkouts()
    {
        return $this->hasMany('App\Checkout');
    }
}
