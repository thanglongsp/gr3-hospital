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

Auth::routes();

// Home
Route::get('/home', function () {
    return view('home');
})->name('home'); 

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

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

// Forum
Route::get('/forum',[
    'as'=>'forum',
    'uses'=>'ForumController@show'
]);

Route::post('/users/post', [
    'as'=>'users.post',
    'uses'=>'ForumController@post'
]);

// Comments
Route::get('test', [
    'as'=>'test',
    'uses'=>'CommentController@getComment'
]);

Route::post('/users/{id}/comment/post/{post_id}',[
    'as'=>'post_comment',
    'uses'=>'CommentController@postComment'
]);

Route::post('/comments/edit',[
    'as'=>'comments.edit',
    'uses'=>'CommentController@editComment'
]);

Route::get('/comments/delete/{id}', [
    'as'=>'comments.delete',
    'uses'=>'CommentController@deleteComment'
]);