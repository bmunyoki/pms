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

Route::get('/', 'Auth\LoginController@getLoginPage');
Route::get('/register', 'Auth\RegisterController@getRegistrationPage');
Route::get('/login', 'Auth\LoginController@getLoginPage');
Route::post('/auth/register', 'Auth\RegisterController@register');
Route::post('/auth/login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/doctor/complete', 'DoctorController@getCompletePage');
Route::post('/auth/doc/complete', 'DoctorController@completeReg');

Route::get('/patient/complete', 'PatientController@getCompletePage');
Route::post('/auth/patient/complete', 'PatientController@completeReg');

//Protected patient routes
// Get create appointment page
Route::get('/patients/appointments/new', [
    'uses' => 'PatientController@getCreateVisitPage',
    'as' => 'patient.appointments.new',
    'middleware' => ['roles'],
    'roles' => ['Patient']
]);

// Patient - create appointment
Route::post('/patients/appointments/create', [
    'uses' => 'PatientController@createAppointment',
    'as' => 'patient.appointments.create',
    'middleware' => ['roles'],
    'roles' => ['Patient']
]);

// Get all appointments
Route::get('/patients/appointments', [
    'uses' => 'PatientController@getAllAppointments',
    'as' => 'patient.appointments.all',
    'middleware' => ['roles'],
    'roles' => ['Patient']
]);


//Protected doctor routes
// Get create appointment page
Route::get('/doctor/appointments/new', [
    'uses' => 'DoctorController@getNewAppointmentsPage',
    'as' => 'doc.appointments.new',
    'middleware' => ['roles'],
    'roles' => ['Doctor']
]);

// Get create appointment page
Route::get('/doctor/appointments/attend/{id}', [
    'uses' => 'DoctorController@attendToAppointmentPage',
    'as' => 'doc.appointments.attend',
    'middleware' => ['roles'],
    'roles' => ['Doctor']
]);

// Attend to appointment
Route::post('/doctor/appointments/attend', [
    'uses' => 'DoctorController@attendToAppointment',
    'as' => 'doc.appointments.attend',
    'middleware' => ['roles'],
    'roles' => ['Doctor']
]);


//Protected lab routes
// Get waiting lab page
Route::get('/lab/waiting', [
    'uses' => 'LabController@getWaitingPage',
    'as' => 'lab.waiting',
    'middleware' => ['roles'],
    'roles' => ['Lab']
]);

// Get waiting lab page
Route::get('/lab/appointments/{id}', [
    'uses' => 'LabController@getSingle',
    'as' => 'lab.single',
    'middleware' => ['roles'],
    'roles' => ['Lab']
]);

// Attend to an appointment
Route::post('/lab/appointments/attend', [
    'uses' => 'LabController@attendToAppointment',
    'as' => 'lab.attend',
    'middleware' => ['roles'],
    'roles' => ['Lab']
]);