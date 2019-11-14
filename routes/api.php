<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
   // return $request->user();
//});

Route::post('login', 'ApiController@login');

Route::group(['middleware' => 'auth.jwt'], function () {

   Route::get('logout', 'ApiController@logout');
   Route::get('user', 'ApiController@getAuthUser');

   Route::get('companies', 'Api\CompanyController@index');
   Route::get('companies/{company}', 'Api\CompanyController@show');
   Route::post('companies', 'Api\CompanyController@store');
   Route::post('companies/{company}', 'Api\CompanyController@update');
   Route::delete('companies/{company}', 'Api\CompanyController@destroy');


   Route::get('employees', 'Api\EmployeeController@index');
   Route::get('employees/{employee}', 'Api\EmployeeController@show');
   Route::post('employees', 'Api\EmployeeController@store');
   Route::post('employees/{employee}', 'Api\EmployeeController@update');
   Route::delete('employees/{employee}', 'Api\EmployeeController@destroy');

  
});

/*
 Route::post('user/register', 'APIRegisterController@register');
   Route::post('user/login', 'APILoginController@login');

Route::group(['middleware' => ['jwt.verify']], function() {
   Route::get('user', 'UserController@getAuthenticatedUser');
   Route::get('closed', 'DataController@closed');
});*/

