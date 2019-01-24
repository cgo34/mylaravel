<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Programme extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
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
}
