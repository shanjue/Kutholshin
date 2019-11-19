<?php

use App\DataTables\UsersDataTable;

Route::get('export', function(UsersDataTable $dataTable) {
    return $dataTable->render('export.user');
});


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
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::namespace('Auth')->group(function () {
        //Login Routes
        Route::get('/login', 'LoginController@showLoginForm')->name('login');
        Route::post('/login', 'LoginController@login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
        //Forgot Password Routes
        Route::get('/password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        //Reset Password Routes
        Route::get('/password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@reset')->name('password.update');
    });
});

Route::prefix('backend')->namespace('Backend')->group(function () {
    Route::resource('center', 'CenterController');
    Route::resource('user', 'UserController');
});

Route::get('home', 'HomeController@index')->name('home');

//Success Demo 
Route::get('kutholshin','DemoController@kutholshin')->name('kutholshin');

Route::get('datatable','DemoController@datatable')->name('datatable');
Route::post('datatable', 'DemoController@postDatatable');

Route::get('laraveldatatable','DemoController@laravelDatatable')->name('laraveldatatable');
Route::get('datalaraveldatatable','DemoController@dataLaravelDatatable')->name('laraveldatatable.data');

Route::get('laraveldatatable2','DemoController@laravelDatatable2')->name('laraveldatatable2');
Route::get('datalaraveldatatable2','DemoController@dataLaravelDatatable2')->name('laraveldatatable2.data');

Route::get('laraveldatatable3','DemoController@laravelDatatable3')->name('laraveldatatable3');
Route::get('datalaraveldatatable3','DemoController@dataLaravelDatatable3')->name('laraveldatatable3.data');
Route::get('user/posts/{user_id}','DemoController@userPosts');

Route::get('select2','DemoController@select2')->name('select2');
Route::post('select2','DemoController@select2Post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
