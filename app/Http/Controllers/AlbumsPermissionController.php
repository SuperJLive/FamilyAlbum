<?php

namespace App\Http\Controllers;

use App\Models\AlbumsPermission;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class AlbumsPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function modalIndex($albumsId)
    {
        $groups = UserGroup::query()->from('user_group as a')->leftJoin('albums_permission as b', 'a.id', '=', 'b.group_id')
            ->get();
        
        return view('Admin.AlbumsPermission.ModalIndex', ['groups' => $groups]);
    }
    public function show()
    {
        //

    }
    public function store(Request $request)
    {
        $albumsId = $request->input("modalAlbumsId");
        AlbumsPermission::where('albums_id', $albumsId)->delete();
        $groupId = $request->input("chkId");
        $row = 0;
        foreach ($groupId as $item) {
            $entity = AlbumsPermission::create([
                'albums_id' => $albumsId,
                'group_id' => $item,
                'is_allow' => true
            ]);
            if ($entity !== null) {
                $row++;
            }
        }
        if($row<=0){
            return response()->json(['success'=>0,'create'=>$row,'msg'=>'失败']);
        }
        return response()->json(['success'=>1,'create'=>$row,'msg'=>'成功']);

        //AlbumsGroupPermission::
    }
}
