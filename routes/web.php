<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('home.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('/',[HomeController::class, 'login_home']);
route::get('/dashboard',[HomeController::class, 'home'])
->middleware(['auth', 'verified'])->name('dashboard');;

route::get('admin/dashboard',[HomeController::class,'index']);

route::get('view_category',[AdminController::class,'view_category']);
route::post('add_category',[AdminController::class,'add_category']);

route::get('delete_category/{id}',[AdminController::class,'delete_category']);

route::get('edit_category/{id}',[AdminController::class,'edit_category']);
route::post('update_category/{id}',[AdminController::class,'update_category']);

route::get('add_product',[AdminController::class,'add_product']);
route::post('upload_product',[AdminController::class,'upload_product']);

route::get('view_product',[AdminController::class,'view_product']);

route::get('delete_product/{id}',[AdminController::class,'delete_product']);

route::get('update_product/{id}',[AdminController::class,'update_product']);
route::post('edit_product/{id}',[AdminController::class,'edit_product']);

route::get('product_search',[AdminController::class,'product_search']);
