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
Route::options('{all}',function (){return response()->json(['msg'=>'ok']);})->middleware('cross');

Route::group(['prefix'=>'admin','middleware'=>'cross'],function (){
    //后台登陆
    Route::get('login',"Admin\PublicController@login")->name('login');
    //验证登陆
    Route::post('checkLogin','Admin\PublicController@check')->name('check');
    //后台首页
    Route::get('index','Admin\IndexController@index')->name('index');
    Route::get('welcome','Admin\IndexController@welcome')->name('welcome');
    //管理员管理
    Route::get('manager/list','Admin\ManagerController@index')->name('manager/index');//管理员列表
    Route::post('manager/add','Admin\ManagerController@addManager');
    //用户权限管理
    Route::get('auth','Admin\AuthController@index')->name('auth/index');
    Route::get('addAuth','Admin\AuthController@add')->name('auth/add');
    Route::post('addAuthData','Admin\AuthController@addData')->name('auth/addAuthData');
    Route::post('deleteAuth','Admin\AuthController@delete')->name('auth/delete');
    //角色管理
    Route::get('role','Admin\RoleController@index')->name('role/index');
    Route::get('addRole','Admin\RoleController@addRole')->name('role/add');
    Route::post('addRoleData','Admin\RoleController@addData')->name('role/addRoleData');

    //前端用户
    Route::get('betUser/list','Admin\BetUserController@listBetUser')->name('bet/user');//用户列表
    Route::post('betUser/add','Admin\BetUserController@addBetUser');//添加用户
    Route::get('betUser/get','Admin\BetUserController@getBetUser');//获取指定用户
    Route::post('betUser/edit','Admin\BetUserController@editBetUser');//修改用户信息
    Route::post('betUser/resetPossword','Admin\BetUserController@resetPossword');//重设密码
    Route::post('betUser/setIntegral','Admin\BetUserController@setIntegral');//充值积分
    Route::get('beetUser/intDetails','Admin\BetUserController@intDetails');//积分明细

    //排名
    Route::get('ranking/list','Admin\RankingController@listRanking');//排名列表
    Route::post('ranking/add','Admin\RankingController@addRanking');//添加排名
    Route::get('ranking/get','Admin\RankingController@getRanking');//获取指定排名
    Route::post('ranking/edit','Admin\RankingController@editRanking');//修改排名

    //开奖结果
    Route::get('results/list','Admin\ResultsController@listResults');//开奖结果列表
    Route::get('results/add','Admin\ResultsController@addResults');//添加开奖结果

    //下注列表
    Route::get('record/list','Admin\RecordController@listRecord');//下注列表

});
