<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class usineController extends Controller
{
    public function getAll()
    {
        if(Session::has('code'))
        {
            $data = DB::table('user_u')->get();
            return $data;
        }else{
            return redirect('/');
        }
    }

    public function insert(request $req)
    {
        return DB::table('user_u')->insert([
            'nomu' => $req->name
        ]);
    }

    public function getUsineById(request $req)
    {
        return DB::table('user_u')->where('idu',$req->idc)->get();
    }

    public function update(request $req)
    {
        return DB::table('user_u')->where('idu',$req->idc)->update([
            'nomu' => $req->namec
        ]);
    }

    public function delete(request $req)
    {
        return DB::table('user_u')->where('idu',$req->idc)->delete();
    }
}
