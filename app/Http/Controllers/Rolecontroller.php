<?php

namespace App\Http\Controllers;

use App\DataTables\roledatatable;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class Rolecontroller extends Controller
{
    public function createrole(Request $request)
    {
        $add = new Role;
        $add->name = $request->role;
        $add->guard_name = 'web';
        $add->save();
        $add->syncPermissions($request->permission);
        return redirect()->route('admin.addrole');
    }


    public function addrole()
    {
        $permission = Permission::all();
        return view('admin.createrole', compact('permission'));
    }


    public function viewrole(roledatatable $request)
    {
        return $request->render('admin.showrole');
    }


    public function viewpermission(Request $request)
    {
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $request->id)->get();
        return response()->json($rolePermissions);
    }


    public function editrolepage(Request $request)
    {
        $role = Role::find($request->id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $request->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.editrolepage', compact('role', 'permission', 'rolePermissions'));
    }


    public function updaterole(Request $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->role;
        $role->save();
        $role->syncPermissions($request->permission);
        return redirect()->route('admin.showrole')
            ->with('success', 'Role updated successfully');
    }


    public function deleterole(Request $request)
    {
        // DB::table('roles')->where('id', $request->id)->delete();
        // return redirect()->route('admin.showrole')
        //     ->with('success', 'Role deleted successfully');
        $id = $request->id;
        $query = Role::find($id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something Wrong']);
        }
    }
}
