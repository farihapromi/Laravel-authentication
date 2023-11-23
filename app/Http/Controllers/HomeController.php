<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        if (Auth::user()->isAdmin()) {
            return $this->adminHome();
        } elseif (Auth::user()->isSuperAdmin()) {
            return $this->superAdminHome();
        } else {
            // For regular users, show regular home view or redirect to appropriate view
            return view('home');
        }
        // return view('home');
    }
    public function adminHome()
    {
        return view('adminHome');
    }
    public function superAdminHome()
    {
        return view('superAdmin');
    }
}
