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

Route::get('/', function () {
    return view('welcome');
});

//Route::resource('rest', 'RestTestController')->names('restTest');

Route::group(['namespace' => 'Blog' , 'prefix' => 'blog'], function (){
   Route::resource('posts', 'PostController')->names('blog.posts');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// ------ for testing collection -----
Route::group(['prefix' => 'digging_deeper'], function (){
    Route::get('collections', 'DiggingDeeperController@collections')->name('digging_deeper.collection');
});


Route::group(['namespace' => 'Blog\Admin' , 'prefix' => 'admin/blog'], function (){

    Route::resource('categories', 'CategoryController')
        ->only(['index','store','edit','update','create',])
        ->names('blog.admin.categories');

    Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
    Route::get('/posts/{id}/restore', 'PostController@restore')->name('blog.admin.posts.restore');
});
