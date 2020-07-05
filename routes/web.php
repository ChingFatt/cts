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

Route::get('/', 'VisitorController@form')->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('block','BlockController');

    Route::get('block/get_units', [
        'as' => 'block.get_units',
        'uses' => 'BlockController@get_units',
    ]);

    Route::resource('occupant','OccupantController');

    Route::resource('unit','UnitController');
});

Route::group(['prefix' => 'visitor', 'as' => 'visitor.', 'middleware' => ['auth']], function () {
    Route::get('/', [
        'as' => 'index',
        'uses' => 'VisitorController@index',
    ]);
    Route::post('checkin', [
        'as' => 'checkin',
        'uses' => 'VisitorController@checkin',
    ]);
    Route::put('checkout/{visitor}', [
        'as' => 'checkout',
        'uses' => 'VisitorController@checkout',
    ]);
});

Route::group(['prefix' => 'visitor', 'as' => 'visitor.'], function () {
    Route::get('/form', [
        'as' => 'form',
        'uses' => 'VisitorController@form',
    ]);
    Route::post('store', [
        'as' => 'store',
        'uses' => 'VisitorController@store',
    ]);
    Route::put('update', [
        'as' => 'update',
        'uses' => 'VisitorController@update',
    ]);
});
Route::resource('visitor','VisitorController');
Route::get('visiting/{codes}', [
    'as' => 'visitor.visiting',
    'uses' => 'VisitorController@visiting',
]);

Auth::routes();