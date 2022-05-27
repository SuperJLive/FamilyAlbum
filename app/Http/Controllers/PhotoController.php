<?php

namespace App\Http\Controllers;

use App\BLL\Downloadable;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\AlbumOwner;
use App\Models\Permission;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view('Admin.Photo.Index');
    }
    /**
     * 
     */
    public function getPermissionSelect($albumId)
    {
        //get parent permission
        $data=Album::from('album as a')->join('AlbumOwner as b','a.owner_id','b.id')
        ->where('a.id','=',$albumId)->select('a.permission','a.shareable','a.downloadable',
        'b.permission as ownerPermission','b.shareable as ownerShareable','b.downloadable as ownerDownloadable')->first();
        if($data->permission==-1)
        {
            $permissionText=
        }
        else
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo 'create';
        //return view('Admin.Photo.Create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo 'show';
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
