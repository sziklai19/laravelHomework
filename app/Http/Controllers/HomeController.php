<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check())
        {
            if(Auth::user()->teacher)
            {
                return redirect('/teacher');
            }
            else
            {
                return redirect('/student');
            }
        }
        return view('home');
    }

    public function contact()
    {
        return view('contact');
    }
}
