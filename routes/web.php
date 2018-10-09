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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('comments', 'CommentController');
Route::get('/shipment', 'ShipmentController@index')->name('shipment');
Route::post('/addshipment', 'ShipmentController@addshipment')->name('addshipment');
Route::post('/deleteshipment', 'ShipmentController@deleteshipment')->name('deleteshipment');
Route::post('/docupload', 'ShipmentController@docUpload')->name('docupload');
Route::post('/uploadshipment', 'ShipmentController@uploadshipment')->name('uploadshipment');
Route::post('/listcomments', 'ShipmentController@listcomments')->name('listcomments');
Route::get('/inbox', 'MailController@inbox')->name('inbox');
Route::get('/sentmaillist', 'MailController@sentmaillist')->name('sentmaillist');
Route::get('/get-sentmail','MailController@getSentmail')->name('getsentmail');
Route::get('/compose', 'ShipmentController@filemanager')->name('compose')->middleware('admin');
Route::post('/sentmail', 'MailController@sentmail')->name('sentmail');
Route::get('/showmail/{id}', 'MailController@showmail')->name('showmail');
Route::get('/showmailsent/{id}', 'MailController@showmailsent')->name('showmailsent');
Route::get('/file','ShipmentController@filemanager')->name('filemanager');
Route::get('/shipment/edit/{id}','ShipmentController@edit')->name('edit');\
Route::POST('shipment/update/{id}','ShipmentController@update')->name('update');
