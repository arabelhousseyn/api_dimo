<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function getAllAdmins()
    {
        $data =  DB::table('user_k')->get();
        foreach ($data as  $value) {
            $data2 = DB::table('user_u')->where('idu',$value->idu)->get();
            $value->idu = $data2;
        }
        return $data;
    }

    public function getAdminById(request $req)
    {
      $data =  DB::table('user_k')->where('ids',$req->ids)->get();

      foreach ($data as  $value) {
        $data2 = DB::table('user_u')->where('idu',$value->idu)->get();
        $tmp = explode(';',$value->vendeur);
        $value->vendeur = [];
        if(count($tmp) != 0)
        {
          for ($i=0; $i <count($tmp) ; $i++) { 
              $data3 = DB::table('user_v')->where('idv',$tmp[$i])->get();
              $value->vendeur =  array_merge($value->vendeur,json_decode($data3));
          }
        }
        $value->idu = $data2;
    }
    return $data;
    }

    public function AddvendeurForAdmin(request $req)
    {
        $bool = false;
        $data = DB::table('user_k')->where('ids',$req->ids)->get();
        foreach ($data as  $value) {
            $tmp = explode(';',$value->vendeur);
        }
        for ($i=0; $i <count($tmp) ; $i++) { 
            if($tmp[$i] == $req->idv)
            {
             $bool = true;
            }
        }

        if(!$bool)
        {
        array_push($tmp,$req->idv);
        $tmp = implode(';',$tmp);
        return DB::table('user_k')->where('ids',$req->ids)->update([
            'vendeur' => $tmp
        ]);

        }else{
        return response('no');
        }
    }

    public function delVendeurForAdmin(request $req)
    {
    
        $data = DB::table('user_k')->where('ids',$req->ids)->get();
        foreach ($data as  $value) {
            $tmp = explode(';',$value->vendeur);
        }
        for ($i=0; $i <count($tmp) ; $i++) { 
            if($tmp[$i] == $req->idv)
            {
             unset($tmp[$i]);
             array_values($tmp);
             break;
            }
        }

        $tmp = implode(';',$tmp);
        
        return DB::table('user_k')->where('ids',$req->ids)->update([
            'vendeur' => $tmp
        ]);
        
    }

    public function delete(request $req)
    {
        return DB::table('user_k')->where('ids',$req->ids)->delete();
    }

    public function dèconnectè(request $req)
    {
       return DB::table('user_k')->where('ids',$req->ids)->update([
           'active' => 'false',
           'switch' => 0
       ]);
    }

    public function updateAdmin(request $req)
    {
       $date = explode('-',$req->daten);
       $date = array_reverse($date);
       $date = implode('-',$date);
       $data = DB::table('user_k')->get();
       $ball = false;
       foreach($data as $dt)
       {
           if($dt->ids != $req->ids)
           {
               if($dt->phone == $req->phone)
               {
                 $ball = true;
                 break;
               }
           }
       }
       if($ball)
       {
           return response('no');
       }else{
           $data2 = DB::table('user_k')->where('ids',$req->ids)->get();
           foreach ($data2 as $value) {
               if($value->idu == $req->idu)
               {
                return DB::table('user_k')->where('ids',$req->ids)->update([
                    'noms' => $req->noms,
                    'phone' => $req->phone,
                    'iden' => $req->iden,
                    'pass' => $req->pass,
                    'daten' =>$date,
                    'idu' =>$req->idu,
                    'type' => $req->type,
                   ]);
               }else{
                return DB::table('user_k')->where('ids',$req->ids)->update([
                    'noms' => $req->noms,
                    'phone' => $req->phone,
                    'iden' => $req->iden,
                    'pass' => $req->pass,
                    'daten' =>$date,
                    'idu' =>$req->idu,
                    'type' => $req->type,
                    'vendeur' => ''
                   ]);
               }
           }
       }
    }

    public function addAdmin(request $req)
    {
        $date = explode('-',$req->daten);
       $date = array_reverse($date);
       $date = implode('-',$date);
       $toast = false;
         $data = DB::table('user_k')->get();
       foreach($data as $value)
       {
           if($value->phone == $req->phone)
           {
             $toast = true;
             break;
           }
       }

       if($toast)
       {
        return response('no');
       }else{
        return  DB::table('user_k')->insert([
            'noms' => $req->noms,
            'phone' => $req->phone,
            'iden' => $req->iden,
            'pass' => $req->pass,
            'active' => 'false',
            'daten' => $date,
            'idu' => $req->idu,
            'switch' => 0,
            'vendeur' => '',
            'type' => $req->type,
            'dp' => ''
        ]);
       }
    }
}
