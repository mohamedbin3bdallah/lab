<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('get_all_tests', 'ApiController@get_all_tests');
Route::post('get_all_branches', 'ApiController@get_all_branches');
Route::post('get_all_offers', 'ApiController@get_all_offers');
Route::post('get_about', 'ApiController@get_about');
Route::post('get_contact', 'ApiController@get_contact');
Route::post('home_visit_request', 'ApiController@home_visit_request');


//Route::get('my_function', 'ApiController@my_function');