<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AdvertsType extends Model
{
    protected $table = 'adverts_type';

    protected $fillable = [ 'id', 'name'];

    public $timestamps = false;

    public function adverts()
    {
        return $this->belongsTo(Advert::class);
    }

}
