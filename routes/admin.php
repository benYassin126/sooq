<?php
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defines', 'admin');
    Route::get('login', 'AdminAuth@login');
    Route::post('login', 'AdminAuth@dologin');
    //Template Route
    Route::resource('template','TemplateController');
    Route::get('template/fetch_image/{id}', 'TemplateController@fetch_image');
    Route::get('template/{template}/useTemplate', 'TemplateController@useTemplateShow')->name('template.useTemplate');
    Route::post('template/{template}/useTemplate', 'TemplateController@useTemplateUpload')->name('template.useTemplate');
    //Template Img Route
    Route::resource('templateImg','TemplateImgController');
    Route::get('templateImg/{templateImg}/xyz', 'TemplateImgController@xyz')->name('templateImg.xyz');
    Route::get('templateImg/fetch_image/{id}', 'TemplateImgController@fetch_image');


    //Template Img Route
    Route::resource('user','UserController');
    Route::get('user.search', 'UserController@search')->name('user.search');
    Route::group(['middleware' => 'admin:admin'], function () {

        Route::get('/', function () {
            return view('admin.overView');
        });

        Route::any('logout', 'AdminAuth@logout');
    });

});
