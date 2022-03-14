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

Auth::routes();

Auth::routes([
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::any('/register', function() {
    abort(404);
});

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'auth', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //signed-in user routes
    Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('profile');
    Route::get('/filemanager', 'App\Http\Controllers\HomeController@filemanager')->name('filemanager');
//    Route::put('/profile/{id}/update', 'App\Http\Controllers\UserController@update')->name('user.update');
//    Route::put('/profileimage/{id}/update', 'App\Http\Controllers\UserController@imageupdate')->name('user.imageupdate');
//    Route::put('/profile/password', 'App\Http\Controllers\UserController@profilepassword')->name('user.password');
    //end of signed-in user routes


});


