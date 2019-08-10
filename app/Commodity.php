<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'commodity_name', 'slug', 
    ];

    /**
     * The Relationship
     */
    public function argritultures()
    {
        return $this->hasMany('App\Agriculture');
    }
}
