<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/task/store', 'TasksController@store')->name('task.store');
Route::put('/task/update/{task}', 'TasksController@update')->name('task.update');
Route::delete('/task/delete/{task}', 'TasksController@delete')->name('task.delete');

Route::post('/lead/store', 'LeadsController@store')->name('lead.store');
Route::put('/lead/update/{lead}', 'LeadsController@update')->name('lead.update');
Route::delete('/lead/delete/{lead}', 'LeadsController@delete')->name('lead.delete');
