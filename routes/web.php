<?php

use App\Http\Controllers\AdminPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
    return view('authWelcome');
});

Auth::routes();


//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//Admin Routes List
// Route::middleware(['auth', 'user-access:admin'])->group(function () {

//     Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
//     // Route::get('/admin/posts/{post}/edit', 'AdminPostController@edit')->name('admin.posts.edit');
//     // Route::put('/admin/posts/{post}', 'AdminPostController@update')->name('admin.posts.update');
//     // Route::delete('/admin/posts/{post}', 'AdminPostController@destroy')->name('admin.posts.destroy');
//     Route::get('/admin/posts', [AdminPostController::class, 'create'])->name('admin.posts.index');
//     Route::post('/admin/posts', 'AdminPostController@store')->name('admin.posts.store');


// });

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');
    // Add a route for creating a post

    Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    // Add a route for storing a post
    Route::post('/admin/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');
});


//Super Admin Routes List
Route::middleware(['auth', 'user-access:superadmin'])->group(function () {

    Route::get('/superadmin/home', [HomeController::class, 'superAdmin'])->name('superadmin.home');
});
