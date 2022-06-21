<?php
namespace App\BLL;
use App\Models\Albums;

class AlbumsBLL
{
    public static function getSelect()
    {
        $query=Albums::where('is_usable','=','1');
        $owners=$query->get();
        //$users=User::where('nick_name','like','%uh%');
        //$ownerSelect=array();
        foreach($owners as $item){
            $ownerSelect[]= array(
                'id'=>$item->id,
                'text'=>$item->album_name
            );
        }
        return $ownerSelect;
    }
}
