<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumOwner;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utility\PermissionDic;
use Illuminate\Notifications\Action;
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
        return view('Admin.AlbumOwner.Index');
    }
    public function getList(Request $request)
    {
        $draw=$request->input('draw');
        $query=AlbumOwner::from('album_owner as a')->leftJoin('user as b','a.owner_id','=','b.id')->orderBy('a.sorting_order')
        ->select('a.id','a.album_name','a.is_visible','a.is_usable',
        'a.downloadable','a.shareable','b.nick_name','a.permission','a.birthday','a.max_show_age','a.created_at','a.updated_at');
        $albumOwners=$query->get();
        $data=[
            'draw'=>$draw,
            'data'=>$albumOwners,
            'recordsTotal'=>$query->count(),
            'recordsFiltered'=>$query->count()
        ];
        return json_encode($data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pd=new PermissionDic();
        $permissions=$pd->permissionOwnerSelect();
        return view("Admin.AlbumOwner.Create",['permissions'=>$permissions]);
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
            'albumOwner'=> 'integer',
            'permission'=>'required|integer',
            'password'=>'string|nullable|max:20',
            'isVisible'=>'required|Boolean',
            'isUsable'=>'required|Boolean',
            'shareable'=>'required|Boolean',
            'downloadable'=>'required|Boolean',
            'maxShowAge'=>'required|integer|min:0|max:150',
            'birthday'=>'date',
            'order'=>'required|integer|min:0|max:9999',
            'description' => 'string|nullable|max:500',
            'extension'=>'string|nullable|max:500'
        ];
        $message=[
            //'albumName.required'=>'相册名称必须填写！'
        ];
        $validator = Validator::make($request->all(), $rule,$message);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }

        // 获取通过验证的数据...
        $validated = $validator->validated();
        $rowNum = AlbumOwner::create(
            [
                'album_name' => $validated['albumName'],
                'owner_id' => $validated['albumOwner'],
                'permission'=>$validated['permission'],
                'password' => $validated['password'],
                'is_visible'=> $validated['isVisible'],
                'is_usable'=> $validated['isUsable'],
                'shareable'=> $validated['shareable'],
                'downloadable'=> $validated['downloadable'],
                'birthday'=> $validated['birthday'],
                'max_show_age'=> $validated['maxShowAge'],
                'extension'=> $validated['extension'],
                'sorting_order' => $validated['order'],
                'description' => $validated['description'],
            ]
        );
        //echo $request['permissionName'];
        return redirect()->action([$this::class,'Index']);
        //return redirect()->action([AlbumOwnerController::class,'Index']);
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
    public function edit($id)
    {
        $entity=AlbumOwner::query()->find($id);
        //dd(old('albumName'));
        $pd=new PermissionDic();
        $permissions=$pd->permissionOwnerSelect();
        return view("Admin.AlbumOwner.Edit",['albumOwner'=>$entity,
                                              'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlbumOwner  $albumOwner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rule=[
            'albumName' => 'required|string|max:100',
            'albumOwner'=> 'integer',
            'permission'=>'required|integer',
            'password'=>'string|nullable|max:20',
            'isVisible'=>'required|Boolean',
            'isUsable'=>'required|Boolean',
            'shareable'=>'required|Boolean',
            'downloadable'=>'required|Boolean',
            'maxShowAge'=>'required|integer|min:0|max:150',
            'birthday'=>'date',
            'order'=>'required|integer|min:0|max:9999',
            'description' => 'string|nullable|max:500',
            'extension'=>'string|nullable|max:500'
        ];
        $message=[
            //'albumName.required'=>'相册名称必须填写！'
        ];
        $validator = Validator::make($request->all(), $rule,$message);
        if ($validator->fails()) {
            return back()->withErrors($validator)
                        ->withInput();
        }
        // 获取通过验证的数据...
        $validated = $validator->validated();
        $id=$request->input('id');
        $albumOwner=AlbumOwner::find($id);
        if($albumOwner!==null)
        {
            $albumOwner->album_name = $validated['albumName'];
            $albumOwner->owner_id = $validated['albumOwner'];
            $albumOwner->permission=$validated['permission'];
            $albumOwner->password = $validated['password'];
            $albumOwner->is_visible= $validated['isVisible'];
            $albumOwner->is_usable= $validated['isUsable'];
            $albumOwner->shareable= $validated['shareable'];
            $albumOwner->downloadable= $validated['downloadable'];
            $albumOwner->birthday= $validated['birthday'];
            $albumOwner->max_show_age= $validated['maxShowAge'];
            $albumOwner->extension= $validated['extension'];
            $albumOwner->sorting_order = $validated['order'];
            $albumOwner->description = $validated['description'];
            $albumOwner->save();
        }
        else{

        }

        //echo $request['permissionName'];
        return redirect()->action([$this::class,'Index']);
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
