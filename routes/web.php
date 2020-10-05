<?php

use Illuminate\Support\Facades\Route;

use App\Task;

Route::get('/', 'PostController@index')->name('main');
Route::get('/posts/create', 'PostController@create')->name('post.create');
Route::get('/posts/{post}', 'PostController@show')->name('post.show');
Route::post('/posts', 'PostController@store')->name('post.store');;

Route::get('/about', function() {
    return view('about.index');
})->name('about');

Route::get('/contacts', 'MessageController@create')->name('contacts');
Route::post('/contacts', 'MessageController@store')->name('contacts.store');;;
Route::get('/admin/feedback', 'MessageController@index')->name('admin.feedback');


