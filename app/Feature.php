<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Feature extends Model
{
    protected $table = 'features';

    protected $fillable= ['id', 'name', 'key'];

    protected $hidden = ['pivot'];

    public $timestamps = false;

    public function properties(){
        return $this->belongsToMany(Property::class, 'property_feature', 'feature_id', 'feature_id');
    }

    public function propertiestypes() {
        return $this->belongsToMany(PropertiesType::class, 'feature_property_type', 'feature_id', 'property_type_id');
    }
}
