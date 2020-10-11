<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PostController@index')->name('main');

Route::get('/posts/tags/{tag}', 'TagController@index')->name('tags.index');
Route::resource('/posts', 'PostController');

Route::view('/about', 'about.index')->name('about');
Route::get('/contacts', 'MessageController@create')->name('contacts');
Route::post('/contacts', 'MessageController@store')->name('contacts.store');;;
Route::get('/admin/feedback', 'MessageController@index')->name('admin.feedback');

Auth::routes();
