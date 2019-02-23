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
Route::get('/home/{bv}/{khoa}/{cm}/{date}/{time}',[
    'as'=>'home',
    'uses'=>'HomeController@getHome'
]); 

// User
Route::get('/users/{id}/profile',[
    'as'=>'users.profile',
    'uses'=>'UserController@getProfile'
]);

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

Route::post('/posts/{id}/like', [
    'as'=>'posts.like',
    'uses'=>'ForumController@likePost'
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
 
Route::post('/comments/reply',[
    'as'=>'comments.reply',
    'uses'=>'CommentController@replyComment'
]);

Route::get('/comments/delete/{id}', [
    'as'=>'comments.delete',
    'uses'=>'CommentController@deleteComment'
]);

// Hospital A
Route::get('/create/table', [
    'as'=>'create.table',
    'uses'=>'HospitalAController@table'
]);

// Ajax
Route::get('ajax/khoa/{idKhoa}',[
    'as'=>'khoa.chuyenmon',
    'uses'=>'AjaxController@getChuyenmon'
]);

Route::get('ajax/benhvien/{ma_khoa}',[
    'as'=>'benhvien.khoa',
    'uses'=>'AjaxController@getKhoa'
]);