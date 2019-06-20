<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PropertiesType extends Model
{
    public $timestamps = false;

    protected $fillable= ['id', 'name'];

    protected $hidden = ['pivot'];

    public function properties(){
        return $this->hasMany(Property::class);
    }

    public function features(){
        return $this->belongsToMany(Feature::class, 'feature_property_type', 'properties_type_id', 'feature_id');
    }
}
