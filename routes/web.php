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

//Route::get('/', function () {
//    return view('welcome');
//});

use App\Jobs\SendEmailJob;

use Illuminate\Support\Carbon;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth', 'admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//UserSide
Route::group(
    ['middleware' => 'verified'],
    function () {
        Route::get('/profile', 'User\UserProfileController@profile')->name('user.profile');
        Route::post('/profile/changepassword', 'User\UserProfileController@changepassword')->name('user.password.update');
        Route::get('/caserecord/{id}', 'User\UserProfileController@detail')->name('user.caserecord.detail');
        Route::get('presc/{id}', 'User\UserProfileController@presc')->name('user.presc');
    }
);


Route::get('/', 'User\UserController@index')->name('user.index');
Route::get('/aboutus', 'User\UserController@aboutus')->name('user.aboutus');
Route::get('/contactus', 'User\UserController@contactus')->name('user.contactus');
Route::post('/contactus', 'User\MessageController@store')->name('user.message.store');
Route::post('/appointment', 'User\AppointmentController@store')->name('user.appointment.store');
Route::post('/subcrible', 'User\SubcribleController@store')->name('user.subcrible.store');
Route::get('/blog', 'User\UserController@blog')->name('user.blog');

Route::get('/tester', function() {

    if ( ! \File::exists(public_path()."/storage/files/1/test")) {
        \File::makeDirectory(public_path()."/storage/files/1/test1");
    }

    return 'ok';
});

//EndUserSide


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(
    ['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']],
    function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('index');

        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::get('dashboard/statistic/appointment/{year}','DashboardController@appByYear')->name('dashboard.appbyyear');
        Route::get('dashboard/statistic/patient/{year}','DashboardController@patientByYear')->name('dashboard.patientbyyear');
        Route::get('dashboard/statistic/caserecord/{year}','DashboardController@caserecordByYear')->name('dashboard.caserecordbyyear');

        //Role Page 
        Route::get('role', 'RoleController@index')->name('role');
        Route::post('role', 'RoleController@store')->name('role.store');
        Route::get('role/{id}/edit', 'RoleController@edit')->name('role.edit');
        Route::post('role/update', 'RoleController@update')->name('role.update');
        Route::get('role/destroy/{id}', 'RoleController@destroy');

        //Service Page 
        Route::get('service', 'ServiceController@index')->name('service');
        Route::post('service', 'ServiceController@store')->name('service.store');
        Route::get('service/{id}/info', 'ServiceController@info')->name('service.info');
        Route::get('service/{id}/edit', 'ServiceController@edit')->name('service.edit');
        Route::post('service/update', 'ServiceController@update')->name('service.update');
        Route::get('service/destroy/{id}', 'ServiceController@destroy');

        //Service Page 
        Route::get('medicine', 'MedicineController@index')->name('medicine');
        Route::post('medicine', 'MedicineController@store')->name('medicine.store');
        Route::get('medicine/{id}/info', 'MedicineController@info')->name('medicine.info');
        Route::get('medicine/{id}/edit', 'MedicineController@edit')->name('medicine.edit');
        Route::post('medicine/update', 'MedicineController@update')->name('medicine.update');
        Route::get('medicine/destroy/{id}', 'MedicineController@destroy');

        //Doctor Page 
        Route::get('doctor', 'DoctorController@index')->name('doctor');
        Route::post('doctor', 'DoctorController@store')->name('doctor.store');
        Route::get('doctor/{id}/info', 'DoctorController@info')->name('doctor.info');
        Route::get('doctor/{id}/edit', 'DoctorController@edit')->name('doctor.edit');
        Route::post('doctor/update', 'DoctorController@update')->name('doctor.update');
        Route::get('doctor/destroy/{id}', 'DoctorController@destroy');

        //patient Page 
        Route::get('patient', 'PatientController@index')->name('patient');
        Route::post('patient', 'PatientController@store')->name('patient.store');
        Route::get('patient/{id}/info', 'PatientController@info')->name('patient.info');
        Route::get('patient/{id}/edit', 'PatientController@edit')->name('patient.edit');
        Route::post('patient/update', 'PatientController@update')->name('patient.update');
        Route::post('patient/{id}/update', 'PatientController@update')->name('patient.update.detail');
        Route::get('patient/destroy/{id}', 'PatientController@destroy');
        Route::get('patient/restore/{id}', 'PatientController@restore');
        Route::get('patient/{id}', 'PatientController@detail')->name('patient.detail');

        //Case Record Page     
        Route::post('caserecord', 'CaseRecordController@store')->name('caserecord.store');
        Route::get('caserecord/{id}/edit', 'CaseRecordController@edit')->name('caserecord.edit');
        Route::post('caserecord/update', 'CaseRecordController@update')->name('caserecord.update');
        Route::post('caserecord/{id}/update', 'CaseRecordController@update')->name('caserecord.update.detail');
        Route::post('caserecord/{id}/update/description', 'CaseRecordController@description')->name('caserecord.update.description');
        Route::get('caserecord/destroy/{id}', 'CaseRecordController@destroy');
        Route::get('caserecord/{id}', 'CaseRecordController@detail')->name('caserecord.detail');
        Route::get('caserecord/{id}/invoice', 'CaseRecordController@invoice')->name('caserecord.invoice');

        //Case Record Detail   
        Route::post('caserecorddetail', 'CaseRecordDetailController@store')->name('caserecorddetail.store');
        Route::get('caserecorddetail/{id}/edit', 'CaseRecordDetailController@edit')->name('caserecorddetail.edit');
        Route::post('caserecorddetail/update', 'CaseRecordDetailController@update')->name('caserecorddetail.update');
        Route::get('caserecorddetail/destroy/{id}', 'CaseRecordDetailController@destroy');

        //CCASE RECORD DETAIL TEST DATATABLE
        Route::get('crdetail/{id}', 'CaseRecordDetailController@index2')->name('crdetail');
        Route::get('crinstallment/{id}', 'InstallmentPlanController@index2')->name('crinstallment');
        Route::get('crprocess/{id}', 'ProcessController@index2')->name('crprocess');
        Route::get('crprescription/{id}', 'PrescriptionController@index2')->name('crprescription');


        //CCASE RECORD DETAIL TEST DATATABLE

        //Case Record Installment Plan    
        Route::post('installmentplan', 'InstallmentPlanController@store')->name('installmentplan.store');
        Route::get('installmentplan/{id}/edit', 'InstallmentPlanController@edit')->name('installmentplan.edit');
        Route::post('installmentplan/update', 'InstallmentPlanController@update')->name('installmentplan.update');
        Route::get('installmentplan/destroy/{id}', 'InstallmentPlanController@destroy');

        //Case Record Process   
        Route::post('process', 'ProcessController@store')->name('process.store');
        Route::get('process/{id}/edit', 'ProcessController@edit')->name('process.edit');
        Route::post('process/update', 'ProcessController@update')->name('process.update');
        Route::get('process/destroy/{id}', 'ProcessController@destroy');

        //Case Record Prescription  
        Route::post('prescription', 'PrescriptionController@store')->name('presciption.store');
        Route::get('prescription/{id}', 'PrescriptionController@detail')->name('presciption.detail');
        Route::get('prescription/destroy/{id}', 'PrescriptionController@destroy');

        //Calendar
        Route::get('calendar', 'CalendarController@index')->name('calendar');
        Route::post('calendar', 'CalendarController@store')->name('calendar.store');
        Route::post('calendar/update', 'CalendarController@update')->name('calendar.update');
        Route::get('calendar/destroy/{id}', 'CalendarController@destroy');

        //Appointment
        Route::get('appointment', 'AppointmentController@index')->name('appointment');
        Route::get('appointment/{id}/edit', 'AppointmentController@edit')->name('appointment.edit');
        Route::post('appointment/update', 'AppointmentController@update')->name('appointment.update');
        Route::get('appointment/destroy/{id}', 'AppointmentController@destroy');
        Route::get('appointment/accept/{id}', 'AppointmentController@accept');
        Route::get('appointment/pending/{id}', 'AppointmentController@pending');
        Route::get('appointment/datatable', 'AppointmentController@index2')->name('appointment.datatable');

        //Message
        Route::get('message','MessageController@index')->name('message');
        Route::get('message/destroy/{id}','MessageController@destroy');

        //Subcrible
        Route::get('subcrible','SubcribleController@index')->name('subcrible');
        Route::get('subcrible/destroy/{id}','SubcribleController@destroy');

        //Trash
        Route::get('trash/patient','TrashController@index')->name('trash.patient');
        Route::get('trash/caserecord','TrashController@index2')->name('trash.caserecord');
        Route::get('trash/caserecorddetail','TrashController@index3')->name('trash.caserecorddetail');
        Route::get('trash/installmentplan','TrashController@index4')->name('trash.installmentplan');
        Route::get('trash/process','TrashController@index5')->name('trash.process');
        Route::get('trash/prescription','TrashController@index6')->name('trash.presciption');
        Route::get('trash/prescriptiondetail','TrashController@index7')->name('trash.prescriptiondetail');
    }
);
