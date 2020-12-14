<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\secretController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\usineController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\vendeurController;
use App\Http\Controllers\clientController;
use App\Http\Controllers\AllventsController;

Route::get('/', [secretController::class,'index'])->name('main');
Route::post('check/',[secretController::class,'chk'])->name('chk');

Route::get('acceuil/',[homeController::class,'index'])->name('acceuil');

Route::any('{slug}',[homeController::class,'index'])->name('ac');

////////////////
////////////////// usine manage
Route::get('data/getAllUsine/',[usineController::class,'getAll'])->name('getAllUsine');
Route::post('data/insertUsine/',[usineController::class,'insert'])->name('insertUsine');
Route::post('data/getUsineById/',[usineController::class,'getUsineById'])->name('getUsineById');
Route::post('data/updateUsineById/',[usineController::class,'update'])->name('updateUsineById');
Route::post('data/deleteUsineById/',[usineController::class,'delete'])->name('deleteUsineById');

///////////////// admin manage
Route::get('data/getAllAdmins/',[adminController::class,'getAllAdmins'])->name('getAllAdmins');
Route::post('data/getAdminById/',[adminController::class,'getAdminById'])->name('getAdminById');
Route::post('data/addVendeurForAdmin/',[adminController::class,'AddvendeurForAdmin'])->name('AddvendeurForAdmin');
Route::post('data/delVendeurForAdmin/',[adminController::class,'delVendeurForAdmin'])->name('delVendeurForAdmin');
Route::post('data/deleteAdmin/',[adminController::class,'delete'])->name('deleteAdmin');
Route::post('data/disconnecte/',[adminController::class,'dèconnectè'])->name('disconnecte');
Route::post('data/updateAdmin/',[adminController::class,'updateAdmin'])->name('updateAdmin');
Route::post('data/addAdmin/',[adminController::class,'addAdmin'])->name('addAdmin');


///////////////// vendeur manage

Route::post('data/getVendeurByUsine/',[vendeurController::class,'getVendeurByUsine'])->name('getVendeurByUsine');

Route::post('data/getVendeurByidu/',[vendeurController::class,'getVendeurByidu'])->name('getVendeurByidu');

Route::post('data/getVendeurById/',[vendeurController::class,'getVendeurById'])->name('getVendeurById');

Route::post('data/deleteClientFromVendeur/',[vendeurController::class,'deleteClientFromVedeur'])->name('deleteClientFromVedeur');

Route::post('data/addClientForVendeur/',[vendeurController::class,'addClientForVendeur'])->name('addClientForVendeur');

Route::post('data/disconnecteVendeur/',[vendeurController::class,'disconnect'])->name('disconnecteVendeur');

Route::post('data/deleteVendeur/',[vendeurController::class,'deleteVendeur'])->name('deleteVendeur');

Route::post('data/updateVendeur/',[vendeurController::class,'updateVendeur'])->name('updateVendeur');

Route::post('data/addVendeur/',[vendeurController::class,'addVendeur'])->name('addVendeur');

////////////////// client manage

Route::post('data/getClientByIdu/',[clientController::class,'getClientByIdu'])->name('getClientByIdu');

////////////////// vente , vente_gros , prèvente

Route::post('data/AllventesByVendeur/',[AllventsController::class,'getAllventesByVendeur'])->name('getAllventesByVendeur');
Route::post('data/deleteVeneteByDate/',[AllventsController::class,'deleteVeneteByDate'])->name('deleteVeneteByDate');
//

Route::post('data/getAllventesGrosByVendeur/',[AllventsController::class,'getAllventesGrosByVendeur'])->name('getAllventesGrosByVendeur');
Route::post('data/deleteVentesGrosByVendeur/',[AllventsController::class,'deleteVentesGrosByDate'])->name('deleteVentesGrosByDate');


//
Route::post('data/getAllPv/',[AllventsController::class,'generatePv'])->name('generatePv');
Route::post('data/deletePvByVendeur/',[AllventsController::class,'deletePv'])->name('deletePv');

//////// logout

Route::get('logout/logout/',[homeController::class,'logout'])->name('logout');


/**
 * Copyright Elhousseyn Arab 
 * created At 2020
 * if this source code is stolen of to be used without permession pelase contact me here ===> potency.footabll@gmail.com
 */
