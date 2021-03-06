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

Route::get('/', 'HomeController@index')->name('home');

/**
 * Topics
 */
Route::get('/topics','TopicController@index');
Route::post('/topic/new','TopicController@store');
Route::get('/topic/{topic}','TopicController@show');
Route::put('/topic/{topic}','TopicController@update');
Route::delete('/topic/{topic}','TopicController@destroy');
/**
 * Posts
 */
Route::get('/topic/{topic}/posts','PostController@index');
Route::post('/topic/{topic}/post/new','PostController@store');
Route::get('/topic/{topic}/post/{post}','PostController@show');
Route::put('/topic/{topic}/post/{post}','PostController@update');
Route::delete('/topic/{topic}/post/{post}','PostController@destroy');
/**
 * Comments
 */
 Route::get('/topic/{topic}/post/{post}/comments','CommentController@index');
 Route::post('/topic/{topic}/post/{post}/comment/new','CommentController@store');
 Route::get('/topic/{topic}/post/{post}/comment/{comment}','CommentController@show');
 Route::put('/topic/{topic}/post/{post}/comment/{comment}','CommentController@update');
 Route::delete('/topic/{topic}/post/{post}/comment/{comment}','CommentController@destroy');
 
 
 