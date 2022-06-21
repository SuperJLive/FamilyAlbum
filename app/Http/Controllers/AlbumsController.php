<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Albums;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utility\PermissionDic;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\DB;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Admin.Albums.Index');
    }
    public function getList(Request $request)
    {
        $draw=$request->input('draw');
        $query=Albums::from('albums as a')->leftJoin('user as b','a.owner_id','=','b.id')->orderBy('a.sorting_order')
        ->select('a.id','a.albums_name','a.is_visible','a.is_usable',
        'a.downloadable','a.shareable','b.nick_name','a.permission','a.birthday','a.max_show_age','a.created_at','a.updated_at');
        $albums=$query->get();
        $data=[
            'draw'=>$draw,
            'data'=>$albums,
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
        return view("Admin.Albums.Create",['permissions'=>$permissions]);
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
            'albumsName' => 'required|string|max:100',
            'owner'=> 'integer',
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
        $rowNum = Albums::create(
            [
                'albums_name' => $validated['albumsName'],
                'owner_id' => $validated['owner'],
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
        //return redirect()->action([AlbumsController::class,'Index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function show(Albums $albums)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entity=Albums::query()->find($id);
        //dd(old('albumName'));
        $pd=new PermissionDic();
        $permissions=$pd->permissionOwnerSelect();
        return view("Admin.Albums.Edit",['albums'=>$entity,
                                              'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rule=[
            'albumsName' => 'required|string|max:100',
            'owner'=> 'integer',
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
        $albums=Albums::find($id);
        if($albums!==null)
        {
            $albums->albums_name = $validated['albumsName'];
            $albums->owner_id = $validated['owner'];
            $albums->permission=$validated['permission'];
            $albums->password = $validated['password'];
            $albums->is_visible= $validated['isVisible'];
            $albums->is_usable= $validated['isUsable'];
            $albums->shareable= $validated['shareable'];
            $albums->downloadable= $validated['downloadable'];
            $albums->birthday= $validated['birthday'];
            $albums->max_show_age= $validated['maxShowAge'];
            $albums->extension= $validated['extension'];
            $albums->sorting_order = $validated['order'];
            $albums->description = $validated['description'];
            $albums->save();
        }
        else{

        }

        //echo $request['permissionName'];
        return redirect()->action([$this::class,'Index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Albums  $albums
     * @return \Illuminate\Http\Response
     */
    public function destroy(Albums $albums)
    {
        //
    }
}
