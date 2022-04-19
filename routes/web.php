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

Route::get('/contact-us', 'App\Http\Controllers\FrontController@contact')->name('contact');
Route::post('/contact-us', 'App\Http\Controllers\FrontController@contactStore')->name('contact.store');


Route::get('/', 'App\Http\Controllers\FrontController@index')->name('home');

//blog
Route::get('blog/search/', 'App\Http\Controllers\FrontController@searchBlog')->name('searchBlog');

Route::get('blog/{slug}','App\Http\Controllers\FrontController@blogSingle')->name('blog.single');
Route::get('/blog/categories/{slug}', 'App\Http\Controllers\FrontController@blogCategories')->name('blog.category');
Route::get('/blog', 'App\Http\Controllers\FrontController@blogs')->name('blog.frontend');
//end blog

Route::group(['prefix' => 'auth', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    //signed-in user routes
    Route::get('/profile/{slug?}', 'App\Http\Controllers\UserController@profile')->name('profile');
    Route::get('/filemanager', 'App\Http\Controllers\HomeController@filemanager')->name('filemanager');
    Route::get('/profile/edit/{slug}', 'App\Http\Controllers\UserController@profileEdit')->name('profile.edit');
    Route::post('/profile/socials/', 'App\Http\Controllers\UserController@socialsUpdate')->name('profile.socials');
    Route::put('/profile/{id}/update', 'App\Http\Controllers\UserController@profileUpdate')->name('user.update');
    Route::post('/user-image/update/', 'App\Http\Controllers\UserController@imageupdate')->name('user.imageupdate');
    Route::post('/profile/oldpassword', 'App\Http\Controllers\UserController@checkoldpassword')->name('user.oldpassword');
    Route::post('/profile/password', 'App\Http\Controllers\UserController@profilepassword')->name('user.password');
    Route::post('/user/removeaccount', 'App\Http\Controllers\UserController@removeAccount')->name('user.removeaccount');
    //end of signed-in user routes

    Route::get('/user-management', 'App\Http\Controllers\UserController@alluser')->name('alluser');
    Route::get('/user-management/create', 'App\Http\Controllers\UserController@create')->name('user.create');
    Route::post('/user-management/store', 'App\Http\Controllers\UserController@store')->name('user.store');
    Route::delete('/user-management/{id}', 'App\Http\Controllers\UserController@destroy')->name('user.destroy');
    Route::patch('/status/{id}/update', 'App\Http\Controllers\UserController@statusupdate')->name('user-status.update');

});


Route::get('/{page}', 'App\Http\Controllers\FrontController@page')
    ->name('page');
