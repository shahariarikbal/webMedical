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
Route::post('/contact/send', 'ContactController@send');

Route::get('config-clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    dd("All clear!");
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
    Route::get('all/patients', 'PatientController@patients')->name('patient.list');
    Route::get('delete/patient/{id}','PatientController@destroy')->name('patient.edit');
    Route::get('edit/{id}', 'PatientController@edit')->name('patient.edit');
    Route::post('update', 'PatientController@update')->name('patient.update');
    Route::get('details/{id}','PatientController@details')->name('patient.details');
    Route::get('{path}', 'DashboardController@index')->where( 'path', '.*' );
});

Route::group(['prefix' => 'employee/'], function () {
    Route::post('store', 'EmployeeController@store')->name('employee.store');
    Route::get('list', 'EmployeeController@list')->name('employee.list');
    Route::get('edit/{id}', 'EmployeeController@edit')->name('employee.edit');
    Route::get('view/{id}', 'EmployeeController@view')->name('employee.view');
    Route::get('restore/{employee}', 'EmployeeController@restore')->name('employee.restore');
    Route::get('all/trashed/data', 'EmployeeController@trashList')->name('employee.trash.list');
    Route::post('update/{id}', 'EmployeeController@update')->name('employee.update');
    Route::get('destroy/{employee}', 'EmployeeController@destroy')->name('employee.destroy');
    Route::get('permanent/destroy/{employee}', 'EmployeeController@permanentDestroy')->name('employee.permanent.destroy');
    Route::get('{path}', 'DashboardController@index')->where( 'path', '.*' );
});

Route::group(['prefix' => 'blood-donor/'], function () {
    Route::post('store', 'BloodDonorController@store')->name('blood.donor.store');
    Route::post('update', 'BloodDonorController@update');
    Route::get('list','BloodDonorController@bloodDonorList');
    Route::get('view/{id}', 'BloodDonorController@view');
    Route::get('edit/{id}', 'BloodDonorController@view');
    Route::get('destroy/{id}', 'BloodDonorController@destroy');
    Route::get('all/trashed/data','BloodDonorController@trashList');
    Route::get('permanent/destroy/{id}','BloodDonorController@permanentDestroy');
    Route::get('restore/{id}','BloodDonorController@restore');
    Route::get('{path}', 'DashboardController@index')->where( 'path', '.*' );
});


// Undone
Route::group(['prefix' => '/settings/'], function() {
    Route::get('about', 'DashboardController@index');
    Route::get('get_about', 'AboutController@getAbout');
    Route::post('store', 'AboutController@store');
    Route::post('update', 'AboutController@update');
});