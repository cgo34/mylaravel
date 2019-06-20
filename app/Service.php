<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    protected $table = 'services';

    protected $fillable= ['id', 'name'];

    public $timestamps = false;

    public function properties(){
        return $this->belongsToMany(Property::class);
    }
}
