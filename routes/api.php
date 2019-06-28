<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth')->get('/user', function (Request $request) {
    \Illuminate\Support\Facades\Log::info('test get user api');
    return response()->json('test');
});*/


Route::middleware('auth:api')->get('/user', function(Request $request) {
    // return Auth::guard('api')->user();
    \Illuminate\Support\Facades\Log::info($request);
    return $request->user();

});
Route::get('/annonces/location', 'AdvertController@getLocations');
Route::get('/annonces/achat', 'AdvertController@getBuyers');
Route::get('/property/types', 'PropertyController@getPropertyTypes');
Route::get('/advert/types', 'AdvertController@getAdvertTypes');



