<?php

namespace App\Http\Controllers;

use App\Models\blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $query = blog::all();
        return view('home', compact('query'));
    }

    public function display()
    {
        $query = blog::all();
        return view('auth.display', compact('query'));
    }

    // public function logout()
    // {
    //     Auth::logout();
    //     return redirect('/login');
    // }
}
