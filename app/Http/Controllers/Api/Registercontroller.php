<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Registercontroller extends Basecontroller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $result = array(
            'token' => $user->createToken('MyApp')->accessToken,
            'user' => $user
        );
        return ['result_status' => 1, $result];
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // $result = array(
            //     'token' => $user->createToken('MyApp')->accessToken,
            //     'user' => $user
            // );
            $user->token = $user->createToken('MyApp')->accessToken;
            return $this->sendResponse($user, 'User Login Successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }

    public function logout(Request $request)
    {
        if (Auth::user()) {
            $token = Auth::user()->token();
            $token->revoke();
            return $this->sendResponse(null, 'User Is Logout');
        } else {
            return $this->sendError('Something Wrong');
        }
    }

    public function userupdate(Request $request)
    {
        $user = User::find($request->id);
        $user->update($request->all());
        return $this->sendResponse($user, 'User Updated Successfully.');
    }

    public function userdelete(Request $request)
    {
        $user = User::where('id', $request->id)->delete($request->id);
        return $this->sendResponse($user, 'User Delete Successfully.');
    }

    public function admindashboard()
    {
        $users = Admin::all();
        $success =  $users;

        return response()->json($success, 200);
    }
}
