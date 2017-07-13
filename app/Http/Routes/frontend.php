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
Route::get('/test', function() {
    return view('frontend.email.thanks');
});
Route::get('glogin',array('as'=>'glogin','uses'=>'SocialAuthController@googleLogin')) ;
Route::group(['prefix' => 'social-auth'], function () {
    Route::group(['prefix' => 'facebook'], function () {
        Route::get('redirect/', ['as' => 'fb-auth', 'uses' => 'SocialAuthController@redirect']);
        Route::get('callback/', ['as' => 'fb-callback', 'uses' => 'SocialAuthController@callback']);
        Route::post('fb-login', ['as' => 'ajax-login-by-fb', 'uses' => 'SocialAuthController@fbLogin']);
    });

    Route::group(['prefix' => 'google'], function () {
        //Route::get('redirect/', ['as' => 'gg-auth', 'uses' => 'SocialAuthController@googleRedirect']);        
        Route::get('callback/', ['as' => 'gg-callback', 'uses' => 'SocialAuthController@googleCallback']);
    });

});

Route::group(['prefix' => 'authentication'], function () {
    Route::post('check_login', ['as' => 'auth-login', 'uses' => 'AuthenticationController@checkLogin']);
    Route::post('login_ajax', ['as' =>  'auth-login-ajax', 'uses' => 'AuthenticationController@checkLoginAjax']);
    Route::get('/user-logout', ['as' => 'user-logout', 'uses' => 'AuthenticationController@logout']);
});

Route::group(['namespace' => 'Frontend'], function()
{

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('{slugLoaiSp}/{slug}/', ['as' => 'child', 'uses' => 'CateController@child']);  
   
    Route::get('tag/{slug}', ['as' => 'tag', 'uses' => 'DetailController@tagDetail']);
    Route::get('topics.html', ['as' => 'news-list', 'uses' => 'NewsController@newsList']);
    Route::get('{slugLoaiSp}/{slug}-{id}.html', ['as' => 'chi-tiet', 'uses' => 'DetailController@index']);
    
    Route::get('/tin-tuc/{slug}-p{id}.html', ['as' => 'news-detail', 'uses' => 'NewsController@newsDetail']);  

    Route::post('/dang-ki-newsletter', ['as' => 'register.newsletter', 'uses' => 'HomeController@registerNews']);    
    Route::post('/send-contact', ['as' => 'send-contact', 'uses' => 'ContactController@store']);
  
    Route::get('tim-kiem.html', ['as' => 'search', 'uses' => 'ProductController@search']);
    Route::get('ho-so-cong-ty.html', ['as' => 'info', 'uses' => 'HomeController@info']);
    Route::get('lien-he.html', ['as' => 'contact', 'uses' => 'HomeController@contact']);
    Route::get('{slug}.html', ['as' => 'parent', 'uses' => 'CateController@parent']);

});

