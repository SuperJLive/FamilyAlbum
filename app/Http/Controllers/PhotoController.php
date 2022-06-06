<?php

namespace App\Http\Controllers;

use App\BLL\Downloadable;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\AlbumOwner;
use App\Models\Permission;
use App\Utility\PermissionDic;
use App\Utility\GUID;
use Ramsey\Uuid\Guid\Guid as GuidGuid;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($albumId)
    {
        //
        //$albumId=$request->
        $pd=new PermissionDic();
        $permissions=$pd->getPhotoPermissionSelect($albumId);
        return view('Admin.Photo.Index',['permissions'=>$permissions]);
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
            $permissionText=1;
        }

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
        // $imageName = $request->fi
        $data = $request->all();
        $a=GUID::gen();
        dd(phpinfo());
        $uploadedFile = $request->file('mediaFile');
        $destinationPath = 'upload';
        $uploadedFile->move($destinationPath,$uploadedFile->getClientOriginalName());
        //$a=Helper::test();
        //dd($a);
        //$imageName = request()->file->getClientOriginalName();

        //request()->file->move(public_path('upload'), $imageName);


        return response()->json(['success'=>1]);
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
