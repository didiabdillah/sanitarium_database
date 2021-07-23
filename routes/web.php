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

Route::get('/', 'HomeController@index');

//Home
Route::group(['prefix' => 'home'], function () {
    Route::get('/', 'HomeController@index')->name('home');
});

//Resource
Route::group(['prefix' => 'resource'], function () {
    Route::get('/', 'ResourceController@index')->name('resource');
    Route::get('/insert', 'ResourceController@create')->name('resource_create');
    Route::post('/insert', 'ResourceController@store')->name('resource_store');
    Route::get('/{id}/edit', 'ResourceController@edit')->name('resource_edit');
    Route::patch('/{id}/edit', 'ResourceController@update')->name('resource_update');
    Route::delete('/{id}/destroy', 'ResourceController@destroy')->name('resource_destroy');
});

//Source
Route::group(['prefix' => 'source'], function () {
    Route::get('/', 'SourceController@index')->name('source');
});

//Author
Route::group(['prefix' => 'author'], function () {
    Route::get('/', 'AuthorController@index')->name('author');
    Route::get('/insert', 'AuthorController@create')->name('author_create');
    Route::post('/insert', 'AuthorController@store')->name('author_store');
    Route::get('/{id}/edit', 'AuthorController@edit')->name('author_edit');
    Route::patch('/{id}/edit', 'AuthorController@update')->name('author_update');
    Route::delete('/{id}/destroy', 'AuthorController@destroy')->name('author_destroy');
});

//Category
Route::group(['prefix' => 'category'], function () {
    Route::get('/', 'CategoryController@index')->name('category');
});

//Sub Category
Route::group(['prefix' => 'subcategory'], function () {
    Route::get('/', 'SubCategoryController@index')->name('subcategory');
});
