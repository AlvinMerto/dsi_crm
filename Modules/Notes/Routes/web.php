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

Route::group(['middleware' => 'PlanModuleCheck:Notes'], function () {
    Route::resource('notes', 'NotesController')->middleware(['auth']);
    Route::get('notes/create/{type}/{id}', 'NotesController@create')->name('notes.create')->middleware(['auth']);
});
