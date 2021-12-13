<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
            $result = array(
                'token' => $user->createToken('MyApp')->accessToken,
                'user' => $user
            );
            return $this->sendResponse($result, 'User Login Successfully.');
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
