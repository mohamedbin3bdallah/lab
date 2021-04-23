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

Route::pattern('id', '[0-9]+');
Route::pattern('status', '[0-9]');
Route::pattern('type', '[a-zA-Z]+');
Route::pattern('reorder', '[0-9:_]+');
Route::pattern('name', '[a-z0-9]+');
Route::pattern('idtitle', '[a-zA-Z0-9_]+');
Route::pattern('image', '[a-zA-Z0-9.]+');

Route::get('/', 'FrontController@index');
Route::get('home', 'FrontController@index');
Route::get('slider/{id}', 'FrontController@slider');
Route::get('about', 'FrontController@about');
Route::get('services', 'FrontController@services');
Route::get('test_library', 'FrontController@test_library');
Route::get('house_visit', 'FrontController@house_visit');
Route::post('house_visit', 'FrontController@house_visit');
Route::get('test_result', 'FrontController@test_result');
Route::get('contact', 'FrontController@contact');
Route::post('contact', 'FrontController@contact');
Route::get('service/{id}', 'FrontController@service');
/*Route::get('login', 'FrontController@loginForm');
Route::post('login', 'FrontController@login');*/
Route::get('admin_login', 'FrontController@admin_loginForm');
Route::post('admin_login', 'FrontController@admin_login');
Route::get('patient_login', 'FrontController@patient_loginForm');
Route::post('patient_login', 'FrontController@patient_login');
Route::get('branch_login', 'FrontController@branch_loginForm');
Route::post('branch_login', 'FrontController@branch_login');
Route::get('lab_login', 'FrontController@lab_loginForm');
Route::post('lab_login', 'FrontController@lab_login');
Route::get('logout', 'FrontController@logout');

Route::get('lang/{lang}/{page?}', 'FrontController@lang');


Route::prefix('lab')->group(function () {
	Route::get('new_patient',  'PatientsController@create');
	Route::post('new_patient',  'PatientsController@store');
	Route::get('old_patient/{id}',  'PatientsController@edit');
	Route::get('b_old_patient/{id}',  'PatientsController@edit_1');
	Route::post('old_patient/{id}',  'PatientsController@update');
	Route::get('{id?}/patients', 'PatientsController@index');
	Route::get('{id}/b_patients', 'PatientsController@index_1');
	Route::get('delete_patient/{id}',  'PatientsController@destroy');
	Route::get('{id}/test_price_list',  'TestpricesController@index');
	Route::get('feedback',  'FeedbacksController@create');
	Route::post('feedback',  'FeedbacksController@store');
});

Route::get('branch',  'LabsController@index');
Route::get('patient/test_result',  'PatientsController@test_result');

Route::prefix('admin')->group(function () {
  Route::get('404',  'HomeController@error');

  Route::get('/', 'HomeController@index');
  Route::get('home', 'HomeController@index');

  Route::prefix('branches')->group(function () {
    Route::get('/', 'BranchesController@index');
    Route::post('add', 'BranchesController@store');
    Route::post('edit/{id?}', 'BranchesController@update');
	Route::get('status/{id}/{status}','BranchesController@status');
    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
  });
  
  Route::prefix('labs')->group(function () {
    Route::get('/', 'LabsController@index');
    Route::post('add', 'LabsController@store');
    Route::post('edit/{id?}', 'LabsController@update');
	Route::get('status/{id}/{status}','LabsController@status');
    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
  });
  
  Route::prefix('patients')->group(function () {
    Route::get('/', 'PatientsController@index');
    Route::post('add', 'PatientsController@store');
    Route::post('edit/{id?}', 'PatientsController@update');
	Route::get('status/{id}/{type}/{status}','PatientsController@status');
    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
  });
  
  Route::prefix('drivers')->group(function () {
    Route::get('/', 'DriversController@index');
    Route::post('add', 'DriversController@store');
    Route::post('edit/{id?}', 'DriversController@update');
	Route::get('status/{id}/{status}','DriversController@status');
	Route::get('map/{id}',  function ($id) {
      return view('admin/map')->with('id',$id);
	});
    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
  });


    Route::prefix('services')->group(function () {
      Route::get('/', 'OffersservicesController@index');
      Route::post('add', 'OffersservicesController@store');
      Route::post('edit/{id?}', 'OffersservicesController@update');
	  Route::get('status/{id}/{status}','OffersservicesController@status');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

	Route::prefix('cms')->group(function () {
      Route::get('/', 'CmsController@index');
      Route::post('add', 'CmsController@store');
      Route::post('edit/{id?}', 'CmsController@update');
	  Route::get('status/{id}/{status}','CmsController@status');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });
	
	Route::prefix('maincms')->group(function () {
      Route::get('/', 'MaincmsController@index');
      Route::post('add', 'MaincmsController@store');
      Route::post('edit/{id?}', 'MaincmsController@update');
	  Route::get('status/{id}/{status}','MaincmsController@status');
      Route::get('{string}',  function () {
          return redirect('admin/404', 301);
      });
    });

    Route::get('{string}',  function () {
        return redirect('admin/404', 301);
    });
});

Route::get('{string1?}/{string2?}/{string3?}/{string4?}/{string5?}', 'FrontController@error');
Route::get('404', 'FrontController@error');