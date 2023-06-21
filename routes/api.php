<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\EntrieController;
use App\Http\Controllers\PadletController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Default-Routen
Route::get('/padlets', [PadletController::class,'index']);
Route::get('padlets/{id}', [PadletController::class, 'findByID']);
Route::get('padlets/checkid/{id}', [PadletController::class,'checkID']);
Route::get('padlets/search/{searchTerm}', [PadletController::class,'findBySearchTerm']);

Route::get('/entries', [EntrieController::class,'index']);
Route::get('padlets/{padlet_id}/entries', [EntrieController::class,'findByPadletID']);
Route::get('padlets/{padlet_id}/entries/{entrie_id}/ratings', [RatingController::class,'findByEntryID']);

Route::get('/comments', [CommentController::class,'index']);
Route::get('padlets/{padlet_id}/entries/{entrie_id}/comments', [CommentController::class,'findByEntryID']);

Route::get('entries/{entrie_id}/ratings', [RatingController::class,'findByEntryID']);
Route::get('entries/{entrie_id}/comments', [CommentController::class,'findByEntryID']);
Route::get('users/{id}', [UserController::class, 'findById']);

/** fürs Login bzw. fürs Logout */
Route::post('auth/login', [AuthController::class,'login']);

/** geschützte Routen (quasi nur wenn man angemeldet ist) - JWT Token */
Route::group(['middleware' => ['api','auth.jwt']], function(){
    Route::post('padlets', [PadletController::class,'save']);
    Route::put('padlets/{id}', [PadletController::class,'update']);
    Route::delete('padlets/{id}', [PadletController::class, 'delete']);
    Route::post('/padlets/{padlet_id}/entries', [EntrieController::class, 'save']);
    Route::put('entries/{id}', [EntrieController::class,'update']);
    Route::delete('/padlets/{padlet_id}/entries/{entrie_id}', [EntrieController::class,'delete']);
    Route::post('auth/logout', [AuthController::class,'logout']);
    Route::post('entries/{entrie_id}/comments', [CommentController::class, 'saveComment']);
    Route::post('entries/{entrie_id}/ratings', [RatingController::class, 'saveRating']);
});
