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
/*
Route::get('/', function () {
    return view('welcome');
});*/
/*
Route::get('/', function () {
    $programmes = \App\Programme::all();
    return view('welcome', ['programmes' => $programmes]);
});*/


Route::get('/', function () {
    $programmes = App\Programme::all();
    $lots = App\Lot::all();

    return view('welcome', compact(array('programmes', 'lots')));
});

Route::get('/', 'ProgrammeController@app');

Route::get('programmes/{slug}', function($slug){
    $programme = App\Programme::where('slug', '=', $slug)->firstOrFail();
    //$lots = App\Lot::where('programme_id', '=', $programme->id)->firstOrFail();
    $lots = App\Lot::all();
    return view('programmes/programme', compact(array('programme', 'lots')));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
