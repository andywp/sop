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
    $config = [
        'client_id' => env('sso_key_public'),
        'client_secret' => env('sso_key_secret'),
        'redirect' => env('sso_url'),
    ];
    return view('admin/login',['config' => $config ]);
});

 /*perfix url admin */
Route::prefix("admin")->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/sop', 'SopControlle@index')->name('sop');

});
/* perfix url */


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
