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

use Illuminate\Support\Facades\Route;

Route::get('/login', 'SiteController@index')->name('login');

Route::post('/login', 'SiteController@login');

Route::get('/', 'SiteController@home')->name('home');


Route::get('/register','SiteController@register');
Route::post('/register', 'SiteController@registration');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/logout', 'SiteController@logout');
    Route::get('/profile', 'SiteController@profile');
    Route::get('/profile/edit', 'SiteController@editProfile');
    Route::put('/profile/update', 'SiteController@updateProfile');

    Route::group(['middleware'=>'teacher'], function(){
        Route::get('/myclass/create', 'MyClassController@create');
        Route::post('/myclass', 'MyClassController@store');
    });

    Route::group(['middleware'=>'owner'], function(){

        Route::put('/myclass/{myClass}','MyClassController@update');
        Route::get('/myclass/{myClass}','MyClassController@show');
        Route::post('/myclass/{myClass}/grading','MyClassController@changeGrading');
        Route::get('/myclass/{myClass}/edit','MyClassController@edit');
        Route::get('/myclass/{myClass}/students','MyClassController@students');
        Route::get('/myclass/{myClass}/recode','MyClassController@recode');
        Route::get('/myclass/{myClass}/summary','MyClassController@summary');

        Route::get('/myclass/{myClass}/attendance', 'AttendanceController@index');
        Route::get('/myclass/{myClass}/attendance/create', 'AttendanceController@create');
        Route::post('/myclass/{myClass}/attendance', 'AttendanceController@store');
        Route::get('/myclass/{myClass}/attendance/{attn}/rescan', 'AttendanceController@rescan');
        Route::delete('/myclass/{myClass}/attendance/{attn}', 'AttendanceController@delete');
        Route::get('/myclass/{myClass}/attendance/{attn}', 'AttendanceController@view');
        Route::post('/myclass/{myClass}/attendance/{attn}', 'AttendanceController@record');
        Route::get('/myclass/{myClass}/attendance/{attn}/stop-interactive', 'AttendanceController@stopInteractive');
        Route::get('/myclass/{myClass}/attendance/{attn}/make-interactive', 'AttendanceController@makeInteractive');

        Route::post('/myclass/{myClass}/column/{column}/record', 'ColumnController@record');
        Route::get('/myclass/{myClass}/column/{column}/rescan', 'ColumnController@rescan');
        Route::post('/myclass/{myClass}/column/{column}/common-score', 'ColumnController@commonScore');
        Route::get('/myclass/{myClass}/column/{component}/create','ColumnController@create');
        Route::get('/myclass/{myClass}/column/{column}/view', 'ColumnController@view');
        Route::get('/myclass/{myClass}/column/{column}/edit', 'ColumnController@edit');
        Route::put('/myclass/{myClass}/column/{column}', 'ColumnController@update');
        Route::delete('/myclass/{myClass}/column/{column}', 'ColumnController@delete');
        Route::get('/myclass/{myClass}/column/{component}', 'ColumnController@index');
        Route::post('/myclass/{myClass}/column/{component}', 'ColumnController@store');

        Route::get('/myclass/{myClass}/students/{enrol}', 'StudentController@view');
        Route::delete('/myclass/{myClass}/students/{enrol}', 'EnrolController@remove');
        Route::get('/myclass/{myClass}/students/{enrol}/change-password','EnrolController@changePasswordForm');
        Route::post('/myclass/{myClass}/students/{enrol}/change-password','EnrolController@changePassword');
    });


    Route::group(['middleware'=>'student'], function(){
        Route::get('/enrol','MyClassController@enrol');
        Route::post('/enrol','MyClassController@enrolment');
        Route::get('/enrol/{enrol}/view', 'EnrolController@view');
        Route::get('/attendance/interactive-response/{studAttn}', 'AttendanceController@interactiveResponse');
    });
});



