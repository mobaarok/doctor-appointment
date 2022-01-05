<?php

use Illuminate\Support\Facades\Route;

// Admin
Route::group(['as' => "admin.", "prefix" => "admin", "namespace" => "Admin"], function () {

    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@authenticate')->name('login.action');

    Route::group(['middleware' => "admin"], function () {
        Route::get('logout', 'LoginController@logout')->name('logout');

        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        Route::resource('hospital', 'AdminHospitalController');

        Route::get('assign-doctor/{id}', 'AssignDoctorController@assignDoctorModal')->name('assign.doctor');
        Route::post('assign-doctor', 'AssignDoctorController@assignDoctor')->name('assign.doctor.action');


        Route::resource('doctor', 'DoctorController');
        Route::resource('doctor-degree', 'DoctorDegreeController');
        Route::resource('doctor-institute', 'DoctorInstituteController');
        Route::resource('expertise', 'ExpertiseController')->only(['index', 'store', 'update']);

    });
});
