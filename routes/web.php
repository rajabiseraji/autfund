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
Route::post('/tables/{tableID}/edit', 'TablesController@edit');
// Route::delete('/tables/')
Route::get('/tables/{tableID}/delete', 'TablesController@delete');
// Route::get('/tables/{tableID}', 'TablesController@insertTable');
Route::get('/insert', 'TablesInsertController@show');
Route::post('/insert', 'TablesInsertController@insert');


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


Route::post('/home', 'TablesInsertController@home');