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
// Route::get('/', 'AuthController@login')->name('login');
// Route::get('auth/steam', 'AuthController@redirectToSteam')->name('auth_steam');
// Route::get('auth/steam/handle', 'AuthController@handle')->name('auth_steam_handle');
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Home
Route::group(['prefix' => 'home'], function () {
    Route::get('/', 'HomeController@index')->name('home');
});

//Resource
Route::group(['prefix' => 'resource'], function () {
    Route::get('/', 'ResourceController@index')->name('resource');
    Route::get('/{id}/show', 'ResourceController@show')->name('resource_show');
    Route::get('/insert', 'ResourceController@create')->name('resource_create');
    Route::post('/insert', 'ResourceController@store')->name('resource_store');
    Route::get('/{id}/edit', 'ResourceController@edit')->name('resource_edit');
    Route::patch('/{id}/edit', 'ResourceController@update')->name('resource_update');
    Route::delete('/{id}/destroy', 'ResourceController@destroy')->name('resource_destroy');

    Route::get('/{id}/edit/status', 'ResourceController@status_edit')->name('resource_status_edit');
    Route::patch('/{id}/edit/status', 'ResourceController@status_update')->name('resource_status_update');

    Route::get('/{id}/link/status', 'ResourceController@link_status')->name('resource_link_status');
    Route::get('/{id}/image/status', 'ResourceController@image_status')->name('resource_image_status');
});

//Source
Route::group(['prefix' => 'source'], function () {
    Route::get('/', 'SourceController@index')->name('source');
    Route::get('/insert', 'SourceController@create')->name('source_create');
    Route::post('/insert', 'SourceController@store')->name('source_store');
    Route::get('/{id}/edit', 'SourceController@edit')->name('source_edit');
    Route::patch('/{id}/edit', 'SourceController@update')->name('source_update');
    Route::delete('/{id}/destroy', 'SourceController@destroy')->name('source_destroy');
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
    Route::get('/insert', 'CategoryController@create')->name('category_create');
    Route::post('/insert', 'CategoryController@store')->name('category_store');
    Route::get('/{id}/edit', 'CategoryController@edit')->name('category_edit');
    Route::patch('/{id}/edit', 'CategoryController@update')->name('category_update');
    Route::delete('/{id}/destroy', 'CategoryController@destroy')->name('category_destroy');
});

//Sub Category
Route::group(['prefix' => 'subcategory'], function () {
    Route::get('/', 'SubCategoryController@index')->name('sub_category');
    Route::get('/insert', 'SubCategoryController@create')->name('sub_category_create');
    Route::post('/insert', 'SubCategoryController@store')->name('sub_category_store');
    Route::get('/{id}/edit', 'SubCategoryController@edit')->name('sub_category_edit');
    Route::patch('/{id}/edit', 'SubCategoryController@update')->name('sub_category_update');
    Route::delete('/{id}/destroy', 'SubCategoryController@destroy')->name('sub_category_destroy');
});
