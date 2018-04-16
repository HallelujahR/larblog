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

Route::get('/','QuestionController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//激活用户邮箱
Route::get('/verify/{id}/{token}','EmailController@verify');


//问题资源控制器
Route::resource('question','QuestionController');
Route::post('/question/search','QuestionController@search');
Route::post('/search','QuestionController@searchWeb');
//个人中心
Route::get('/user','UserController@index');

Route::get('/user/detail','UserController@userDetail');

Route::post('/user/updateDetail','UserController@updateDetail');

Route::get('/user/index/{id}','UserController@index');

Route::get('/user/getUser','UserController@getUser');
//关注
Route::get('/follow/{user_id}/user','FollowUserController@store');

Route::post('/question/answer/{id}','AnswerController@store');

Route::post('/follow/store','FollowController@store');

Route::post('/user/updateAvatar','UserController@updateAvatar');

//读取消息通知
Route::get('/notification','UserFollowNotificationController@index');

//私信
Route::get('/message/store','MessageController@store');
Route::get('/message/mes','MessageController@mes');
//问题评论
Route::post('/comment/question','CommentController@question');

//回答评论
Route::get('/comment/answer','CommentController@answerComment');

//croppic

//点按
Route::get('/answer/voteup','AnswerController@voteup');

Route::get('/answer/votedown','AnswerController@votedown');


// Route::get('/question/search');

Route::get('/topic','TopicController@index');

Route::get('/topic/circle','TopicController@circle');

Route::get('/topic/follow','TopicController@follow_topic');

Route::post('/topic/userTopic','TopicController@userTopic');

Route::get('/topic/gettopic','TopicController@getTopic');

Route::get('/topic/detail/{id}','TopicController@detail');
//////
Route::get('/redis','RedisController@index');

Route::get('/cacheredis','RedisController@cacheRedis');