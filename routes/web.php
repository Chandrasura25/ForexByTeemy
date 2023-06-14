<?php

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
Route::get('/register/{referral?}/{source?}', [RegisterController::class, 'createFromLink'])->name('referred');
Route::get('/admin', [AdminController::class, 'index']);

// Private Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/admindashboard', [AdminController::class,'dashboard'])->name('dashboard');

});
