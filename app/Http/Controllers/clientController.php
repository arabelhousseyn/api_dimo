<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class clientController extends Controller
{
    public function getClientByIdu(request $req)
    {
        return DB::table('user_c')->where('idu',$req->idu)->get();
    }
}
