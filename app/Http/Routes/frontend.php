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


Route::group(['namespace' => 'Frontend'], function()
{

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
    Route::get('{slugLoaiSp}/{slug}/', ['as' => 'danh-muc-con', 'uses' => 'CateController@cate']);  
   
    Route::get('tag/{slug}', ['as' => 'tag', 'uses' => 'DetailController@tagDetail']);
    Route::get('tin-tuc/{slug}', ['as' => 'news-list', 'uses' => 'NewsController@newsList']);
    Route::get('{slugLoaiSp}/{slug}-{id}.html', ['as' => 'chi-tiet', 'uses' => 'DetailController@index']);
    
    Route::get('/tin-tuc/{slug}-p{id}.html', ['as' => 'news-detail', 'uses' => 'NewsController@newsDetail']);  

    Route::post('/dang-ki-newsletter', ['as' => 'register.newsletter', 'uses' => 'HomeController@registerNews']);    
    Route::post('/send-contact', ['as' => 'send-contact', 'uses' => 'ContactController@store']);
  
    Route::get('tim-kiem.html', ['as' => 'search', 'uses' => 'ProductController@search']);
    Route::get('ho-so-cong-ty.html', ['as' => 'info', 'uses' => 'HomeController@info']);
    Route::get('lien-he.html', ['as' => 'contact', 'uses' => 'HomeController@contact']);
    Route::get('{slug}.html', ['as' => 'danh-muc', 'uses' => 'ProductController@cate']);

});

