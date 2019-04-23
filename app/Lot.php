<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;
use Illuminate\Support\Facades\Auth;


class Lot extends Model
{
    public function authorId()
    {
        return $this->belongsTo(User::class);
    }

    public function programmes(){
        //$pivotTable = 'programme_lot';
        //return $this->belongsTo(Programme::class, $pivotTable, 'programme_id', 'lot_id');
        return $this->belongsTo('App\Programme', 'programme_id');
    }

    public function programmesIdList(){
        return Programme::where('author_id', Auth::user()->id)->orderBy('created_at')->get();
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
}
