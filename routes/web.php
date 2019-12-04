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
/*
Route::post('/', function () {
    $config = [
        'client_id' => env('sso_key_public'),
        'client_secret' => env('sso_key_secret'),
        'redirect' => env('sso_url'),
    ];
    return view('admin/login',['config' => $config ]);
});
*/
Route::get('/', 'HomeController@Login')->name('home');
Route::post('/auth', 'HomeController@Auth');
Route::get('/logout', 'HomeController@Logout');
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
 /*perfix url admin */
    Route::prefix("admin")->group(function(){
        Route::get('/', 'HomeController@index');
        Route::get('/sop', 'SopControlle@index');
        Route::get('/sop/read', 'SopControlle@SOPread');
        Route::get('/sop/read/{sop_id}/{permalink}', 'SopControlle@SOPdetail');
        Route::get('/sop/add', 'SopControlle@sopadd');
        Route::post('/sop/ajax-save', 'SopControlle@ajaxSave');
        Route::get('/sop/edit/{sop_id}', 'SopControlle@sopEdit');
        Route::post('/sop/ajax-edit', 'SopControlle@ajaxEdit');
        Route::post('/sop/ajax-delete', 'SopControlle@ajaxDelete');

    });
/* perfix url */
    /* perfix url */
});


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
