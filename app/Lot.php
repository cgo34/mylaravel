<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Lot extends Model
{


    public function programmes(){
        //$pivotTable = 'programme_lot';
        //return $this->belongsTo(Programme::class, $pivotTable, 'programme_id', 'lot_id');
        return $this->belongsTo('App\Programme', 'programme_id');
    }
}
