<?php

namespace App\Http\Controllers;

use App\Models\AlbumOwner;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $permissions=$this->getPermissionSelect();
        return view("Admin.AlbumOwner.Create",['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions=$this->getPermissionSelect();
        return view("Admin.AlbumOwner.Create",['permissions'=>$permissions]);
    }
    protected function getPermissionSelect()
    {
        $query=Permission::where('is_usable','=','1')->orderby('sorting_order');
        $permissions=$query->get();
        $arraPermission=array();
        foreach($permissions as $item){
            $arraPermission[]= array(
                'id'=>$item->id,
                'text'=>$item->permission_name
            );
        }
        return $arraPermission;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$value = $request->get('approved', 0); // 注意第二个参数 0 为默认值
        $rule=[
            'albumName' => 'required|string|max:100',
            'albumOwner'=> 'required|integer',
            'permissionId'=>'required|integer',
            'password'=>'string|nullable|max:20',
            'description' => 'string|nullable|max:500',
            'onlyPassword' =>'bool'
        ];
        $message=[
            'albumName.required'=>'相册名称必须填写！'
        ];
        $validator = Validator::make($request->all(), $rule,$message);
        if ($validator->fails()) {
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        // 获取通过验证的数据...
        $validated = $validator->validated();
        $rowNum = AlbumOwner::create(
            [
                'album_name' => $validated['permissionName'],
                'owner_id' => $validated['owner_id'],
                'description' => $validated['description'],
                'is_usable' => $validated['isUsable'],
                'sorting_order' => $validated['order']
            ]
        );
        //echo $request['permissionName'];
        return redirect('Admin/AlbumUser/Index');
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
