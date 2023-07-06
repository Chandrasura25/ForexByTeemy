<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\ClickController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OpenAIController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
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
Route::get('/store',[StoreController::class,'index'])->name('store');
Auth::routes(); 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');   
Route::post("/send-email", [PHPMailerController::class, "composeEmail"])->name("send-email");
Route::get('/register/{referral}', [RegisterController::class, 'FromLink'])->name('refer');
Route::get('/register/{referral?}-{source?}', [RegisterController::class, 'createFromLink'])->name('referred');
Route::post('/registerbylink', [RegisterController::class, 'saveFromLink'])->name('registerbylink');
Route::post('/upload',[App\Http\Controllers\HomeController::class,'uploadImg'])->name('upload');
Route::post('/update',[App\Http\Controllers\HomeController::class,'update'])->name('update');
Route::post('/updatePass',[App\Http\Controllers\HomeController::class,'updatePassword'])->name('updatePass');
Route::resource('/sales', SaleController::class);
Route::resource('/affiliate', AffiliateController::class);
Route::resource('/click',ClickController::class);
Route::resource('/coupon',CouponController::class);
Route::post('/status/{coupon}', [CouponController::class, 'toggleStatus'])->name('coupons.toggleStatus');
Route::get('/credit',[CreditController::class,'index'])->name('credit');
// CHATBOT
Route::post('/bot',[OpenAIController::class,'chatOpenAi'])->name('chatbot');


// ADMINISTRATION
Route::get('/admin', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin', [AdminAuthController::class, 'register'])->name('admin.signup');
// Admin Login
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.signin');
// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.update');
Route::post('/admin/updatePassword', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');
Route::post('/admin/updateImage', [AdminController::class, 'updateImage'])->name('admin.updateImage');
// Admin Products
Route::resource('/product', ProductController::class);
// Admin Logout
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::get('/{any?}', function ($any = null) {
    if ($any) {
        $segments = explode('/', $any);
        $lastSegment = end($segments);
        
        // Check if the specific route exists, if not, redirect to the parent route
        if (!Route::has($lastSegment)) {
            array_pop($segments);
            $parentRoute = implode('/', $segments);
            return redirect($parentRoute);
        }
    }

    return view('welcome');
})->where('any', '.*');


// Route::get('/{any}', function ($any) {
//     session_start();
//     $_SESSION['ref'] = substr(strrchr(request()->getRequestUri(), '/'), 1);
//     $newlink = substr(request()->getRequestUri(), 1, strrpos(request()->getRequestUri(), '/'));
//     $AffiliateName = substr(strrchr(request()->getRequestUri(), '/'), 1);
//     $ServerName = request()->getHost();
//     $CompleteUrl = request()->getRequestUri();
//     $AffiliateUrl = "/coupon=" . $AffiliateName;
//     $LeftoverUrl = substr(request()->getRequestUri(), 0, strrpos(request()->getRequestUri(), '/'));
//     $LeftoverUrl = ltrim($LeftoverUrl, "/\\");
//     $FullLink = url('/') . '/' . $LeftoverUrl;
//     $FullServerName = url('/');

//     if ($LeftoverUrl == "") {
//         echo "none found " . $FullServerName;
//         return Redirect::away($FullServerName);
//     }

//     if (file_exists($LeftoverUrl)) {
//         echo "Link Found" . $FullLink;
//         return Redirect::away($FullLink);
//     }

//     echo "going home " . $FullServerName;
//     return Redirect::away($FullServerName);
// })->where('any', '.*');

