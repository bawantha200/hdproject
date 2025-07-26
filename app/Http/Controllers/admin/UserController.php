<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(){
        $users = User::with('roles') -> get();
        $roles = Role::pluck('name','name') -> all();
        return view('admin.userManage.user',compact('users','roles'));
    }

    public function storeUser(Request $request){
        $request->validate([
            'first_name' => 'required',
            'last_name'=> 'nullable',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->syncRoles($request->roles);


        return redirect()->back()->with('success','User added successfully!');
    }

    // public function updateUser(Request $request){
    //     $user = User::findOrFail($request->user_id);
    //     $request->validate([
    //         'user_id' => 'required',
    //         'role' => 'required|exists:roles,name',
          
    //     ]);
    //     $update = Role::find($request->user_id);
    //     $update->role = $request->user_role;
        
    //     $update->save();

    //     $user->syncRoles($request->role);
    //     return redirect()->back()->with('success','User updated successfully! ');
    // }

    public function updateUser(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'role' => 'required|exists:roles,name',
    ]);

    // Find the user
    $user = User::findOrFail($request->user_id);

    // Update the user's role
    $user->syncRoles($request->role);

    return redirect()->back()->with('success', 'User role updated successfully!');
}

    public function deleteUser($id){
        $delete = User::find($id);
        $delete -> delete();

        return redirect()->back()->with('success','User deleted successfully!');
    }

}
