<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['/'], function (){

    Route::get('/', 'Home\IndexController@index');
    Route::get('/cate/{cate_id}', 'Home\IndexController@cate');
    Route::get('/art/{art_id}', 'Home\IndexController@article');
    Route::any('admin/login', 'Admin\LoginController@login');
    Route::get('admin/code', 'Admin\LoginController@code');
    Route::any('admin/pass', 'Admin\IndexController@pass');

    Route::any('weixin/api', 'Weixin\WeixinController@api');
    Route::any('weixin/getid', 'Weixin\WeixinController@getId');
    Route::any('weixin/getinfo', 'Weixin\WeixinController@getInfo');

});

Route::group(['middleware' => ['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],
    function (){
    Route::get('index', 'LoginController@index');
    Route::get('info', 'LoginController@info');
    Route::get('quit', 'LoginController@quit');

    Route::post('cate/changeorder', 'CategoryController@changeOrder');
    Route::resource('category','CategoryController');

    Route::resource('article','ArticleController');

    Route::any('upload', 'CommonController@upload');

    Route::resource('links','LinksController');
    Route::post('links/changeOrder', 'LinksController@changeOrder');

    Route::resource('navs','NavsController');
    Route::post('navs/changeOrder', 'NavsController@changeOrder');
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1',function ($api){
    header("Access-Control-Allow-Origin: *");
    $api->group(['namespace'=>'App\Http\Controllers\Api'], function($api){
        $api->get('categorys','CategoryController@index');
        $api->get('articles/{id}','ArticleController@getAllarticle');

        $api->get('/comments/{art_id}','CommentController@getComment');
        $api->post('newcomment','CommentController@postNewcomment');
        $api->get('/art/{id}','ArticleController@getArt');
    });
});



