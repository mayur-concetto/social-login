<?php

use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('auth/google', [GoogleAuthController::class, 'googleAuth'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);
Route::get('/linkedin', [GoogleAuthController::class, 'linkedinAuth'])->name('linkedin-auth');
Route::get('/linkedin/callback', [GoogleAuthController::class, 'callbackLinkedin']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
