<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;


class Programme extends Model
{

    public $additional_attributes = ['full_name'];


    public function authorId(){
        return $this->belongsTo(User::class);
    }

    public function authorIdList(){
        return User::where('active', 1)->orderBy('created_at')->get();
        //return User::where('id', Auth::user()->id)->orderBy('created_at')->get();
    }

    public function dispositifs(){
        $pivotTable = 'dispositif_programme';
        return $this->belongsToMany(Dispositif::class, $pivotTable, 'programme_id', 'dispositif_id');
    }

    public function lots(){
        //$pivotTable = 'programme_lot';
        //return $this->belongsToMany(Lot::class, $pivotTable, 'programme_id','lot_id');
        return $this->hasMany(Lot::class, 'programme_id');
    }

    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
            ->where('programme_id', $this->id)
            ->first();
    }

    public function booked()
    {
        return (bool) Book::where('user_id', Auth::id())
            ->where('programme_id', $this->id)
            ->first();
    }

    public function scopeWithCity(Builder $query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeWithPriceLots(Builder $query, $price)
    {
        return $query->whereHas('lots', function ($query) use ($price) {
            $query->whereIn('lots.prix', $price);
        });
    }
}
