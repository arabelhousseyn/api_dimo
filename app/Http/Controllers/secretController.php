<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class secretController extends Controller
{
    public function index()
    {
      if(Session::has('code'))
      {
          return redirect('/acceuil');
      }else{
          return view('secret');
      }
    }

    public function chk(request $req)
    {
      $data= DB::table('secret')->where('id',1)->get();
      $bool = false;
      foreach ($data as $value) {
         if(str_replace(' ','',$value->secret) === str_replace(' ','',$req->secret))
         {
             $bool = true;
         }  
      }

      if($bool)
      {
      Session::put('code',$req->secret);

      return response('yes');
          
      }else{
          return response('no');
      }
    }
}
