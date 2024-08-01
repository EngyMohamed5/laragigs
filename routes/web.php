<?php

// use GuzzleHttp\Psr7\Request;

use App\Models\Listing;
use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;


// Route::get('/posts/{id}',function($id){
//     return response('Post', $id);
// })->where('id','[0,9]+');
Route::get('/', [ListingController::class , 'index']);
Route::get('/listings/create',[ListingController::class , 'create'] )->middleware('auth');
Route::get('/listings/manage',[ListingController::class , 'manage'])->middleware('auth');
Route::post('/listings',[ListingController::class , 'store'] )->middleware('auth');
Route::get('/listings/{listing}',[ListingController::class , 'show'] )->name('listings.show');
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

Route::get('/register' , [UserController::class , 'create'])->name('register')->middleware('guest');
Route::post('/users' , [UserController::class , 'store']);
Route::post('/logout' , [UserController::class , 'logout'])->name('logout')->middleware('auth');
Route::get('/login' , [UserController::class , 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate' , [UserController::class , 'authenticate']);

