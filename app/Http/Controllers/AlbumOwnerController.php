<?php

namespace App\Http\Controllers;

use App\Models\AlbumOwner;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permission=$this->getPermissionSelect();
        return view("Admin.AlbumOwner.Create",['permission'=>$permission]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view("Admin.AlbumOwner.Create");
    }
    protected function getPermissionSelect()
    {
        $query=Permission::where('is_usable','=','1');
        $permissions=$query->get();
        $permission=array();
        foreach($permissions as $item){
            $permission[]= array(
                'id'=>$item->id,
                'text'=>$item->permission_name
            );
        }
        return $permission;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlbumOwner  $albumOwner
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumOwner $albumOwner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlbumOwner  $albumOwner
     * @return \Illuminate\Http\Response
     */
    public function edit(AlbumOwner $albumOwner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlbumOwner  $albumOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlbumOwner $albumOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlbumOwner  $albumOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlbumOwner $albumOwner)
    {
        //
    }
}
