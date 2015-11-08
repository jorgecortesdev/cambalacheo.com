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

// Index routes
Route::get('/',                              'IndexController@index');
Route::get('/category/{category_id}',        'IndexController@category');
Route::get('/condition/{condition_id}',      'IndexController@condition');
Route::get('/search',                        'IndexController@search');
Route::get('/location/{state_id}/{city_id}', 'IndexController@location');
Route::get('about',                          'IndexController@about');
Route::get('contact',                        'IndexController@contact');
Route::post('contact',                       'IndexController@contact');

// Panel routes
Route::get('panel',           'PanelController@articles');
Route::get('panel/offers',    'PanelController@offers');
Route::get('panel/questions', 'PanelController@questions');

// User routes
Route::get('panel/profile', 'Auth\AuthController@edit');
Route::put('panel/profile/{user_id}', [
    'as'   => 'panel.profile',
    'uses' => 'Auth\AuthController@update'
]);

// Authentication routes...
Route::get('auth/login',  'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register',  'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Images routes
Route::get('image/article/{article_id}/{image_id}/{image_size}', 'ImageController@getArticleImage');
Route::get('image/article/default/{image_size}.gif', 'ImageController@getDefault');

// Article routes
Route::get('panel/article/create',             'ArticleController@create');
Route::get('panel/articles/edit/{article_id}', 'ArticleController@edit');
Route::post('articles',                        'ArticleController@store');
Route::get('trades/{article_id}',              'ArticleController@show');
Route::put('panel/articles/edit/{article_id}', [
    'as'   => 'article.update',
    'uses' => 'ArticleController@update'
]);
Route::post('panel/articles/update_status', 'ArticleController@change_status');

// Questions routes
Route::get('trades/question/{article_id}', 'QuestionController@create');
Route::post('trades/question/replay',      'QuestionController@replay');
Route::post('trades/question',             'QuestionController@store');

// Offer routes
Route::get('trades/offer/{article_id}' ,     'OfferController@create');
Route::post('trades/offer',                  'OfferController@store');
Route::post('trades/offer/replay',           'OfferController@replay');
Route::get('trades/offer/reject/{offer_id}', 'OfferController@reject');
Route::get('trades/offer/accept/{offer_id}', 'OfferController@accept');

// Cities
Route::get('cities/{state_id}', function($state_id) {
    $cities = \App\City::select('id', 'name')->where('state_id', $state_id)->get()->toArray();
    return Response::json(compact('cities'));
});
