<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\adminController;
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
Route::get('/', [homeController::class, 'index']); 

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [homeController::class, 'redirect'])->middleware('auth', 'verified'); 
Route::get('/view_category', [adminController::class, 'category']);
Route::post('/add_category', [adminController::class, 'storeCategory']);
Route::get('/delete_category/{id}', [adminController::class, 'delete_category']);
Route::get('/view_product', [adminController::class, 'view_product']);
Route::post('/add_product', [adminController::class, 'add_product']);
Route::get('/show_product', [adminController::class, 'show_product']);
Route::get('/delete_product/{id}', [adminController::class, 'delete_product']);
Route::get('/edit_product/{id}', [adminController::class, 'update_product']);
Route::post('/update_product/{id}', [adminController::class, 'update_product_store']);
Route::get('/orders', [adminController::class, 'orders']);
Route::get('/delivered/{id}', [adminController::class, 'delivered']);
Route::get('/Print_pdf/{id}', [adminController::class, 'Print_pdf']);
Route::get('/send_email/{id}', [adminController::class, 'send_email']);
Route::post('/send_user_email/{id}', [adminController::class, 'send_user_email']);
Route::get('/search', [adminController::class, 'search']);
Route::get('/product_details/{id}', [homeController::class, 'product_details']);
Route::post('/add_cart/{id}', [homeController::class, 'add_cart']);
Route::get('/show_cart', [homeController::class, 'show_cart']);
Route::get('/remove_cart/{id}', [homeController::class, 'remove_cart']);
Route::get('/cash_order', [homeController::class, 'cash_order']);
Route::get('/rozarpay/{totalPrice}', [homeController::class, 'rozarpay']);
Route::post('razorpay-payment/{totalPrice}', [homeController::class, 'store'])->name('razorpay.payment.store');
Route::get('/show_order', [homeController::class, 'show_order']);
Route::get('/cancel_order/{id}', [homeController::class, 'cancel_order']);

Route::post('/add_comment', [homeController::class, 'add_comment']);
Route::post('/add_reply', [homeController::class, 'add_reply']);
Route::get('/product_search', [homeController::class, 'product_search']);



