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
Auth::routes();

Route::group(['middleware' => ['web','auth']], function()
{
     Route::get('/', 'LandingController@index')->name('landing');
});

//client routes
Route::group(['middleware' => ['checkClient']], function(){

     Route::get('/client', 'ClientController@index')->name('client');

     Route::get('/newfeedback', 'FeedbackController@create')->name('newfeedback');
     Route::post('/postfeedback', 'FeedbackController@store')->name('postfeedback');
});


//admin routes
Route::group(['middleware' => ['checkAdmin']], function()
{
     Route::get('/admin', 'AdminController@index')->name('admin');

     Route::get('/admindishes', 'AdminController@indexDishes')->name('admindishes');
          Route::delete('/deletedish/{id}', 'OrderController@destroyDish')->name('deletedish');
          Route::post('/addDish', 'OrderController@addDish')->name('addDish');
     
     Route::get('/adminusers', 'AdminController@indexUsers')->name('adminUsers');
          Route::delete('/deleteUser/{id}', 'UserController@deleteuser')->name('deleteuser');
          Route::post('/updateUser/{id}', 'UserController@updateuser')->name('updateuser');

     Route::get('/admintables', 'AdminController@indexTables')->name('admintables');
          Route::delete('/deletetable/{id}', 'OrderController@destroyTable')->name('deletetable');
          Route::get('/addtable', 'OrderController@addTable')->name('addtable');

     Route::get('/adminreviews', 'AdminController@indexReviews')->name('adminreviews');
});

//server routes
Route::group(['middleware' => ['checkServer']], function()
{
     Route::get('/server', 'ServerController@index')->name('server');

     Route::post('/updateOrder/{id}', 'OrderController@validateCommands')->name('validateCommands');
});

//cashier routes
Route::group(['middleware' => ['checkCashier']], function()
{
     Route::get('/cashier', 'CashierController@index')->name('cashier');
     
     Route::get('/cashier/print-pdf/{id}', [ 'as' => 'printpdf', 'uses' => 'OrderController@printPDF']);
});

//cuisinier routes
Route::group(['middleware' => ['checkCuisinier']], function()
{
     Route::get('/cuisinier', 'CuisinierController@index')->name('cuisinier');
     Route::post('/nextPhase/{id}', 'OrderController@nextCommandStatus')->name('nextPhase');
});

//neworder && postorder
Route::get('/neworder', 'OrderController@create')->name('neworder');
Route::post('/postorder', 'OrderController@store')->name('postorder');


//deleteorder
Route::get('/deleteOrder/{id}', 'OrderController@destroy')->name('deleteorder');


Route::get('/menu', 'DishController@index')->name('menu');