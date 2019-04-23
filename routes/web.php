<?php
use Illuminate\Support\Facades\Input;
use App\Programme;
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



//require __DIR__ . '/vendor/autoload.php';




/*
Route::get('programmes/{slug}', function($slug){
    $programme = App\Programme::where('slug', '=', $slug)->firstOrFail();
    //$lots = App\Lot::where('programme_id', '=', $programme->id)->firstOrFail();
    $lots = App\Lot::all();
    return view('programmes/programme', compact(array('programme', 'lots')));
});
*/
Auth::routes(['verify' => true]);

Route::get('/', function() {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


/*
 *  Programmes Routes
 */

Route::get('/programmeslist', 'ProgrammeController@listProg')->middleware('verified');
Route::get('/programmes', 'ProgrammeController@index')->middleware('verified');
Route::get('/programmes/{id}', 'ProgrammeController@show')->name('showProg')->middleware('verified');
Route::get('/programmes/{id}/lots', 'ProgrammeController@showLots')->middleware('verified');
Route::get('/programmes/{idProgramme}/lots/{idLot}', 'ProgrammeController@showLot')->middleware('verified');

Route::get('/programme', 'ProgrammeController@app')->middleware('verified');

Route::post('favorite/programme/{programme}', 'ProgrammeController@favoriteProgramme');
Route::post('unfavorite/programme/{programme}', 'ProgrammeController@unFavoriteProgramme');
Route::post('favorite/lot/{lot}', 'LotController@favoriteLot');
Route::post('unfavorite/lot/{lot}', 'LotController@unFavoriteLot');

Route::get('favorites', 'UserController@myFavorites')->middleware('auth');



Route::resource('programmes', 'ProgrammeController', ['only' => [
    'index', 'listProg', 'store', 'destroy',
]])->middleware('verified');

/*
 *  Lots Routes
 */

Route::get('/lots/{id}', 'LotController@show')->middleware('verified');
Route::get('/lots', 'LotController@index')->middleware('verified');

/*
 *  Roles Routes
 */

Route::get('/roles', 'RoleController@index');
Route::get('/user', 'UserController@index');

Route::post('/search', 'SearchController@filter');
Route::get('/dispositifs', 'DispositifController@index');

/*
 *  Actions Routes
 */
Route::post('/action/contact', 'ContactController@store');
Route::post('/action/denonce', 'DenonceController@store');
Route::post('/action/call', 'CallController@store');


Route::get('/test', function () {


    event(new App\Events\NewDenonce('Admin'));
    return "Event has been sent!";
});

Route::middleware ('auth', 'verified')->group (function () {
    Route::name ('notifications.')->prefix('notifications')->group(function () {
        Route::name ('index')->get ('/', 'NotificationController@index');
        Route::name ('show')->get ('/{notification}', 'NotificationController@show');
        Route::name ('update')->patch ('{notification}', 'NotificationController@update');
    });
});

Route::get('/list-notifications', 'NotificationController@getNotifications');

/*Route::any('/search',function(){
    $q = Input::get ( 'q' );
    $user = Programme::where('name','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('search.index')->withDetails($user)->withQuery ( $q );
    else return view ('search.index')->withMessage('No Details found. Try to search again !');
});*/