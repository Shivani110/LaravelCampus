<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\StudentController; 
use App\Http\Controllers\StaffController; 
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PublicController;

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

Route::get('/index',[PublicController::class,'publicDashboard']);
Route::get('/allcollege',[PublicController::class,'getCollegename']);
Route::get('/collegetemplates/{slug}',[PublicController::class,'getTemplate']);
Route::get('/template/{slug}',[PublicController::class,'viewTemplate']);
Route::get('/blogposts/{slug}',[PublicController::class,'getposts']);
Route::post('/likes',[PublicController::class,'postlikes']);
Route::post('/comments',[PublicController::class,'postcomments']);
Route::post('/reply',[PublicController::class,'replyComments']);
Route::post('/search',[PublicController::class,'searchPost']);

Route::middleware(['Auth'=>'admin'])->group(function () {
    Route::get('/admin-dashboard/allusers',[AdminController::class,'getUsers']);
    Route::get('/admin-dashboard/approvedusers',[AdminController::class,'getApprovedUsers']);
    Route::post('/ajaxRequest', [AdminController::class, 'approve']);
    Route::post('/disapproveuser',[AdminController::class,'disapprove']);
    Route::post('/deleteuser',[AdminController::class,'deleteusers']);
    Route::get('/admin-dashboard/addcollege',[AdminController::class,'college']);
    Route::post('/college',[AdminController::class,'addcollege']);
    Route::get('/admin-dashboard/collegelist',[AdminController::class,'getCollege']);
    Route::get('/admin-dashboard/addcollege/{slug}',[AdminController::class,'editCollege']);
    Route::post('/edit',[AdminController::class,'updateCollege']);
    Route::get('/admin-dashboard/category',[AdminController::class,'category']);
    Route::post('/admin-dashboard/createcategory',[AdminController::class,'createCategory']);
    Route::post('/admin-dashboard/deletecategory',[AdminController::class, 'deletCategory']);
    Route::get('/admin-dashboard/tag',[AdminController::class,'tag']);
    Route::post('/admin-dashboard/createtag',[AdminController::class,'createTag']);
    Route::post('/admin-dashboard/deletetag',[AdminController::class,'deleteTag']);
});

Route::middleware(['Auth'=>'student'])->group(function() {
    Route::get('/student-dashboard/student',[StudentController::class,'student']);
    Route::post('/addstudent',[StudentController::class,'updateStudent']);
});

Route::middleware(['Auth'=>'staff'])->group(function() {
    Route::get('/staff-dashboard/staff',[StaffController::class,'staff']);
    Route::post('/addstaff',[StaffController::class,'updateStaff']);
    Route::get('/staff-dashboard/collegeTemplate',[StaffController::class,'collegetemplate']);
    Route::post('/addTemplate',[StaffController::class,'addtemplate']);
    Route::get('/staff-dashboard/collegetemplatelist',[StaffController::class,'getTemplate']);
    Route::get('/staff-dashboard/collegeTemplate/{slug}',[StaffController::class,'editTemplate']);
    Route::post('/updateTemplate',[StaffController::class,'updateTemplate']);
    Route::post('/remove',[StaffController::class,'removedata']);
    Route::get('/staff-dashboard/addposts',[StaffController::class,'createpost']);
    Route::post('/posts',[StaffController::class,'addposts']);
    Route::get('/staff-dashboard/allposts',[StaffController::class,'getposts']);
    Route::get('/staff-dashboard/addposts/{slug}',[StaffController::class,'editposts']);
    Route::post('/editposts',[StaffController::class,'updateposts']);
});

Route::middleware(['Auth'=>'sponsor'])->group(function() {
    Route::get('/sponsor-dashboard/sponsor',[SponsorController::class,'sponsor']);
    Route::post('/addsponsor',[SponsorController::class,'updateSponsor']);
});

Route::middleware(['Auth'=>'alumni'])->group(function() {
    Route::get('/alumni-dashboard/alumni',[AlumniController::class,'alumni']);
    Route::post('/addalumni',[AlumniController::class,'updateAlumni']);
});