<?php

Auth::routes(['verify' => true]);

//Route::get('/', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


/*
 *  Programmes Routes
 */
Route::get('/programmes', 'ProgrammeController@listProg')->middleware('verified');
Route::get('/programmes/{idProgramme}/lots/{idLot}', 'ProgrammeController@showLot')->middleware('verified');

/*
 *  Favorties Routes
 */
Route::post('favorite/programme/{programme}', 'ProgrammeController@favoriteProgramme');
Route::post('unfavorite/programme/{programme}', 'ProgrammeController@unFavoriteProgramme');
Route::post('favorite/lot/{lot}', 'LotController@favoriteLot');
Route::post('unfavorite/lot/{lot}', 'LotController@unFavoriteLot');
Route::get('/favorites', 'UserController@myFavorites')->middleware('auth');

/*
 *  Books Routes
 */
Route::post('book/programme/{programme}', 'LotController@bookProgramme');
Route::post('unbook/programme/{programme}', 'LotController@unBookProgramme');
Route::post('book/lot/{lot}', 'LotController@bookLot');
Route::post('book/lot/{lot}', 'LotController@bookLot');
Route::post('unbook/lot/{lot}', 'LotController@unBookLot');
Route::get('/books', 'UserController@myOptionRequests')->middleware('auth');


/*
 *  Option Requests Routes
 */
Route::post('/option/request/{lot}', 'LotController@makeOptionRequest');
Route::post('/option/unrequest/{lot}', 'LotController@unMakeOptionRequest');

/*
 *  Lots Routes
 */
Route::get('/lots/{id}', 'LotController@show')->middleware('verified');
Route::get('/lots', 'LotController@index')->middleware('verified');
Route::get('/lots/additional/{id}/{city}/{price}', 'LotController@getAdditionalLots')->middleware('verified');

/*
 *  Roles Routes
 */

Route::get('/roles', 'RoleController@index');
Route::get('/user', 'UserController@index');

Route::post('/search', 'SearchController@filter')->name('search')->middleware('verified');
Route::get('/dispositifs', 'DispositifController@index');

/*
 *  Actions Routes
 */
Route::post('/action/contact', 'ContactController@store');
Route::post('/action/denonce', 'DenonceController@store');
Route::post('/action/call', 'CallController@store');
Route::post('/action/parrainage', 'ParrainageController@store');
Route::post('/action/subscriber', 'NewsletterController@newSubscriber');


Route::middleware ('auth', 'verified')->group (function () {
    Route::name ('notifications.')->prefix('notifications')->group(function () {
        Route::name ('index')->get ('/', 'NotificationController@index');
        Route::name ('show')->get ('/{notification}', 'NotificationController@show');
        Route::name ('update')->put ('{notification}', 'NotificationController@update');
        Route::name ('unread')->put ('{notif}', 'NotificationController@unread');
    });
});

/*Route::post('programmes/{lot}/favorite', 'UserController@favorite')->name('favorite');
Route::delete('programmes/{lot}/favorite', 'UserController@unfavorite')->name('unfavorite');*/


Route::get('/list-notifications', 'NotificationController@getNotifications');
Route::get('/test', function() {
    return Auth::user();
});

Route::get('/actualites/{slug}', 'PostController@show')->name('singlePost');

/*
 *  Pages Routes
 */
Route::get('/{slug}', 'PageController@show')->name('page');

use App\Events\NewDenonceEvent;

Route::get('/pusher', function() {
    event(new NewDenonceEvent('Geoffroy'));
    return "Event has been sent!";
});


