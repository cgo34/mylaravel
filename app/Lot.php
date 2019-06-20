<?php

namespace App;

use const http\Client\Curl\PROXY_HTTP;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Scope;


class Lot extends Model
{
    public function authorId()
    {
        return $this->belongsTo(User::class);
    }

    public function programmes(){
        return $this->belongsTo(Programme::class, 'programme_id');
    }

    public function programmesIdList(){
        return Programme::where('author_id', Auth::user()->id)->orderBy('created_at')->get();
    }

    public function optionrequests(){
        return $this->hasMany(OptionRequests::class, 'lot_id', 'id');
    }

    public function favorites(){
        return $this->hasMany(FavoriteLot::class, 'lot_id', 'id');
    }

    public function bookLots(){
        return $this->hasOne(BookLot::class, 'lot_id', 'id');
    }





    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function favorited()
    {
        return (bool) FavoriteLot::where('user_id', Auth::id())
            ->where('lot_id', $this->id)
            ->first();
    }

    /**
     * Determine whether a post has been marked as booked by a user.
     *
     * @return boolean
     */
    public function myBooked()
    {
        return (bool) BookLot::where('user_id', Auth::id())
            ->where('lot_id', $this->id)
            ->first();
    }

    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function isBooked()
    {
        $lot = Lot::where('id', $this->id)->first();
        return $lot->booked;
        /*
        return (bool) Lot::where('lot_id', $this->id)
            ->first();*/
    }

    public function scopeWithPrice(Builder $query, $price)
    {
        return $query->programmes();
        return $query->with('lots')->where('prix', '<=', $price);
        return $query->whereHas('lots', function($q) use ($price){
            $q->where('prix', '<=', $price);
        });
    }
}
