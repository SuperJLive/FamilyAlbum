<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'photo';
    protected $fillable = ['album_id','checksum','created_at','description','downloadable','exif',
    'file_path','height','id','is_cover','is_show','location',
    'origin_name','password','permission','shareable','size','take_stamp','title','user_id','width'];

    protected $appends = ['thumb_file_path'];
    protected function thumbFilePath():Attribute
    {
        $pathinfo=pathinfo($this->file_path);
        //$newPath=$dirname[''];
        return new Attribute(
            get: fn () => $pathinfo['dirname'].'/'.$pathinfo['filename'].'_thumb.'.$pathinfo['extension'],
        );
    }
}
