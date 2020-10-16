<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PostController@index')->name('main');

Route::get('/posts/tags/{tag}', 'TagController@index')->name('tags.index');
Route::resource('/posts', 'PostController');
Route::resource('/news', 'NewsController');

Route::view('/about', 'about.index')->name('about');
Route::get('/contacts', 'MessageController@create')->name('contacts');
Route::post('/contacts', 'MessageController@store')->name('contacts.store');;

Route::get('/admin/feedback', 'AdminController@allMessages')->name('admin.feedback')->middleware('admin');
Route::get('/admin/posts', 'AdminController@allPosts')->name('admin.posts')->middleware('admin');
Route::patch('/admin/posts/publicate/{post}', 'AdminController@postPublicate')
    ->name('admin.posts.publicate')
    ->middleware('admin');

Route::get('/admin/statistics', 'AdminController@statistics')->name('admin.statistics')->middleware('admin');
Route::get('/admin/news', 'AdminController@allNews')->name('admin.news')->middleware('admin');

Auth::routes();
