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


Route::group(['prefix'=>'admin'],function (){
    //后台登陆
    Route::get('login',"Admin\PublicController@login")->name('login');
    //验证登陆
    Route::post('check','Admin\PublicController@check')->name('check');
    //后台首页
    Route::get('index','Admin\IndexController@index')->name('index');
    Route::get('welcome','Admin\IndexController@welcome')->name('welcome');
    //管理员管理
    Route::get('manager','Admin\ManagerController@index')->name('manager/index');
    //用户权限管理
    Route::get('auth','Admin\AuthController@index')->name('auth/index');
    Route::get('addAuth','Admin\AuthController@add')->name('auth/add');
    Route::post('addData','Admin\AuthController@addData')->name('auth/addData');
    Route::post('deleteAuth','Admin\AuthController@delete')->name('auth/delete');
    //角色管理
    Route::get('role','Admin\RoleController@index')->name('role/index');
    Route::get('addRole','Admin\RoleController@addRole')->name('role/add');
    Route::post('addData','Admin\RoleController@addData')->name('role/addData');

});
