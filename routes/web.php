<?php

use App\Http\Controllers\Backend\HeaderController;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;
use App\Http\Controllers\ProfileController;
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

Route::get('/admin/dashboard', function () {
    return view('backend/index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Backend All Route
// Profile Controller
Route::controller(BackendProfileController::class)->group(function() {
    // Logout
    Route::get('/admin/logout', 'destroy')->name('admin.logout');

    // update profile
    Route::get('/admin/my-profile', 'ProfileSetting')->name('profile.setting');
    Route::patch('/admin/my-profile/store', 'ProfileStore')->name('store.profile');
    Route::patch('/admin/my-profile/update-password', 'UpdatePassword')->name('update.password');
});


Route::controller(HeaderController::class)->group(function() {
    // Icon Class
    Route::get('/admin/icon/remix-icon', 'RemixIconShow')->name('remix.icon');
    Route::get('/admin/icon/material-icon', 'MaterialIconShow')->name('material.icon');
    Route::get('/admin/icon/fontawesome-icon', 'FontawesomeIconShow')->name('fontawesome.icon');
});


//file manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
