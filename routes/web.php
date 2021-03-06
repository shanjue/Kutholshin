<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('laravel_echo_test',function(){
    return view('laravel_echo_test');
});

Route::get('fire_event_to_test_laravel_echo',function(){
    event(new \App\Events\SendMessage());
    dd('Event Run Successfully.');
});

Auth::routes();

Route::get('email', 'JobController@processQueue');

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
    Route::resource('news', 'NewsController');
});

// encrypt and decrypt to s3
Route::get('file-vault-encryption', 'FileVaultController@index')->name('filevault');
Route::post('file-vault-encryption', 'FileVaultController@store');
Route::get('file-vault-encryption/downloadfile/{filename}', 'FileVaultController@downloadFile')->name('filevault.downloadFile');

//Success Demo 
Route::get('kutholshin', 'DemoController@kutholshin')->name('kutholshin');

Route::get('datatable', 'DemoController@datatable')->name('datatable');
Route::post('datatable', 'DemoController@postDatatable');

Route::get('laraveldatatable', 'DemoController@laravelDatatable')->name('laraveldatatable');
Route::get('datalaraveldatatable', 'DemoController@dataLaravelDatatable')->name('laraveldatatable.data');

Route::get('laraveldatatable2', 'DemoController@laravelDatatable2')->name('laraveldatatable2');
Route::get('datalaraveldatatable2', 'DemoController@dataLaravelDatatable2')->name('laraveldatatable2.data');

Route::get('laraveldatatable3', 'DemoController@laravelDatatable3')->name('laraveldatatable3');
Route::get('datalaraveldatatable3', 'DemoController@dataLaravelDatatable3')->name('laraveldatatable3.data');
Route::get('user/posts/{user_id}', 'DemoController@userPosts');

Route::get('select2', 'DemoController@select2')->name('select2');
Route::post('select2', 'DemoController@select2Post');

Route::get('async-await', 'DemoController@asyncAwait')->name('async.await');
Route::get('getUserAsyncAwait', 'DemoController@getUserAsyncAwait');

Route::get('testcomponent','DemoController@testComponent')->name('testcomponent');
Route::post('testcomponent','DemoController@testPostComponent');

/**
 * Post Create With Laravel Trix
 */
Route::group(['middleware' => ['auth']], function () {
    Route::get('create/post/withLaravel-Trix', 'DemoController@createPost')->name('post.create');
    Route::post('create/post/withLaravel-Trix', 'DemoController@savePost');
    Route::get('edit/post/withLaravel-Trix/{id}', 'DemoController@editPost')->name('post.edit');
    Route::post('edit/post/withLaravel-Trix/{id}', 'DemoController@updatePost');
});


//Export Demo
Route::get('export/user', 'ExportController@exportUser')->name('export.user');
Route::get('export/user2', 'ExportController@exportUser2')->name('export.user2');
Route::get('savepdftozipimage', 'ExportController@savePdfToZipImage');
Route::get('saveimage', 'ExportController@saveImage');
Route::get('saveimageview/{id}', 'ExportController@saveImageView')->name('saveimage.view');
Route::get('savepdfview/{id}', 'ExportController@savePdfView')->name('savepdf.view');
Route::get('export/post', 'ExportController@exportPost')->name('export.post');

//Spatie laravel html
Route::get('spatielaravelhtml','SpatieLaravelHtmlController@createForm');

Route::get('home', 'HomeController@index')->name('home');
