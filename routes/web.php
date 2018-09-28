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

Auth::routes();

Route::get('/login/github', 'Auth\LoginController@redirectToProvider')                  ->name('login.github');
Route::get('/login/github/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/story/', 'StoryController@index')                                    ->name('story.index');
Route::get('/admin/story/create', 'StoryController@create')                             ->name('story.create');
Route::post('/admin/story/', 'StoryController@store')                                   ->name('story.store');
Route::get('/admin/story/{id}', 'StoryController@show')                                 ->name('story.show');
// Route::get('/admin/story/{id}/edit', 'StoryController@edit')                            ->name('story.edit');
Route::patch('/admin/story/{id}/update', 'StoryController@update')                      ->name('story.update');
Route::delete('/admin/story/{id}/delete', 'StoryController@delete')                     ->name('story.delete');
Route::delete('/admin/story/{id}/destroy', 'StoryController@destroy')                   ->name('story.destroy');
Route::post('/admin/story/{id}/restore', 'StoryController@restore')                     ->name('story.restore');

Route::get('/admin/tag/', 'TagController@index')                                        ->name('tag.index');
Route::get('/admin/tag/create', 'TagController@create')                                 ->name('tag.create');
Route::post('/admin/tag/', 'TagController@store')                                       ->name('tag.store');
Route::get('/admin/tag/{id}', 'TagController@show')                                     ->name('tag.show');
Route::get('/admin/tag/{id}/edit', 'TagController@edit')                                ->name('tag.edit');
Route::patch('/admin/tag/{id}/update', 'TagController@update')                          ->name('tag.update');
Route::delete('/admin/tag/{id}/destroy', 'TagController@destroy')                       ->name('tag.destroy');