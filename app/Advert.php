<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Advert extends Model
{
    protected $table = 'adverts';

    protected $fillable = [
        'id',
        'user_id',
        'property_id',
        'advert_type_id',
        'description',
        'living_space_min',
        'living_space_max',
        'price_min',
        'price_max',
        'room',
        'bedroom',
        'bathroom',
        'address',
        'zipcode',
        'city',
        'property_type',
        'search',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function property(){
        return $this->hasOne(Property::class, 'id', 'property_id');
    }

    public function advert_type(){
        return $this->hasOne(AdvertsType::class, 'id', 'advert_type_id');
    }

    public function features(){
        return $this->belongsToMany(Feature::class, 'advert_feature', 'advert_id', 'advert_id');
    }
}
