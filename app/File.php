<?php

namespace App;

use App\Property;
use App\User;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'file';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'path',
        'type',
        'extension',
        'property_id',
        'user_id',
        'category_key',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function property(){
        return $this->belongsTo(Property::class);
    }

    public function category()
    {
        return $this->hasOne(
            "App\Models\File\FileCategory",
            "key",
            "category_key"
        );
    }
}
