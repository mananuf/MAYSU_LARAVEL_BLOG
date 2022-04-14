<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


// ---------------- HOME ROUTE -------------------
Route::get('/', 'PagesController@index');



// ----------------- ABOUT ROUTE ------------------
Route::get('/about', 'PagesController@about');



// ----------------- services ROUTE ------------------
Route::get('/services', 'PagesController@services');


// ----------------- posts ROUTE -----------------
Route::resource('posts', 'PostsController');

// Route::post('posts', 'PostsController@update');
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
