<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';

    public $timestamps = false;

    /**
     * Get the ads for the region.
     */
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
