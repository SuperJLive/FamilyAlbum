<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Admin.User.Index');
    }

    public function GetList(Request $request)
    {
        //
        $draw=$request->input('draw');
        $query=User::orderByDesc('id');
        $users=$query->get();
        $data=[
            'draw'=>$draw,
            'data'=>$users,
            'recordsTotal'=>$query->count(),
            'recordsFiltered'=>$query->count()
        ];
        return json_encode($data);
    }
    public function GetUserSelect(Request $request)
    {
        $keyword=$request->input('search');
        $keyword = str_replace('%','\%',$keyword);
        $keyword = str_replace('_','\_',$keyword);
        $query=User::Where('nick_name','like','%'.$keyword.'%');
        $users=$query->get();
        $user=array();
        foreach($users as $item){
            $user[]= array(
                'id'=>$item->id,
                'text'=>$item->nick_name
            );
        }
        return response()->json($user);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
