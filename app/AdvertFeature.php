<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertFeature extends Model
{
    protected $table = 'advert_feature';

    protected $fillable = [ 'advert_id', 'feature_id'];

    public $timestamps = false;
}
