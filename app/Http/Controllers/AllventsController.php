<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllventsController extends Controller
{
  public function getAllventesByVendeur(request $req)
  {
    return DB::table('vente')->where([['idv',$req->idv],['type',0]])->get();
  }

  public function deleteVeneteByDate(request $req)
  {
      $data = DB::table('vente')->where([['idu',$req->idu],['idv',$req->idv]])->get();
      $final = '';
      foreach ($data as $value) {
          $tmp = substr($value->date,0,10);
          $tmp2 = substr($req->date,0,10);
          if($tmp == $tmp2)
          {
              $final = DB::table('vente')->where('idve',$value->idve)->delete();
          }
      }
      return $final;
  }

  public function getAllventesGrosByVendeur(request $req)
  {
    return DB::table('vente')->where([['idv',$req->idv],['type',1]])->get();
  }

  public function deleteVentesGrosByDate(request $req)
  {
    $data = DB::table('vente')->where([['idu',$req->idu],['idv',$req->idv]])->get();
    $final = '';
    foreach ($data as $value) {
        $tmp = substr($value->date,0,10);
        $tmp2 = substr($req->date,0,10);
        if($tmp == $tmp2)
        {
            $final = DB::table('vente')->where('idve',$value->idve)->delete();
        }
    }
    return $final;
  }

  public function generatePv(request $req)
  {
    return DB::table('pv')->where('idv',$req->idv)->get(); 
  }

  public function deletePv(request $req)
  {
    $data = DB::table('pv')->where([['idu',$req->idu],['idv',$req->idv]])->get();
    $d = '';
    foreach ($data as $value) {
        $tmp = substr($value->date,0,10);
        $tmp2 = substr($req->date,0,10);
        if($tmp == $tmp2)
        {
            $d = DB::table('pv')->where('idpv',$value->idpv)->delete();
        }
    }
    return $d;
  }
}
