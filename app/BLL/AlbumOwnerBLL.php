<?php
namespace App\BLL;
use App\Models\AlbumOwner;

class AlbumOwnerBLL
{
    public static function getSelect()
    {
        $query=AlbumOwner::where('is_usable');
        $owners=$query->get();
        //$users=User::where('nick_name','like','%uh%');
        $ownerSelect=array();
        foreach($owners as $item){
            $ownerSelect[]= array(
                'id'=>$item->id,
                'text'=>$item->nick_name
            );
        }
        return response()->json($ownerSelect);
    }
}
