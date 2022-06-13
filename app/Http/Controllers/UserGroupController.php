<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserGroup;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maxOrder=UserGroup::count()+1;
        $groups=UserGroup::orderBy('sorting_order','asc')->get();
        return view("Admin.UserGroup.Index",['groups'=>$groups,'maxOrder'=>$maxOrder]);
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
        $rule=[
            'groupName' => 'required|string|max:100',
            'description' => 'string|nullable|max:500',
            'isUsable'=>'bool',
            'order' => 'required|integer'
        ];
        $message=[
            'groupName.required'=>'权限名称必须填写！'
        ];
        $validatedData = $request->validate($rule);

        if(!$request->has('isUsable'))
        {
            $validatedData['isUsable']=false;
        }
        $rowNum = UserGroup::create(
            [
                'group_name' => $validatedData['groupName'],
                'description' => $validatedData['description'],
                'is_usable' => $validatedData['isUsable'],
                'sorting_order' => $validatedData['order']
            ]
        );
        return redirect('Admin/UserGroup/Index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        $rule=[
            'groupName' => 'required|string|max:100',
            'description' => 'string|nullable|max:500',
            'isUsable' => 'required|boolean',
            'order' => 'required|integer'
        ];
        $validatedData = $request->validate($rule);
        $id=$request->route('id');
        $group = UserGroup::find($id);
        $group->group_name = $validatedData['groupName'];
        $group->description = $validatedData['description'];
        $group->is_usable = $validatedData['isUsable'];
        $group->sorting_order = $validatedData['order'];
        $group->save();
        return response()->json([
            'success' => 1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        

        $id=$request->input('id');
        $group = UserGroup::find($id);
        $group->delete();
        return response()->json([
            'success' => 1
        ]);
    }
}
