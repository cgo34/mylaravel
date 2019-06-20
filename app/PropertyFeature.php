<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    protected $table = 'property_feature';

    protected $fillable = [ 'property_id', 'feature_id'];

    public $timestamps = false;
}
