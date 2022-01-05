<?php

use Illuminate\Support\Facades\Route;

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

include "admin.php";
include "hospital.php";

// User
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/welcome', function () {
    return view('welcome');
});
Route::view('api-docs', 'api_docs');

Route::get('districts/{division_id}/option', 'LocationController@getDistricts')->name('getDistricts');
Route::get('upazilas/{district_id}/option', 'LocationController@getUpazilas')->name('getUpazilas');


// for admin and hospital json data
Route::get('get-district', 'LocationController@getDistrictsJson')->name('getDistrictJson');
Route::get('get-upazila', 'LocationController@getUpazilasJson')->name('getUpazilaJson');


Route::group(['as' => "user.", "namespace" => "User"], function () {
    Route::get('/', 'AppController@renderHome')->name('home');
    Route::get('dfinder', 'SearchController@search')->name('search');
    Route::get('filter', 'SearchController@filter')->name('filter');

    Route::get('all-hospital', 'UserHospitalController@getAllHospitals')->name('allHospital');
    Route::get('hospital/{id}', 'UserHospitalController@singleHospital')->name('singleHospital');
    Route::get('doctor/{id}', 'UserDoctorController@singleDoctor')->name('singleDoctor');

    Route::get('appoinment', 'AppoinmentController@appoinment')->name('appoinment');
    Route::post('confirm-appoinment', 'AppoinmentController@appoinmentAction')->name('appoinmentAction');
    Route::get('/appoinment/success/{booking_id}', 'AppoinmentController@appoinmentSuccess')->name('appoinment.success');

    Route::get('/download-pdf', 'AppoinmentController@downloadPdf')->name('downloadPdf');

    Route::get('get-visit-time', "AppoinmentController@getVisitTime")->name('getVisitTime');
    Route::get('/appoinment-slot-checker', "AppoinmentController@appoinmentSlotChecker")->name('appoinmentSlotChecker');

});
