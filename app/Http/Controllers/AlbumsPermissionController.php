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
        $groups=UserGroup::query()->from('user_group as a')->leftJoin('albums_permission as b','a.id','=','b.group_id')
        ->get();
        //dd($groups);
        return view('Admin.AlbumsPermission.ModalIndex',['groups'=>$groups]);
    }
    public function show()
    {
        //

    }
    public function store(Request $request)
    {
        //
        //AlbumsGroupPermission::
    }
}
