<?php

use App\Http\Controllers\PadletController;
use App\Models\Padlet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::get('/', [PadletController::class,'index']);
Route::get('/padlets', [PadletController::class,'index']);
Route::get('/padlets/{id}',[PadletController::class,'show']);

/**
//------- Einträge  (noch nicht eingebaut)---------//
Route::get('/entries', function () {

$entries = Entry::all();
return view('entries.index', compact('entries'));
});

Route::get('/entries/{id}', function ($id) {

$entry = Entry::find($id);
return view('entries.show', compact('entry'));

}); */
