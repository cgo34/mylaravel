<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Dispositif extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dispositifs';

    public function programmes(){
        $pivotTable = 'dispositif_programme';
        return $this->belongsToMany(Programme::class, $pivotTable, 'dispositif_id','programme_id');
    }


}
