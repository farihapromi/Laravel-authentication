<?php

use App\Http\Controllers\AdminPostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;

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



Auth::routes();
Route::get('/', function () {
    return view('authWelcome');
});

//Normal Users Routes List

Route::middleware(['auth', 'user-access:user'])->group(function () {
    Route::get('/home', [AdminPostController::class, 'showApprovedPosts'])->name('user.home');
    Route::get('/', function () {
        return view('authWelcome');
    });
});




//Admin Routes List


Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/admin/posts/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/admin/posts/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('/admin/posts', [AdminPostController::class, 'index'])->name('admin.posts.index');


    Route::get('/admin/posts/create', [AdminPostController::class, 'create'])->name('admin.posts.create');

    Route::post('/admin/posts', [AdminPostController::class, 'store'])->name('admin.posts.store');

    Route::post('/admin/posts/{post}/submit-for-review', [AdminPostController::class, 'submitForReview'])->name('admin.posts.submitForReview');
});


//Super Admin Routes List

Route::middleware(['auth', 'user-access:superadmin'])->group(function () {



    Route::get('/superadmin/posts', [SuperAdminController::class, 'showSubmittedPosts'])->name('superadmin.posts');
    Route::put('/superadmin/posts/{post}/{action}', [SuperAdminController::class, 'reviewPost'])
        ->where(['action' => 'approve|reject'])
        ->name('superadmin.posts.review');

});
