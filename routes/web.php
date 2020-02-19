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

Route::get('/', 'frontendController@index')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('blog/posts/{post}', 'postcontroller@show')->name('blog.show');
Route::get('blog/tags/{tag}', 'tagControler@show')->name('blog.tags');
//Route::resource('/categories', 'categorycontroller');
//Route::resource('/posts', 'postcontroller');

route::get('trushed-post','postcontroller@trushed')->name('trushed.index');
route::get('trushed-post{id}','postcontroller@restore')->name('trushed.restore');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/categories', 'categorycontroller');
    Route::resource('/posts', 'postcontroller');
    Route::resource('tags', 'tagControler');
    route::get('trushed-post','postcontroller@trushed')->name('trushed.index');
    route::get('trushed-post{id}','postcontroller@restore')->name('trushed.restore');
});

    Route::group(['auth','admin'], function () {
    Route::get('/dashboard', 'dashboardcontroller@index')->name('dashboard');
    Route::get('users/{user}/profile','usercontroller@editProfile')->name('users.profile');
    Route::get('users','usercontroller@index')->name('users.index');
    Route::get('users/create','usercontroller@create')->name('users.create');
    route::get('users/{id}/makeAdmin','usercontroller@makeAdmin')->name('user.makeAdmin');
    route::get('users/{id}','usercontroller@makeWriter')->name('user.makeWriter');
});
Route::group(['auth',], function () {
    Route::get('users/{user}/profile','usercontroller@profile')->name('users.profile');
    Route::post('users/{user}/edit','usercontroller@update')->name('users.update');
});

