<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // saat user pertama kali register, maka akan mendapatkan role "user"
            // tambahkan pada RegisterController
        // membuat role (ditambah ke table roles)
            // $role = Role::create(['name' => 'user']);
        // membuat permission (ditambah ke table permission)
            // $permission = Permission::create(['name' => 'home']);
        // memberi user sebuah permission (ditambah ke table model_has_permissions)
            // auth()->user()->givePermissionTo(['product','setting']);
        // memberi role ke user (ditambah ke table model_has_roles);
            // auth()->user()->assignRole('admin');
        // memberi role ke permission (ditambah ke table role_has_permission)
            // $role = Role::findById(1); // id 1 berarti admin
            // $role->givePermissionTo(['product', 'setting']); // berarti admin mempunyai permission ke product dan setting
        // mengecek permission suatu user 
            // $permission = Auth::user()->permissions;
            // dd($permission);
        // mengecek role suatu user
            // $role = Auth::user()->getRoleNames();
            // dd($role);
        // mengapus permission yang dimiliki oleh user
            // auth()->user()->revokePermissionTo('setting');
        // menghapus role yang dimiliki oleh user
            // auth()->user()->removeRole('admin');

        return view('home');
    }

    public function product(){
        return view('product');
    }

    public function setting(){
        $users = User::all();
        $roles = Auth::user()->getRoleNames();
        return view('setting', compact('users','roles'));
    }

    // public function editSetting(User $user){
    //     $user = $user;
    //     $roles = Role::all();
    //     $permissions = Permission::all();

    //     return view('editSetting', compact('user','roles','permissions'));
    // }

    // public function updateSetting(User $user, Request $request){
    //     $user = $user;
    //     $roles = Role::all();
    //     $permissions = Permission::all();
    //     $role_name = $user->getRoleNames();
    //     $permission_name = $user->permissions;
    //     if($request){
    //         $data = $request->all();
    //         // dd($data);
    //         $role = Role::findById($data['role']);
    //         // dd($role);
    //         // if($role_name == true){
    //         //     $user->removeRole($role_name[0]);
    //         //     $user->revokePermissionTo($permission_name);
    //         // }
    //         auth()->user()->assignRole($role);
    //         $user->givePermissionTo($data['permission']);
    //         $role->givePermissionTo($data['permission']);
    //         $user->update($data);
    //     }
    //     return redirect()->route('setting')->with('success', 'User edit successfully');
    // }
    public function edit(Request $request, $id){
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        $roles_name = $user->getRoleNames();
        $permission_name = $user->permissions;

        if($request->isMethod('put')){
            $data = $request->all();
            // dd($data['permission']);
            $role= Role::findById($data['role']);

            if($roles_name == true){
                // dd('ok');
                $user->roles()->detach();
                $user->revokePermissionTo($permission_name);
            }
            $user->givePermissionTo($data['permission']);
            $user->assignRole($role);
            $role->givePermissionTo($data['permission']);
            return redirect()->route('setting')->with('success', 'User edit successfully');

            // if(count(array($data['permission'] > 0 ))){
            //     foreach($data['permission'] as $key => $value){
            //         $user->givePermissionTo($data['permission'][$key]);
            //         $user->assignRole($role);
            //         $role->givePermissionTo($data['permission'][$key]);
            //         return redirect()->route('setting')->with('success', 'User edit successfully');
            //     }
            // }
            
        }

        return view('editSetting', compact('user','roles','permissions'));
    }
}
