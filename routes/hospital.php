<?php
use Illuminate\Support\Facades\Route;
// Hospital System
Route::group(['as' => "hospital.", "prefix" => "sys/hospital", "namespace" => "Hospital"], function () {

    // Tested Start::::::::::::::::::::::::::::::::
    Route::get('process', 'HospitalController@registerInfo')->name('reg.info');

    Route::get('register', 'HospitalAuthController@registerHospital')->name('register');
    Route::post('register', 'HospitalAuthController@registerHospitalAction')->name('registerHospitalAction');

    Route::get('login', 'HospitalAuthController@login')->name('login');
    Route::post('login', 'HospitalAuthController@authenticate')->name('login.authenticate');

    Route::get('logout', 'HospitalAuthController@logout')->name('logout');
// Tested End::::::::::::::::::::::::::::::::::

// not testetd
    Route::get('account-check/{id}', 'HospitalAuthController@accountCheck')->name('accountCheck');

    Route::group(['middleware' => "hospital"], function () {

        Route::get('email-verification', 'HospitalAuthController@sendEmailVerificationMail')->name('email.verification');
        Route::get('verify/{token}', 'HospitalAuthController@verifyEmail')->name('email.verify');

        Route::get('change-password', 'HospitalAuthController@changePassword')->name('change.password');
        Route::put('change-password', 'HospitalAuthController@changePasswordAction')->name('change.password.action');


        Route::get('/', 'HospitalController@home')->name('home');

        Route::get('/profile', 'HospitalController@profile')->name('profile');
        Route::get('/edit-profile', 'HospitalController@editHospital')->name('editProfile');
        Route::put('/edit-profile/{id}', 'HospitalController@updateHospital')->name('updateHospital');

        Route::get('doctors', 'DoctorController@doctorsInHospital')->name('doctorsInHospital');
        Route::get('add-doctor', 'DoctorController@addDoctor')->name('addDoctor');
        Route::post('add-doctor', 'DoctorController@addDoctorAction')->name('addDoctorAction');

        Route::get('doctor/{id}', 'DoctorController@singleDoctor')->name('singleDoctor');
        Route::get('visit-datetime/doctor/{doctor_id}', 'DoctorController@visitDayTime')->name('visitDayTime');
        Route::post('visit-datetime', 'DoctorController@visitDayTimeAction')->name('visitDayTimeAction');

        Route::get('edit-visit-day', 'DoctorController@editVisitDayTime')->name('editVisitDayTime');
        Route::post('edit-visit-day', 'DoctorController@editVisitDayTimeAction')->name('editVisitDayTimeAction');

        // /testing
        Route::get('manage-appoinment', 'AppoinmentManageController@index')->name('manageAppoinment');


        Route::get('appoinment-list', 'AppoinmentManageController@getAppoinmentList')->name('appoinmentList');
        Route::get('appoinment-complete-action', 'AppoinmentManageController@appoinmentCompleteAction')->name('appoinmentCompleteAction');
        Route::get('get-doctor-sit-time', 'AppoinmentManageController@getDoctorSitDate')->name('getDoctorSitDate');

        Route::post('add-local-serial', 'AppoinmentManageController@addLocalSerial')->name('addLocalSerial');

        Route::get('doctor-watch-tmie', 'DoctorController@doctorWatchTime')->name('doctorWatchTime');
        Route::post('doctor-watch-tmie', 'DoctorController@doctorWatchTimeAction')->name('doctorWatchTimeAction');
        Route::get('patient-number', 'DoctorController@dailyPatientNumber')->name('dailyPatientNumber');
        Route::post('patient-number', 'DoctorController@dailyPatientNumberAction')->name('dailyPatientNumberAction');


    });
});
