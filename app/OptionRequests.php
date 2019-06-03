<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Lot;

class OptionRequests extends Model
{
    //
    protected $table = 'option_requests';
    public $timestamps = false;

    public function users(){
        $pivotTable = 'lots_option_request_users';
        return $this->belongsTo(User::class);
    }

    public function lots(){
        $pivotTable = 'lots_option_request_users';
        return $this->belongsTo(Lot::class, 'lot_id', 'id');
    }

}
