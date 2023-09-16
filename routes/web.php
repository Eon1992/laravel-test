<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/notifications', [HomeController::class, 'notifications'])->name('notifications');

Route::get('/createNotification', [HomeController::class, 'addNotification'])->name('createNotification');

Route::get('/getUserProfile/{id}', [HomeController::class, 'getUserProfile'])->name('getUserProfile');

Route::get('/updateUserNotifications/{id}/{uid}', [HomeController::class, 'updateUserNotifications']);

Route::get('/getUserNotifications/{id}', [HomeController::class, 'getUserNotifications']);

Route::post('/saveNotification', [HomeController::class, 'saveNotification'])->name('saveNotification');

Route::post('/updateUserProfile', [HomeController::class, 'updateUserProfile'])->name('updateUserProfile');

Route::post('/sendOtp', [HomeController::class, 'sendOtp'])->name('sendOtp');

Route::post('/verifyOtp', [HomeController::class, 'verifyOtp'])->name('verifyOtp');
