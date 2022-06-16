<?php

namespace App\Http\Controllers\WeApp;

use App\Models\AlbumOwner;
use App\Models\Album;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ownerId)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($ownerId)
    {
        $query=Album::query()->from('album as a')->join('album_owner as b','a.owner_id','b.id')
        ->leftJoin(DB::raw('(select * from
         (
             SELECT album_id,a.file_path,
             row_number() OVER (PARTITION BY a.album_id ORDER BY a.is_cover DESC, a.created_at ASC) rowNum
             FROM photo a
         ) a where rowNum=1) as c'),'c.album_id','a.id')
        ->where('a.owner_id','=',$ownerId)
        ->orderByDesc('a.id');
        //$query->ddSql();
        $albums=$query->get();
        //dd($albums);
        return response()->json($albums);
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
