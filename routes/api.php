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
//Route::options('{all}',function (){return jsonResponse(['msg'=>'ok']);})->middleware('cross');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'web','middleware'=>'cross'],function (){
    Route::post('login','Web\PublicController@betLogin');//前台用户登录
    Route::get('loginOut','Web\PublicController@loginOut');//用户退出登录
    Route::get('getRanking','Web\RankingController@getRanking');//获取排名信息
    Route::get('listResults','Web\ResultsController@listResults');//获取历史开奖结果
    Route::get('getResults','Web\ResultsController@getResults');//获取最新的已开奖结果
    Route::get('getInt','Web\PublicController@intDetails');//获取用户积分
    Route::post('record','Web\RecordController@betRecord');//下注
    Route::post('resetRecord','Web\RecordController@resetRecord');
    Route::post('countResults','Web\ResultsController@countResults');//计算开奖结果
    Route::get('addResults','Web\ResultsController@addResults');//新增开奖结果
    Route::get('resetPassword','Web\PublicController@resetPassword');//重设密码


});
