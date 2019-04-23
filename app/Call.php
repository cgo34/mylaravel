<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Call extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'genre', 'firstname', 'lastname', 'email', 'phone', 'address', 'zipcode', 'city', 'user_id', 'programme_id', 'lot_id'
    ];

    public function programme()
    {
        return $this->belongsTo('App\Programme');
    }

    public function lot()
    {
        return $this->belongsTo('App\Lot');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
