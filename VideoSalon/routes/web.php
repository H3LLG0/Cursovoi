<?php

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
})->name('main');

Route::get('/sales', function () {
    return view('sales');
})->name('sales');
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');
Route::post('/login/submit', function () {
    dd(Request::all());
})->name('login-form');
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/register/submit', [App\Http\Controllers\RegisterController::class,'RegisterUser'])->name('register-form');