<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = 'album';
    protected $fillable = ['title','owner_id','permission','password','tags','min_take_stamp','max_take_stamp',
    'shareable','downloadable','description'];
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
