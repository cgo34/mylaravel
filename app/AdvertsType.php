<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AdvertsType extends Model
{
    protected $table = 'adverts_type';

    public $timestamps = false;


    public function properties(){
        return $this->hasMany(Property::class);
    }
}
