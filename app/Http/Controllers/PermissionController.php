<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$db = DB::table('permission');
        $maxOrder=Permission::count()+1;
        $permissions=Permission::orderBy('sorting_order','asc')->get();
        return view("Admin.Permission.Index",['permissions'=>$permissions,'maxOrder'=>$maxOrder]);
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
            'permissionName' => 'required|string|max:100',
            'description' => 'string|nullable|max:500',
            'isUsable'=>'bool',
            'order' => 'required|integer'
        ];
        $message=[
            'permissionName.required'=>'权限名称必须填写！'
        ];
        $validatedData = $request->validate($rule);
        
        if(!$request->has('isUsable'))
        {
            $validatedData['isUsable']=false;
        }
        $rowNum = Permission::create(
            [
                'permission_name' => $validatedData['permissionName'],
                'description' => $validatedData['description'],
                'is_usable' => $validatedData['isUsable'],
                'sorting_order' => $validatedData['order']
            ]
        );
        //echo $request['permissionName'];
        return redirect('Admin/Permission/Index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $dddd=$request->isUsable;
        $rule=[
            'permissionName' => 'required|string|max:100',
            'description' => 'string|nullable|max:500',
            'isUsable' => 'required|boolean',
            'order' => 'required|integer'
        ];
        $validatedData = $request->validate($rule);
        $id=$request->route('id');
        $db = DB::table('permission');
        $db->where('id','=',$id)->update([
            'permission_name' => $validatedData['permissionName'],
            'description' => $validatedData['description'],
            'is_usable' => $validatedData['isUsable'],
            'sorting_order' => $validatedData['order'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return response()->json([
            'success' => 1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $db = DB::table('permission');

        $id=$request->get('id');
        Permission::destroy($id);
        return response()->json([
            'success' => 1
        ]);
    }
}