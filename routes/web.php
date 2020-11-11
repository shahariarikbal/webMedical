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


Route::get('/', function () {
    return view('home');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'clients'], function () {
    Route::get('/registration-form', 'ClientController@clientsRegisterForm')->name('clients.registration.form');
    Route::get('/registration/phone-is-available', 'ClientController@clientsRegisterPhone')->name('clients.registration.phone');
    Route::get('/registration/email-is-available', 'ClientController@clientsRegisterEmail')->name('clients.registration.email');
    Route::post('/registration', 'ClientController@clientsRegister')->name('clients.registration');
    Route::get('/verification/{token}', 'ClientController@emailVerification')->name('clients.verification');
    Route::get('/login-form', 'ClientController@clientsLoginForm')->name('clients.login.form');
    Route::post('/login', 'ClientController@clientsLogin')->name('clients.login');
    Route::get('/forgot-password-form', 'ClientController@clientsForgotPasswordForm')->name('clients.forgot.password.form');
    Route::post('/password-reset', 'ClientController@clientsResetPassword')->name('clients.password.reset.link');
    Route::get('/reset-password-form', 'ClientController@clientsResetPasswordForm')->name('clients.reset.password.form');
    Route::post('/password-update', 'ClientController@clientsResetPasswordUpdate')->name('clients.password.update');
});


Route::group(['prefix' => 'clients/'], function (){

//    Route::get('/dashboard', 'DashboardController@index')->name('clients.dashboard');

    Route::post('add-new-doctor', 'DoctorController@store')->name('clients.add.new.doctor');
    Route::get('all/doctors', 'DoctorController@doctors')->name('clients.doctors.list');
    Route::get('doctor/details/{id}', 'DoctorController@details')->name('clients.doctor.details');
    Route::get('doctor/edit/{doctor}', 'DoctorController@edit')->name('clients.doctor.edit');
    Route::post('doctor/update/{id}', 'DoctorController@update')->name('clients.doctor.update');
    Route::delete('delete/doctor/{doctor}', 'DoctorController@distroy')->name('clients.doctor.distroy');
    Route::get('{path}', 'DashboardController@index')->where( 'path', '.*' );
});

Route::group(['prefix' => 'patient/'], function () {
    Route::post('store', 'PatientController@store')->name('patient.store');
    Route::get('edit/{patient}', 'PatientController@edit')->name('patient.edit');
    Route::post('update/{patient}', 'PatientController@update')->name('patient.edit');
    Route::get('{path}', 'DashboardController@index')->where( 'path', '.*' );
});



