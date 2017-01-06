<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/main', 'TableMainController@generateMainView');
Route::post('/main', 'TableMainController@Ajax');

// Route::get('/tables', 'TablesController@show');
// Route::post('/tables', 'TablesController@search');

Route::get('/tables/{tableID}', 'TablesController@oneTable');
// Route::get('/tables/{tableID}/teacher', 'TableTeacherController@show');
Route::post('/tables/{tableID}/edit', 'TablesController@edit');
// Route::delete('/tables/')
Route::get('/tables/{tableID}/delete', 'TablesController@delete')->middleware('auth');
// Route::get('/tables/{tableID}', 'TablesController@insertTable');
Route::get('/insert', 'TablesInsertController@show')->middleware('auth');
Route::post('/insert', 'TablesInsertController@insert')->middleware('auth');


Route::post('/tagEdit', 'TablesInsertController@tagRename');
Route::post('/tagDelete', 'TablesInsertController@tagDelete');
Route::post('/CountryEdit', 'TablesInsertController@countryEdit');
Route::post('/CountryDelete', 'TablesInsertController@countryDelete');
Route::post('/fundOrgInsert', 'TablesInsertController@orgInsert');
Route::post('/fundOrgEdit', 'TablesInsertController@orgEdit');
Route::post('/fundOrgDelete', 'TablesInsertController@fundOrgDelete');
Route::post('/researchInsert', 'TablesInsertController@resInsert');
Route::post('/researchEdit', 'TablesInsertController@resEdit');
Route::post('/researchDelete', 'TablesInsertController@resDelete');


Route::post('/fundNameSave', 'TableUpdateController@updateName');
Route::post('/tagSave', 'TableUpdateController@tagSave');
Route::post('/fundRelSave', 'TableUpdateController@fundRelSave');
Route::post('/orgSave', 'TableUpdateController@orgSave');
Route::post('/resSave', 'TableUpdateController@resSave');


Route::post('/tagInsert', 'TablesInsertController@home');
Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('/adminPanel', 'HomeController@adminPanel')->middleware('admin');
Route::post('/userDelete', 'HomeController@userDelete')->middleware('admin');
Route::post('/userAdd', 'HomeController@userAdd')->middleware('admin');

