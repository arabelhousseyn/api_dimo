<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
class homeController extends Controller
{
    public function index()
    {
        if(Session::has('code'))
        {
            return view('home');
        }else{
            return redirect('/');
        }
    }

    public function logout()
    {
        Session::forget('code');
        return redirect('/');
    }
}
