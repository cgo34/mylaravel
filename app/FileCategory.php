<?php


namespace App\Models\File;


use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    protected $table = 'file_category';
    public $timestamps = false;

    protected $primaryKey = 'key';
    public $incrementing = false;

    protected $fillable = [
        'key',
        'value',
        'parent_key',
    ];

    public function files()
    {
        return $this->hasMany(
            "App\Models\File\File",
            "category_key",
            "key"
        );
    }

    public function children()
    {
        return $this->hasMany(
            "App\Models\File\FileCategory",
            "parent_key",
            "key"
        );
    }
}
