<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionController extends Controller
{
    //
    public function index(){
        $permissions = Permission::all();
        return view('admin.userManage.permissions',compact('permissions'));
    }

    public function storePermission(Request $request){
        $request -> validate([
            'permission_name' => 'required',
        ]);

        Permission::create(['name'=>$request->permission_name]);

        return redirect()->back()->with('success','Permission added successfully!');
    }

    public function updatePermission(Request $request){
        $validatedData = $request->validate([
            'permission_name' => 'required',
            'permission_id' => 'required',
        ]);

        $update = Permission::find($request->permission_id);
        // $update -> name = $request->permission_name;
        $update->name = $validatedData['permission_name'];

        $update -> save();

        return redirect()->back()->with('success','Permission updated successfully!');

    }


    public function deletePermission($id){
        $delete = Permission::find($id);
        
            $delete->delete();

        return redirect()->back()->with('success','Permission deleted successfully!');

    }
}
