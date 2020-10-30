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

//UserSide
Route::group(['middleware'=>'verified'],
function (){
    // for user profile
}
);

Route::get('/','User\UserController@index')->name('user.index');
Route::get('/aboutus','User\UserController@aboutus')->name('user.aboutus');
Route::get('/contactus','User\UserController@contactus')->name('user.contactus');
Route::get('/blog','User\UserController@blog')->name('user.blog');


//EndUserSide


Auth::routes(['verify'=> true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' => 'admin.' , 'prefix' => 'admin' , 'namespace' => 'Admin' , 'middleware' => ['auth','admin']],
function (){
    Route::get('/',function (){
        return redirect()->route('admin.dashboard');
    })->name('index');
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

    //Role Page 
    Route::get('role','RoleController@index')->name('role');
    Route::post('role','RoleController@store')->name('role.store');
    Route::get('role/{id}/edit','RoleController@edit')->name('role.edit');
    Route::post('role/update','RoleController@update')->name('role.update');
    Route::get('role/destroy/{id}','RoleController@destroy');
    
    //Service Page 
    Route::get('service','ServiceController@index')->name('service');
    Route::post('service','ServiceController@store')->name('service.store');
    Route::get('service/{id}/info','ServiceController@info')->name('service.info');
    Route::get('service/{id}/edit','ServiceController@edit')->name('service.edit');
    Route::post('service/update','ServiceController@update')->name('service.update');
    Route::get('service/destroy/{id}','ServiceController@destroy');

    //Service Page 
    Route::get('medicine','MedicineController@index')->name('medicine');
    Route::post('medicine','MedicineController@store')->name('medicine.store');
    Route::get('medicine/{id}/info','MedicineController@info')->name('medicine.info');
    Route::get('medicine/{id}/edit','MedicineController@edit')->name('medicine.edit');
    Route::post('medicine/update','MedicineController@update')->name('medicine.update');
    Route::get('medicine/destroy/{id}','MedicineController@destroy');

    //Doctor Page 
    Route::get('doctor','DoctorController@index')->name('doctor');
    Route::post('doctor','DoctorController@store')->name('doctor.store');
    Route::get('doctor/{id}/info','DoctorController@info')->name('doctor.info');
    Route::get('doctor/{id}/edit','DoctorController@edit')->name('doctor.edit');
    Route::post('doctor/update','DoctorController@update')->name('doctor.update');
    Route::get('doctor/destroy/{id}','DoctorController@destroy');

    //patient Page 
    Route::get('patient','PatientController@index')->name('patient');
    Route::post('patient','PatientController@store')->name('patient.store');
    Route::get('patient/{id}/info','PatientController@info')->name('patient.info');
    Route::get('patient/{id}/edit','PatientController@edit')->name('patient.edit');
    Route::post('patient/update','PatientController@update')->name('patient.update');
    Route::post('patient/{id}/update','PatientController@update')->name('patient.update.detail');
    Route::get('patient/destroy/{id}','PatientController@destroy');
    Route::get('patient/{id}','PatientController@detail')->name('patient.detail');
    
    //Case Record Page     
    Route::post('caserecord','CaseRecordController@store')->name('caserecord.store');
    Route::get('caserecord/{id}/edit','CaseRecordController@edit')->name('caserecord.edit');
    Route::post('caserecord/update','CaseRecordController@update')->name('caserecord.update');
    Route::post('caserecord/{id}/update','CaseRecordController@update')->name('caserecord.update.detail');
    Route::get('caserecord/destroy/{id}','CaseRecordController@destroy');
    Route::get('caserecord/{id}','CaseRecordController@detail')->name('caserecord.detail');

    //Case Record Detail   
    Route::post('caserecorddetail','CaseRecordDetailController@store')->name('caserecorddetail.store');
    Route::get('caserecorddetail/{id}/edit','CaseRecordDetailController@edit')->name('caserecorddetail.edit');
    Route::post('caserecorddetail/update','CaseRecordDetailController@update')->name('caserecorddetail.update');
    Route::get('caserecorddetail/destroy/{id}','CaseRecordDetailController@destroy');

    //Case Record Installment Plan    
    Route::post('installmentplan','InstallmentPlanController@store')->name('installmentplan.store');
    Route::get('installmentplan/{id}/edit','InstallmentPlanController@edit')->name('installmentplan.edit');
    Route::post('installmentplan/update','InstallmentPlanController@update')->name('installmentplan.update');
    Route::get('installmentplan/destroy/{id}','InstallmentPlanController@destroy');

    //Case Record Process   
    Route::post('process','ProcessController@store')->name('process.store');
    Route::get('process/{id}/edit','ProcessController@edit')->name('process.edit');
    Route::post('process/update','ProcessController@update')->name('process.update');
    Route::get('process/destroy/{id}','ProcessController@destroy');
}
);
