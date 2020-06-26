<?php
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Config::set('auth.defines', 'admin');
    Route::get('login', 'AdminAuth@login');
    Route::post('login', 'AdminAuth@dologin');
    Route::resource('template','TemplateController');
    Route::get('template/fetch_image/{id}', 'TemplateController@fetch_image');
    Route::resource('templateImg','TemplateImgController');
    Route::get('templateImg/{templateImg}/xyz', 'TemplateImgController@xyz')->name('templateImg.xyz');
    Route::get('templateImg/fetch_image/{id}', 'TemplateImgController@fetch_image');
    Route::group(['middleware' => 'admin:admin'], function () {

        Route::get('/', function () {
            return view('admin.overView');
        });

        Route::any('logout', 'AdminAuth@logout');
    });

});
