<?php

namespace App\Http\Controllers\user;

use App\DataTables\UserDatatable;
use App\Models\Education;
use App\Http\Controllers\Controller;
use App\Http\Requests\EducationValidation;
use App\Http\Requests\UserValidation;
use App\Models\blog;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Permission as ContractsPermission;
use Spatie\Permission\Models\Role;

class userController extends Controller
{
    public function showdata(UserDatatable $request)
    {
        $role = Role::all();
        return $request->render('admin.userdetail', compact('role'));
    }

    public function addeducation(Request $request)
    {
        $add = new Education;
        $add->uid = $request->userid;
        $add->education = $request->education;
        $add->syear = $request->startyear;
        $add->eyear = $request->endyear;
        $add->save();
        return response()->json('1');
    }

    public function deleteuser(Request $req)
    {
        $id = $req->id;
        $query = User::find($id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something Wrong']);
        }
    }

    public function deleteeducation(Request $req)
    {

        $query = Education::where('id', $req->id)->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something Wrong']);
        }
    }


    public function viewdata(Request $request)
    {
        $query = Education::where('uid', $request->id)->get();

        return Response()->json($query);
    }


    public function editdata(Request $request)
    {
        $query = Education::where('id', $request->id)->first();

        return Response()->json($query);
    }


    public function updatedata(EducationValidation $request)
    {

        if ($request->eduid) {
            $arr = [
                'education' => $request->education,
                'syear' => $request->startyear,
                'eyear' => $request->endyear,
            ];
            Education::where('id', $request->eduid)->update($arr);
            $data = Education::where('uid', $request->user_id)->get();
            return Response()->json($data);
        }
    }


    public function edituser(Request $request)
    {
        $query = User::where('id', $request->id)->first();
        $role = $query->roles->pluck('id')->first();
        return Response()->json(['que' => $query, 'role' => $role]);
    }


    public function updateuser(UserValidation $request)
    {
        $input = $request->all();
        if ($input['id']) {
            $arr = [
                'name' => $request->uname,
                'email' => $request->email,
            ];
            // User::where('id', $input['id'])->update($arr);
            // return response()->json('1');
            // $user=User::where('id', $input['id'])->update($arr);
            $user = User::find($input['id']);
            $user->update($arr);
            DB::table('model_has_roles')->where('model_id', $input['id'])->delete();
            $user->assignRole($request->input('role'));
            return response()->json(['u' => $user]);
        }
    }


    public function activation(Request $request)
    {
        foreach ($request->id as $ids) {
            User::where('id', $ids)->delete();
        }
        return response()->json(['code' => 1, 'msg' => 'Data Has Been Deleted']);
    }


    public function userblog(Request $request)
    {
        $query = blog::where('user_id', $request->id)->get();
        return view('admin.blogdetail', compact('query'));
    }
}
