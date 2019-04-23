<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;
use Illuminate\Support\Facades\Auth;


class Programme extends Model
{

    public $additional_attributes = ['full_name'];

    public function authorId()
    {
        return $this->belongsTo(User::class);
    }

    public function authorIdList(){
        return User::where('author_id', Auth::user()->id)->orderBy('created_at')->get();
    }


    public function dispositifs(){
        $pivotTable = 'dispositif_programme';
        return $this->belongsToMany(Dispositif::class, $pivotTable, 'programme_id', 'dispositif_id');
    }

    public function lots(){
        //$pivotTable = 'programme_lot';
        //return $this->belongsToMany(Lot::class, $pivotTable, 'programme_id','lot_id');
        return $this->hasMany('App\Lot');
    }

    public function getId(){

    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
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
}
