<?php

use App\Http\Controllers\FrontpageController;
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

Route::get('/', FrontpageController::class)->name('home');

Route::get('tweets', [\App\Http\Controllers\TweetController::class, 'index'])->name('tweets.index');
Route::get('tweet/{id}', [\App\Http\Controllers\TweetController::class, 'show'])->name('tweets.single');
