<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

// Test routes
Route::get('/all', 'HomeController@showAll');

Route::get('/meta', 'HomeController@meta');

Route::get('/port', 'HomeController@port');


// Home
Route::get('/', [
  'as'    =>  'home',
  'uses'  => 'HomeController@index'
]);
/*
Route::post('/',[
  'as'    =>  'homeContactForm',
  'uses'  =>  'ContactController@submitAjax'
]);*/
/*
Route::get('/ajax/ajaxGetPortfolioItem', [
  'as'    =>  'ajaxGetPortfolioItems',
  'uses'  =>  'HomeController@ajaxGetPortfolioItem'
]);*/


// Work
Route::get('/work', [
  'as'    =>  'workList',
  'uses'  =>  'WorkController@index'
]);

Route::get('/work/project/{slug}', [
  'as'    =>  'workDetail',
  'uses'  =>  'WorkController@detail'
]);


// About
Route::get('/about', [
  'as'    =>  'about',
  'uses'  =>  'AboutController@index'
]);


// Contact
Route::get('/contact', [
  'as' => 'contact',
  'uses' => 'ContactController@index'
]);
Route::post('/contact', [
  'as' => 'contactSend',
  'uses' => 'ContactController@submitForm'
]);
/*Route::post('/contact/ajax',[
  'as' => 'contactAjax',
  'uses' => 'ContactController@submitAjax'
]);
*/

// Testing ajax
/*
Route::get('/ajax-one',[
  'as'    =>  'ajaxOne',
  'uses'  =>  'HomeController@ajaxOne'
]);
Route::get('/ajax/two',[
  'as'    =>  'ajaxTwo',
  'uses'  =>  'HomeController@ajaxTwo'
]);
Route::get('/ajax',[
  'as'    =>  'ajaxHome',
  'uses'  =>  'HomeController@ajaxHome'
]);
Route::get('/ajax/{id}',[
  'as'    =>  'ajaxId',
  'uses'  =>  'HomeController@ajaxId'
]);
*/