<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumOwner;
use App\BLL\AlbumOwnerBLL;
use App\Models\Permission;
use App\Utility\PermissionDic;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
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
        $query=Album::query()->from('album as a')->join('album_owner as b','a.owner_id','b.id')
        ->leftJoin(DB::raw('(select * from
         (
             SELECT album_id,a.file_path,
             row_number() OVER (PARTITION BY a.album_id ORDER BY a.is_cover DESC, a.created_at ASC) rowNum
             FROM photo a
         ) a where rowNum=1) as c'),'c.album_id','a.id')
        ->orderByDesc('a.id');
        //$query->ddSql();
        $albums=$query->get();
        //dd($albums);
        return view("Admin.Album.Index",['albums'=>$albums]);
    }
    public function getList(Request $request)
    {

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pd=new PermissionDic();
        $permissions = $pd->permissionAlbumSelect();
        $shares=$pd->shareableCollect();
        $downloads=$pd->downloadableCollect();
        $albumOwners = AlbumOwnerBLL::getSelect();
        return view("Admin.Album.Create", [
            'permissions' => $permissions,
            'albumOwners' => $albumOwners,
            'shares'=>$shares,
            'downloads'=>$downloads
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'title' => 'required|string|max:100',
            'albumOwner' => 'required|integer|min:1',
            'permission' => 'required|integer',
            'password' => 'string|nullable|max:20',
            'tags' => 'string|nullable',
            'minTakeStamp' => 'date|nullable',
            'maxTakeStamp' => 'date|nullable',
            'shareable' => 'required|integer|min:-1|max:1',
            'downloadable' => 'required|integer|min:-1|max:1',
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
                'permission' => $validated['permission'],
                'password' => $validated['password'],
                'tags' => $validated['tags'],
                'min_take_stamp' => $validated['minTakeStamp'],
                'max_take_stamp' => $validated['maxTakeStamp'],
                'shareable' => $validated['shareable'],
                'downloadable' => $validated['downloadable'],
                'description' => $validated['description']
            ]
        );
        //echo $request['permissionName'];
        return redirect()->action([$this::class, 'Index']);
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
