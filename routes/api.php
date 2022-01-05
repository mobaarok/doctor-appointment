<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('posts', 'PostController@getPost');

// Route::post('register', 'User\AuthController@register');
// Route::post('login', 'User\AuthController@login');
// Route::get('logout', 'User\AuthController@logout');
// Route::get('user', 'User\AuthController@getAuthUser');

// Route::get("search-api", "Api\ApiController@search")->name('search');

// Route::post('blog', "Api\ApiController@blogAction");

Route::get('doctors', 'Api\ApiController@getAllDoctors');

//this api route for get all division list page
Route::get('divisions', 'Api\LocationController@division');
//this api for get district by division id
Route::get('division/{id}', 'Api\LocationController@getDistrictByDivisionId');
//this api for get city/upazila by district id
Route::get('district/{id}', 'Api\LocationController@getCityByDistrictId');
//this route for get hospitl/doctor by distirct/city
Route::get('doctor-hospital/{city_id}', 'Api\LocationController@getDoctorAndHospitalByCity');
//single hospital  api
Route::get('hospital/{id}', 'Api\LocationController@getHospitalById');
//get doctor by id
Route::get('doctor/{id}', 'Api\LocationController@getDoctorById');

//get appoinment process data and
Route::get('appoinment', 'Api\ApiAppoinmentController@appoinment');
Route::post('appoinment', 'Api\ApiAppoinmentController@appoinmentAction');

