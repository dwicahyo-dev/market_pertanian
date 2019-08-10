<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddressHistory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name_of_recipient', 'full_address', 'phonenumber', 'city_id'
    ];

    /**
     * The relationship
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

}
