<?php

/*
|---------------------------------------------------- ----------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', 'HomeController@getShowIndex');



Route::controller('auth', 'AuthController');
Route::controller('password', 'RemindersController');

//wtf!?
//Route::get('/admin/projecteventxml/{id}', 'ProjectsController@getProgectEventXML');

//Route::group(array('before' => 'auth'), function () {
Route::get('/admin', 'AdminController@getShowAdmin');
Route::get('/admin/page/{id?}', 'AdminController@getPage');
Route::get('/admin/user/{id?}', 'AdminController@getUser');
Route::get('/admin/settings', 'AdminController@showSettings');

Route::post('/admin/page/{id?}', 'AdminController@postPage');
Route::post('/admin/user/{id?}', 'AdminController@postUser');
Route::post('/admin/settings', 'AdminController@postSettings');
Route::get('/admin/delete/{type}/{id}', 'AdminController@deleteAny');

Route::resource('/admin/project', 'ProjectsController');
Route::controller('admin/project', 'ProjectsController');
Route::controller('admin', 'AdminController');
//});

//Route::controller('message', 'MessageController');

//Route::group(array('before' => 'auth'), function () {
    Route::controller('user', 'UsersController');

    Route::get('/project/search', 'ProjectsHomeController@getSearch');
    Route::get('/project/{slug}', 'ProjectsHomeController@getProject');
    Route::controller('project', 'ProjectsHomeController');

//});

Route::get('/{slug?}', 'HomeController@getShowIndex');
Route::post('/form-request', 'HomeController@postFormRequest');
//Route::controller('/', 'HomeController');


//Route::controller('users', 'UsersController');


