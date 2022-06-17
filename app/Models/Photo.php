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

    protected $appends = ['thumb_path'];
    protected function thumbPath():Attribute
    {
        $dirname='';
        $filename='';
        $extension='';
        if($this->file_path){
            $pathinfo=pathinfo($this->file_path);
            $dirname=$pathinfo['dirname'];
            $filename=$pathinfo['filename'];
            $extension=$pathinfo['extension'];
            $filePath=$dirname.'/'.$filename.'_thumb.'.$extension;
        }
        else{
            $filePath='/images/weApp/nophoto2.png';
        }
        //$newPath=$dirname[''];
        return new Attribute(
            get: fn () => $filePath,
        );
    }
}
