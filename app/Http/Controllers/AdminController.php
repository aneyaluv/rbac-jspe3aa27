<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manageUsers(Request $request)
    {
        $users = User::select('id', 'name', 'email')->get();
        $roles = Role::all();
        $permissions = Permission::all();

        if ($request->method() === 'POST') {
            $user = User::findOrFail($request->user_id);
            $role = Role::findOrFail($request->role_id);

            $user->roles()->sync([$role->id]);

            return redirect()->back()->with('success', 'Role assigned successfully.');
        }

        return view('admin.manageUsers')->with(compact('users', 'roles'));
    }
}
