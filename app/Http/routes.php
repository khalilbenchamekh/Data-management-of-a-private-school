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


Route::get('admin/login', function () {
	if(Auth::check()){
		return redirect(url('admin'));
	}
    return view('admin.login');
});

Route::get('membership', function () {
	return view('errors.503');
});

Route::post('admin', 'AdminController@login');
Route::post('contactus', 'PublicController@contact');
Route::post('subscribe', 'SubscriberController@news');
Route::post('comment/{id}', 'PublicController@postComment');
Route::get('notification/{title}', 'PublicController@postNotification');
Route::get('press', 'PublicController@postPress');
Route::get('videos/{idYo}', 'PublicController@postVideo');
Route::get('videos/', 'PublicController@toVideos');

Route::get('test', 'PublicController@test');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	Route::get('/', 'AdminController@index');

	Route::get('members', 'SubscriberController@sub');

	Route::delete('mem/delete/{id}', 'SubscriberController@del');

	Route::resource('comments', 'AdminCommentsController');

	Route::get('options', 'AdminController@getOptions');

	Route::post('options', 'AdminController@postOptions');

	Route::get('logout', 'AdminController@logout');

	Route::resource('articles', 'AdminArticlesController');

	Route::resource('press', 'AdminPressController');

	Route::resource('categories', 'AdminCategoriesController');

	Route::resource('events', 'AdminEventsController');

	Route::resource('users', 'AdminUsersController');

	Route::resource('notifications', 'AdminNotificationsController');

	Route::resource('galerie', 'AdminGalerieController');

	Route::resource('videos', 'AdminVideosController');

});


Route::get('article/{id}',  'PublicController@press');

Route::post('search',  'PublicController@postSearch');

Route::group(['prefix' => 'events'], function () {

		Route::get('{year}/{month}/{day}', 'PublicController@event');

});

Route::group(['prefix' => 'tv'], function () {

		Route::get('/', 'PublicController@tv');

		Route::get('{name}/{id}', "PublicController@tvid");
});

Route::group(['prefix' => 'galerie'], function () {

		Route::get('/', 'PublicController@galerie');
});




Route::group(['prefix' => '/'], function () {

	Route::get('/', 'PublicController@home');

	Route::get('{category}', 'PublicController@category');

	Route::get('{category}/{subCategory}', 'PublicController@subCategory');

	Route::get('{category}/{subCategory}/{postSlug}', 'PublicController@article');
	

});
