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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/department-tree-view',[
    'as' => 'admin.department',
    'uses' => 'DepartmentController@manageDepartment'
]);

// Route::post('add-department',[
//     'as' => 'add.department',
//     'uses' => 'DepartmentController@addDepartment'
// ]);
//Route::get('admin/department-tree-view',['uses'=>'DepartmentController@manageDepartment']);



Route::post('admin/add-department',['as'=>'add.department','uses'=>'DepartmentController@addDepartment']);
Route::get('/message/{id}', 'HomeController@getMessage')->name('message');
Route::post('message', 'HomeController@sendMessage');
Route::resource('/departments', 'DepartmentsController');
//Route::view('admin/departments','admin/departments/createDepartment');
Route::get('user', 'UserController@show')->name('user');
Route::post('user/update','UserController@update')->name('user.update');
Route::post('/update', function (Request $request){
    $request->image->store('images','public');
    return 'update';
});
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Route::resource('users','UsersController');
    Route::get('users/{id}/edit/','UsersController@edit');
    Route::get('users/{id}/delete/','UsersController@delete');

    // Route::resource('/departments','DepartmentController@index');



});
