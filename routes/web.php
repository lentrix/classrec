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

Route::get('/login', 'SiteController@index')->name('login');

Route::post('/login', 'SiteController@login');

Route::get('/', 'SiteController@home')->name('home');


Route::get('/register','SiteController@register');
Route::post('/register', 'SiteController@registration');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/logout', 'SiteController@logout');

    Route::group(['middleware'=>'owner'], function(){
        Route::get('/myclass/create', 'MyClassController@create');
        Route::post('/myclass', 'MyClassController@store');

        Route::put('/myclass/{myClass}','MyClassController@update');
        Route::get('/myclass/{myClass}','MyClassController@show');
        Route::post('/myclass/{myClass}/grading','MyClassController@changeGrading');
        Route::get('/myclass/{myClass}/edit','MyClassController@edit');
        Route::get('/myclass/{myClass}/students','MyClassController@students');
        Route::get('/myclass/{myClass}/recode','MyClassController@recode');

        Route::get('/myclass/{myClass}/attendance', 'AttendanceController@index');
        Route::get('/myclass/{myClass}/attendance/create', 'AttendanceController@create');
        Route::post('/myclass/{myClass}/attendance', 'AttendanceController@store');
        Route::get('/myclass/{myClass}/attendance/{attn}', 'AttendanceController@view');
        Route::post('/myclass/{myClass}/attendance/{attn}', 'AttendanceController@record');

        Route::post('/myclass/{myClass}/column/{column}/record', 'ColumnController@record');
        Route::post('/myclass/{myClass}/column/{column}/common-score', 'ColumnController@commonScore');
        Route::get('/myclass/{myClass}/column/{component}/create','ColumnController@create');
        Route::get('/myclass/{myClass}/column/{column}/view', 'ColumnController@view');
        Route::get('/myclass/{myClass}/column/{column}/edit', 'ColumnController@edit');
        Route::put('/myclass/{myClass}/column/{column}', 'ColumnController@update');
        Route::get('/myclass/{myClass}/column/{component}', 'ColumnController@index');
        Route::post('/myclass/{myClass}/column/{component}', 'ColumnController@store');

        Route::get('/myclass/{myClass}/students/{enrol}', 'StudentController@view');
        Route::post('/myclass/{myClass}/students/remove', 'StudentController@remove');
    });


    Route::group(['middleware'=>'student'], function(){
        Route::get('/enrol','MyClassController@enrol');
        Route::post('/enrol','MyClassController@enrolment');
    });
});



