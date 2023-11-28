<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\flight\FlightinController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|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
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view("interpol.login");
});
Route::prefix('/eafrican')->group(function () {
    Route::middleware(['guest'])->group(function () {
      Route::get('/login/admin', [AdminController::class, 'showlogin'])->name('adminlogin');
      Route::get('/login/member', [MemberController::class, 'showlogin'])->name('memberlogin');
     // Route::get('/register/admin', [AdminController::class, 'showregister'])->name('adminregister');
     // Route::get('/register/member', [MemberController::class, 'showregister'])->name('memberregister');
      Route::post('/login/member', [MemberController::class, 'checklogin'])->name('memberlogincheck');
      Route::post('/login/admin', [AdminController::class, 'checklogin'])->name('adminlogincheck');

    });

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'showdashboard'])->name('admindashboard');
    Route::post('/admin/dashboard', [AdminController::class, 'registermember'])->name('adminmregister');
    Route::get('/admin/member/list', [AdminController::class, 'adminmemberlist'])->name('adminmemberlist');
    Route::get('/admin/account/list', [AdminController::class, 'adminaccountlist'])->name('adminaccountlist');
    Route::get('/admin/member/badge/{id}', [AdminController::class, 'adminmemberbadge'])->name('adminmemberbadge');
    Route::get('/admin/member/edit/{id}', [AdminController::class, 'adminmemberedit'])->name('adminmemberedit');
    Route::post('/admin/member/edit/{id}', [AdminController::class, 'adminmemberupdate'])->name('adminmemberupdate');
    Route::post('/admin/member/delete', [AdminController::class, 'adminmemberdelete'])->name('adminmemberdelete');
    Route::get('/admin/account/create', [AdminController::class, 'createacount'])->name('admincreateaccount');
    Route::post('/admin/account/create', [AdminController::class, 'insertacount'])->name('admininsertaccount');
    Route::get('/admin/passport/download/{filename}', [AdminController::class, 'readpdf'])->name('passportpdf');
    Route::get('/admin/member/flight/information', [AdminController::class, 'memberflight'])->name('adminmemberflight');
    Route::get('/admin/member/flight/details/{id}', [AdminController::class, 'flightdetails'])->name('flightdetailsinfo');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('adminlogout');
    
});

Route::middleware(['auth:member'])->group(function () {
    Route::get('/member/home', [MemberController::class, 'showdashboard'])->name('memberhome');
    Route::get('/member/dashboard', [MemberController::class, 'showmemberregisteration'])->name('memberdashboard');
    Route::post('/member/dashboard', [MemberController::class, 'memberregister'])->name('memberregister');
    Route::get('/member/regiser/{id}', [MemberController::class, 'memberprofile'])->name('memberprofile');
    Route::get('/member/profile/search', [MemberController::class, 'membersearchpage'])->name('membersearchpage');
    Route::get('/member/flight/departure', [FlightinController::class, 'flightpass'])->name('memberflight');
    Route::post('/member/flight/search', [FlightinController::class, 'flightcheck'])->name('flight.search');
    Route::get('/member/flight/in/{id}', [FlightinController::class, 'getflightin'])->name('flight.showin');
    Route::post('/member/flight/in/{id}', [FlightinController::class, 'flightin'])->name('flight.addin');
    Route::get('/member/flight/details/{id}', [FlightinController::class, 'flightout'])->name('flight.details');
    Route::post('/member/search', [MemberController::class, 'membersearch'])->name('membersearch');
    Route::get('/member/edit/{id}', [MemberController::class, 'membereditprofile'])->name('membereditprofile');
    Route::post('/member/edit/{id}', [MemberController::class, 'memberupdateprofile'])->name('memberupdateprofile');
    Route::get('/member/information/about-covid', [MemberController::class, 'covidinformation'])->name('covidinformation');
    Route::get('/member/information/about-tourism', [MemberController::class, 'tourisminformation'])->name('tourisminformation');
    Route::get('/member/information/ethiopian/currency', [MemberController::class, 'currencyinformation'])->name('currencyinformation');

    Route::post('/member/logout', [MemberController::class, 'logout'])->name('memberlogout');
});
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
