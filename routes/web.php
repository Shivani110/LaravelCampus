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

Route::get('/',[UserController::class,'login']);
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
Route::get('/products',[PublicController::class,'products']);
Route::get('/productdetails/{slug}',[PublicController::class,'productdetails']);
Route::post('/addtocart',[PublicController::class,'createcart']);
Route::get('/viewcart',[PublicController::class,'cartItems']);
Route::post('/decreasequantity',[PublicController::class,'quantityMinus']);
Route::post('/increasequantity',[PublicController::class,'quantityPlus']);
Route::get('/checkout',[PublicController::class,'checkout']);
Route::post('/purchase',[PublicController::class,'payment']);
Route::get('/orderlist',[PublicController::class,'orderlist']);
Route::get('/orders',[PublicController::class,'orderdetail']);

Route::middleware(['Auth'=>'admin'])->group(function () {
    Route::get('/admin-dashboard',[AdminController::class,'admin']);
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
    Route::get('/admin-dashboard/product',[AdminController::class,'products']);
    Route::post('/admin-dashboard/addproduct',[AdminController::class,'addproducts']);
    Route::get('/admin-dashboard/getproduct',[AdminController::class,'getProducts']);
    Route::get('/admin-dashboard/product/{slug}',[AdminController::class,'editproducts']);
    Route::post('/admin-dashboard/updateproduct',[AdminController::class,'updateProduct']);
    Route::post('/admin-dashboard/deletemedia',[AdminController::class,'deleteMedia']);
    Route::get('/admin-dashboard/profile',[AdminController::class,'profile']);
    Route::get('/admin-dashboard/accountsetting',[AdminController::class,'accountsetting']);
    Route::get('/admin-dashboard/changepassword',[AdminController::class,'changePassword']);
    Route::post('/admin-dashboard/password',[AdminController::class,'password']);
});

Route::middleware(['Auth'=>'student'])->group(function() {
    Route::get('/student-dashboard',[StudentController::class,'studentIndex']);
    Route::get('/student-dashboard/student',[StudentController::class,'student']);
    Route::post('/addstudent',[StudentController::class,'updateStudent']);
    Route::get('/student-dashboard/profile',[StudentController::class,'profile']);
    Route::get('/student-dashboard/accountsetting',[StudentController::class,'accountsetting']);
    Route::get('/student-dashboard/changepassword',[StudentController::class,'changepassword']);
    Route::post('/student-dashboard/updatepassword',[StudentController::class,'updatepassword']);
});

Route::middleware(['Auth'=>'staff'])->group(function() {
    Route::get('/staff-dashboard',[StaffController::class,'staffIndex']);
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
    Route::get('/staff-dashboard/profile',[StaffController::class,'profile']);
    Route::get('/staff-dashboard/accountsetting',[StaffController::class,'accountsetting']);
    Route::get('/staff-dashboard/changepassword',[StaffController::class,'changepassword']);
    Route::post('/staff-dashboard/updatepassword',[StaffController::class,'updatepassword']);
});

Route::middleware(['Auth'=>'sponsor'])->group(function() {
    Route::get('/sponsor-dashboard',[SponsorController::class,'sponsorIndex']);
    Route::get('/sponsor-dashboard/sponsor',[SponsorController::class,'sponsor']);
    Route::post('/addsponsor',[SponsorController::class,'updateSponsor']);
    Route::get('/sponsor-dashboard/profile',[SponsorController::class,'profile']);
    Route::get('/sponsor-dashboard/accountsetting',[SponsorController::class,'accountsetting']);
    Route::get('/sponsor-dashboard/changepassword',[SponsorController::class,'changepassword']);
    Route::post('/sponsor-dashboard/updatepassword',[SponsorController::class,'updatepassword']);
});

Route::middleware(['Auth'=>'alumni'])->group(function() {
    Route::get('/alumni-dashboard',[AlumniController::class,'alumniIndex']);
    Route::get('/alumni-dashboard/alumni',[AlumniController::class,'alumni']);
    Route::post('/addalumni',[AlumniController::class,'updateAlumni']);
    Route::get('/alumni-dashboard/profile',[AlumniController::class,'profile']);
    Route::get('/alumni-dashboard/accountsetting',[AlumniController::class,'accountsetting']);
    Route::get('/alumni-dashboard/changepassword',[AlumniController::class,'changepassword']);
    Route::post('/alumni-dashboard/updatepassword',[AlumniController::class,'updatepassword']);
});