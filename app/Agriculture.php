<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agriculture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'commodity_id', 'agriculture_name', 'thumbnail'
    ];

    /**
     * The relationship
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function commodity()
    {
        return $this->belongsTo('App\Commodity');
    }

    public function standardPrice()
    {
        return $this->hasOne('App\StandardPrice');
    }
}
