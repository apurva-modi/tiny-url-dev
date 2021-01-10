<?php

use App\Http\Controllers\ShortenLinkController;
use App\Http\Controllers\ShortenLinkRedirectController;
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

Route::get('/', [ShortenLinkController::class,'index'])->name('home');
Route::post('/', [ShortenLinkController::class,'store']);

Route::post('/api/generate-link/', [ShortenLinkController::class,'apiStore']);

Route::get('{slug}', [ShortenLinkRedirectController::class,'shortenLink'])->name('redirectURL');
