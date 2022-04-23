<?php

namespace App\Http\Controllers;

use App\Models\AlbumOwner;
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
        return view("Admin.AlbumOwner.Create");
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
