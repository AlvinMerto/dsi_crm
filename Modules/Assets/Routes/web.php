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

Route::group(['middleware' => 'PlanModuleCheck:Assets'], function () {
    Route::resource('asset', 'AssetsController')->middleware(['auth']);

    // Assets import
    Route::get('asset/import/export', 'AssetsController@fileImportExport')->name('assets.file.import')->middleware(['auth']);
    Route::post('asset/import', 'AssetsController@fileImport')->name('assets.import')->middleware(['auth']);
    Route::get('asset/import/modal', 'AssetsController@fileImportModal')->name('assets.import.modal')->middleware(['auth']);
    Route::post('asset/data/import/', 'AssetsController@assetsImportdata')->name('assets.import.data')->middleware(['auth']);
});
