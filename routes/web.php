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
    });
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

    //Roles

    Route::get('role','RoleController@index')->name('role');
    Route::post('role','RoleController@store')->name('role.store');
    Route::get('role/{id}/edit','RoleController@edit')->name('role.edit');
    Route::post('role/update','RoleController@update')->name('role.update');
    Route::get('role/destroy/{id}','RoleController@destroy');
}
);
