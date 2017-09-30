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
//Route::get('/admin', 'AdminController@index')->name('admin');
//Route::get('/', function () {
//    return view('welcome');
//})->middleware('guest')->name('welcome');


Route::get('/', 'DoctorController@index')->name('doctor.dashboard');
Route::get('/patient-history', 'PatientController@PatientHistory')->name('patient.history');
Route::prefix('dct')->group(function () {
    Route::get('/dct/sign', 'Auth\DoctorLoginController@showLoginForm')->name('doctor.login');
    Route::post('/dct/sign', 'Auth\DoctorLoginController@login')->name('doctor.login.submit');
Route::post('/dct/logout', 'Auth\DoctorLoginController@logout')->name('doctor.logout');
});
Route::post('/create_patient', 'PatientController@CreatePatient')->name('create_patient');



//Route::prefix('admin')->group(function (){
//
//    Route::get('/', 'AdminController@index')->name('admin.dashboard');
//    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
//    Route::get('/registration', 'Auth\AdminRegisterController@showRegistrationForm')->name('admin.register');
//    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
//    Route::post('/registration', 'Auth\AdminRegisterController@register')->name('admin.register.submit');
//    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
//    //Route::get('/admin', 'AdminController@index')->name('admin');
//});
//Route::get('/', 'DoctorController@index')->name('doctor');
//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Route::post('/registration', 'Auth\DoctorLoginController@register')->name('registration');
//Route::get('/', 'DoctorController@index')->name('doctor.dashboard');


//<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
////Route::get('/', function () {
////    return view('welcome');
////});
//Route::post('/', 'DoctorHomeController@index')->name('doctor.dashboard');
//Route::get('/', 'DoctorController@index')->name('dashboard');
//Route::get('/sign', 'Auth\DoctorLoginController@showLoginForm')->name('doctor.sign');
////Auth::routes();
//
////Route::get('/home', 'HomeController@index')->name('home');
//
//Route::post('/registration', 'Auth\DoctorLoginController@register')->name('registration');
//
////Route::get('/', 'DoctorController@index')->name('doctor.dashboard');
//
//
