<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/registerbylink', [RegisterController::class, 'saveFromLink'])->name('registerbylink');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::post("/send-email", [PHPMailerController::class, "composeEmail"])->name("send-email");
Route::resource('/profile', ProfileController::class);
Route::get('/register/{referral?}-{source?}', [RegisterController::class, 'createFromLink'])->name('referred');

// ADMINISTRATION
Route::get('/admin', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin', [AdminAuthController::class, 'register'])->name('admin.signup');
// Admin Login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.signin');
// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth:admin');
// Admin Logout
Route::post('/admin/logout', 'AdminAuthController@logout')->name('admin.logout');

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
