<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\BLL\AlbumOwnerBLL;
use App\Utility\PermissionDic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        $permissions=PermissionDic::permissionSelectAll();
        $albumOwners=AlbumOwnerBLL::getSelect();
        return view("Admin.Album.Create",['permissions'=>$permissions,
                                            'albumOwners'=>$albumOwners]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule=[
            'title' => 'required|string|max:100',
            'permission'=>'required|integer',
            'password'=>'string|nullable|max:20',
            'shareable'=>'required|bool',
            'downloadable'=>'required|bool',
            'description' => 'string|nullable|max:500'
        ];

        $validator = Validator::make($request->all(), $rule);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        // 获取通过验证的数据...
        $validated = $validator->validated();
        $rowNum = Album::create(
            [
                'title' => $validated['title'],
                'owner_id' => $validated['albumOwner'],
                'permission'=>$validated['permission'],
                'shareable' => $validated['shareable'],
                'downloadable' => $validated['downloadable'],
                'password' => $validated['password'],
                'description' => $validated['description']
            ]
        );
        //echo $request['permissionName'];
        return redirect()->action([$this::class,'Index']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }
}
