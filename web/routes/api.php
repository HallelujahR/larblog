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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api')->get('/topics', function (Request $request) {
	return App\Topic::select(['name','id'])->where('name','like','%'.$request->get('q').'%')->get();	
});

Route::middleware('api')->get('/follow', function (Request $request) {
	$user = App\User::findOrFail($request->get('user'));
	// $user->unreadNotifications->markAsRead();

	foreach($user->unreadNotifications as $notification) {
		if($request->get('id') == $notification->id){
			$notification->markAsRead();
		}
	}
});


Route::middleware('api')->post('/user_detail/background', function (Request $request) {

	if(App\UserDetail::findOrFail($request->id)->update($request->all())){
		return 'ok';
	}else{
		return 'no';
	}
});
