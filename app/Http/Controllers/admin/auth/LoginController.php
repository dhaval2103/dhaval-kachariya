<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/Admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function loginpage()
    {
        return view('admin.auth.login');
    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
    public function logout()
    {
        $this->guard()->logout();
        return redirect()->route('admin.logins');
    }
}
