<?php

use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\BadanAmalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';




Route::middleware('guest')->group(function() {
    // Register Admin Badan Amal
    Route::get('admin/register', [AuthController::class, 'register'])->name('register.badan-amal');
});

// Role : Admin Badan Amal
Route::group(['middleware' => 'role:admin'], function() {
    Route::get('admin/register/badan-amal', [BadanAmalController::class, 'create'])->name('create');
});

Route::group(['middleware' => 'auth'],  function() {

    // Role : Admin Badan Amal
    Route::group(['middleware' => 'role:admin'], function() {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });


    // Role : Donatur
    Route::group(['middleware' => 'role:donatur'], function() {

    });

});
