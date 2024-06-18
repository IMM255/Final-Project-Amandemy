<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('home');


Route::get('/pengaduan', [HomeController::class, 'pengaduan'])->name('pengaduan');
Route::get('/pengaduan/{id}', [HomeController::class, 'pengaduanDetail'])->name('pengaduan.detail');

Route::middleware(['auth'])->group(function () {

Route::get('/buat-pengaduan', [HomeController::class, 'buatPengaduan'])->name('buat.pengaduan');
Route::post('/buat-pengaduan', [HomeController::class, 'pengaduanProcess'])->name('pengaduan.store');
Route::get('/pengaduanku', [HomeController::class, 'pengaduanKu'])->name('pengaduanku');

Route::delete('/pengaduanku/{complaint}',[ComplaintController::class,'destroy'])->name('complaint.delete');

Route::resource('profile',ProfileController::class);

Route::post('/complaints/{complaint}/vote', [VoteController::class, 'vote'])->name('vote');

Route::get('cetaklaporan', [ReportController::class, 'cetaklaporan']);
Route::get('laporanExcel', [ReportController::class, 'laporanExcel']);

});


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerProcess'])->name('register');
Route::post('login', [AuthController::class, 'loginProcess'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('contact', [AuthController::class, 'registerProcess'])->name('contact');


// ADMIN
Route::middleware(['auth','admin'])->group(function () {

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('complaint',ComplaintController::class);
Route::resource('category',CategoryController::class);
Route::resource('user',UserController::class);
Route::resource('report',ReportController::class);
Route::post('response', [ResponseController::class, 'response'])->name('response');
Route::post('response/{complaint_id}', [ResponseController::class, 'responseFinish'])->name('response.finish');

});
