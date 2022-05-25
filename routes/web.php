<?php

use App\Http\Controllers\UrlRedirectController;
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
	return view('main');
});

Route::get('/notfound', function () {
	return view('notfound');
});

Route::get('/{param1}/{param2?}', [UrlRedirectController::class, 'index'])->middleware('hash.folder');