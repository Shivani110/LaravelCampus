<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\AdminController; 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/register',[UserController::class,'create']);
Route::post('/signup',[UserController::class,'register']);

Route::get('/login',[UserController::class,'login']);
Route::post('/signin',[UserController::class,'signin']);

Route::get('/logout',[UserController::class,'logout']);

Route::get('/allusers',[AdminController::class,'getUsers']);
Route::get('/approvedusers',[AdminController::class,'getApprovedUsers']);

Route::post('/ajaxRequest', [AdminController::class, 'approve']);
Route::post('/disapproveuser',[AdminController::class,'disapprove']);
Route::post('/deleteuser',[AdminController::class,'deleteusers']);