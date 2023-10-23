<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\StudentController; 
use App\Http\Controllers\StaffController; 
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\AlumniController;

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

Route::get('/addcollege',[AdminController::class,'college']);
Route::post('/college',[AdminController::class,'addcollege']);
Route::get('/collegelist',[AdminController::class,'getCollege']);
Route::get('/addcollege/{id}',[AdminController::class,'editCollege']);
Route::post('/edit',[AdminController::class,'updateCollege']);

Route::get('/student',[StudentController::class,'student']);
Route::post('/addstudent',[StudentController::class,'updateStudent']);

Route::get('/staff',[StaffController::class,'staff']);
Route::post('/addstaff',[StaffController::class,'updateStaff']);
Route::get('/collegeTemplate',[StaffController::class,'collegetemplate']);
Route::post('/addTemplate',[StaffController::class,'addtemplate']);

Route::get('/sponsor',[SponsorController::class,'sponsor']);
Route::post('/addsponsor',[SponsorController::class,'updateSponsor']);

Route::get('/alumni',[AlumniController::class,'alumni']);
Route::post('/addalumni',[AlumniController::class,'updateAlumni']);
