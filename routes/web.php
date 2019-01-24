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
    return view('home');
});*/
/*
Route::get('/', function () {
    $programmes = \App\Programme::all();
    return view('welcome', ['programmes' => $programmes]);
});*/







/*
Route::get('programmes/{slug}', function($slug){
    $programme = App\Programme::where('slug', '=', $slug)->firstOrFail();
    //$lots = App\Lot::where('programme_id', '=', $programme->id)->firstOrFail();
    $lots = App\Lot::all();
    return view('programmes/programme', compact(array('programme', 'lots')));
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/', 'HomeController@app');

/*
 *  Programmes Routes
 */
Route::get('/programmeslist', 'ProgrammeController@listProg');
Route::get('/programmes', 'ProgrammeController@app');
Route::get('/programmes/{id}', 'ProgrammeController@show')->name('showProg');
Route::get('/programmes/{id}/lots', 'ProgrammeController@showLots');
Route::get('/programmes/{idProgramme}/lots/{idLot}', 'ProgrammeController@showLot');

Route::get('/programme', 'ProgrammeController@app');



Route::resource('programmes', 'ProgrammeController', ['only' => [
    'index', 'store', 'destroy',
]]);

/*
 *  Lots Routes
 */
Route::get('/lot', 'LotController@app');
Route::get('/lots/{id}', 'LotController@show');
Route::get('/lots', 'LotController@index');

