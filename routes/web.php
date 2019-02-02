<?php

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

Route::get('/home', function () {
    return view('home');
})->name('home'); 

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Auth::routes();

// User
Route::get('/users/{id}/profile', function(){
    return view('users.profile');
})->name('users.profile');

Route::post('/users/{id}/update/profile',[
    'as'=>'users.update_profile',
    'uses'=>'UserController@updateUserProfile'
]);

Route::post('/users/{id}/update/picture',[
    'as'=>'users.update_picture',
    'uses'=>'UserController@updateUserPicture'
]);