<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});


Route::get('test/:id', 'api/test/index');
Route::post('test', 'api/test/save');
Route::put('test/:id', 'api/test/update');
Route::delete('test/:id', 'api/test/delete');


Route::get('hello/:name', 'index/hello');

Route::get('api/:ver/cats', 'api/:ver.cat/read');
Route::get('api/:ver/index', 'api/:ver.index/index');
Route::get('api/:ver/init', 'api/:ver.index/init');
Route::get('api/:ver/testSms', 'api/:ver.index/testSms');

// Route::get('api/:ver/news', 'api/:ver.news/read');
Route::resource('api/:ver/news','api/:ver.news');
Route::get('api/:ver/rank', 'api/:ver.news/rank');

Route::post('api/:ver/sendsms', 'api/:ver.sms/send');

Route::post('api/:ver/login', 'api/:ver.login/doLogin');
Route::resource('api/:ver/user','api/:ver.user');
//上传
Route::post('api/:ver/upload', 'api/:ver.upload/save');
//点赞
Route::post('api/:ver/like', 'api/:ver.vote/like');
//取消点赞
Route::delete('api/:ver/unlike', 'api/:ver.vote/unlike');
//注册
Route::post('api/:ver/register', 'api/:ver.index/register');
//查看是否点过赞
Route::get('api/:ver/islike/:id', 'api/:ver.vote/islike');
//评论添加
Route::post('api/:ver/comment', 'api/:ver.comment/save');