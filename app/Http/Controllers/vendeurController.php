<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class vendeurController extends Controller
{
    //////// related to user_k 
    public function getVendeurByUsine(request $req)
    {
        return DB::table('user_v')->where('idu',$req[0]['idu'][0]['idu'])->get();  
    }
    /////////////

    public function getVendeurByidu(request $req)
    {
       $data =  DB::table('user_v')->where('idu',$req->idu)->get();
       foreach ($data as $value) {
           $tmp = explode(';',$value->clent);
           $value->clent = [];
           for ($i=0; $i <count($tmp) ; $i++) { 
               $data2 = DB::table('user_c')->where('idc',$tmp[$i])->get();
               $value->clent = array_merge($value->clent,json_decode($data2));
           }
       }
       return $data;
       
    }

    public function getVendeurById(request $req)
    {
        $data =  DB::table('user_v')->where('idv',$req->idv)->get();
       foreach ($data as $value) {
           $tmp = explode(';',$value->clent);
           $value->clent = [];
           for ($i=0; $i <count($tmp) ; $i++) { 
               $data2 = DB::table('user_c')->where('idc',$tmp[$i])->get();
               $value->clent = array_merge($value->clent,json_decode($data2));
           }

           $data3 = DB::table('user_u')->where('idu',$value->idu)->get();
           $value->idu = $data3;
           
       }
       return $data;
    }

    public function deleteClientFromVedeur(request $req)
    {
        $data = DB::table('user_v')->where('idv',$req->idv)->get();
        foreach ($data as $value) {
            $tmp  = explode(';',$value->clent);
            for ($i=0; $i <count($tmp) ; $i++) { 
               if($tmp[$i] == $req->idc)
               {
                   unset($tmp[$i]);
                   $tmp = array_values($tmp);
               }
            }
            $tmp = implode(';',$tmp);
        }

        return DB::table('user_v')->where('idv',$req->idv)->update([
            'clent' => $tmp
        ]);
    }

    public function addClientForVendeur(request $req)
    {
      $data  = DB::table('user_v')->where('idu',$req->idu)->get();
      $bing = false;
      foreach ($data as $value) {
          $tmp = explode(';',$value->clent);
          for ($i=0; $i <count($tmp) ; $i++) { 
              if($tmp[$i] == $req->idc)
              {
                $bing = true;
              }
          }
      }
      if($bing)
      {
          return response('no');
      }else{
          $info = DB::table('user_v')->where('idv',$req->idv)->get();
          foreach ($info as $vl) {
              $ts  = $vl->clent . ';' . $req->idc;
          }
          return DB::table('user_v')->where('idv',$req->idv)->update([
              'clent' => $ts
          ]);
      }   
    }

    public function disconnect(request $req)
    {
        return DB::table('user_v')->where('idv',$req->idv)->update([
            'active' => 'false'
        ]);
    }


    public function deleteVendeur(request $req)
    {

        DB::table('vente')->where('idv',$req->idv)->delete();
        DB::table('pv')->where('idv',$req->idv)->delete();
        $data = DB::table('user_k')->where('idu',$req->idu)->get();
        foreach ($data as $value) {
            $tmp = explode(';',$value->vendeur);
            for ($i=0; $i <count($tmp) ; $i++) { 
                 if($tmp[$i] == $req->idv)
                 {
                     unset($tmp[$i]);
                     $tmp = array_values($tmp);
                     $dtf  = implode(';',$tmp);
                     DB::table('user_k')->where('ids',$value->ids)->update([
                         'vendeur' => $dtf
                     ]);

                 }
            }
        }
        return DB::table('user_v')->where('idv',$req->idv)->delete();
    }

    public function updateVendeur(request $req)
    {
       $data = DB::table('user_v')->get();
       $bts = false;
       foreach ($data as $value) {
           if($value->phone == $req->phone)
           {
               $bts= true;
           }
       }
       if($bts)
       {
           return response('no');
       }else{
           $data2 = DB::table('user_v')->where('idv',$req->idv)->get();
           $date  ='';
           foreach ($data2 as $vl) {
               $date = explode('-',$vl->daten);
               $date = array_reverse($date);
               $date = implode('-',$date);
           }
           return DB::table('user_v')->where('idv',$req->idv)->update([
               'nomc' => $req->nomc,
               'phone' => $req->phone,
               'iden' => $req->iden,
               'pass' => $req->pass,
               'daten' => $date
           ]);
       } 
    }

    public function addVendeur(request $req)
    {
        $date= '';
        $date  = explode('-',$req->daten);
        $date = array_reverse($date);
        $date = implode('-',$date);
      return DB::table('user_v')->insert([
          'nomc' => $req->nomc,
          'phone' => $req->phone,
          'iden' => $req->iden,
          'pass' =>$req->pass,
          'active' => 'false',
          'daten' => $date,
          'idu' => $req->idu,
          'clent' => '',
      ]);   
    }

}
