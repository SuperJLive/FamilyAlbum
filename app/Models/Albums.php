<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Utility\PermissionDic;

class Albums extends Model
{
    use HasFactory;
    protected $table = 'albums';
    protected $fillable = ['albums_name','owner_id','permission','password','is_visible','is_usable','downloadable',
    'shareable','birthday','max_show_age','sorting_order','description'];


    protected $appends = ['permission_text'];
    protected $casts = [
        'birthday' => 'datetime:Y-m-d',
    ];
    protected function permissionText():Attribute
    {
        $permissionDic=new permissionDic();
        $permissions=$permissionDic->permissionCollect();
        //dd($this->);
        $permission=$permissions->where('id','=',$this->permission)->first();
        // if($this->permission){
        //     $pathinfo=pathinfo($this->file_path);
        //     $dirname=$pathinfo['dirname'];
        //     $filename=$pathinfo['filename'];
        //     $extension=$pathinfo['extension'];
        //     $filePath=$dirname.'/'.$filename.'_thumb.'.$extension;
        // }
        // else{
        //     $filePath='/images/weApp/nophoto2.png';
        // }
        //$newPath=$dirname[''];
        return new Attribute(
            get: fn () => $permission['text'],
        );
    }
}
