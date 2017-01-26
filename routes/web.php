<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::get('/','ConferencesController@index');

Route::group(['middleware'=>['web']], function () {

    Route::post('conferences/{conference}/informations/{information}/articles','ArticlesController@store')->middleware('admin');
    Route::get('conferences/{conference}/informations/{information}/articles/create','ArticlesController@create')->middleware('admin');
    Route::delete('conferences/{conference}/informations/{information}/articles/{article}','ArticlesController@destroy')->middleware('admin');
    Route::get('conferences/{conference}/informations/{information}/articles/{article}/delete','ArticlesController@delete')->middleware('admin');
    Route::patch('conferences/{conference}/informations/{information}/articles/{article}','ArticlesController@update')->middleware('admin');
    Route::get('conferences/{conference}/informations/{information}/articles/{article}/edit','ArticlesController@edit')->middleware('admin');
    Route::get('conferences/{conference}/informations/{information}/articles','ArticlesController@index')->middleware('admin');
    Route::get('conferences/{conference}/informations/{information}/articles/{article}','ArticlesController@show')->middleware('admin');

    Route::post('conferences','ConferencesController@store')->middleware('admin');
    Route::get('conferences/create','ConferencesController@create')->middleware('admin');
    Route::delete('conferences/{conference}','ConferencesController@destroy')->middleware('admin');
    Route::get('conferences/{conference}/delete','ConferencesController@delete')->middleware('admin');
    Route::get('conferences/{conference}/edit','ConferencesController@edit')->middleware('admin');
    Route::patch('conferences/{conference}','ConferencesController@update')->middleware('admin');
    Route::get('conferences','ConferencesController@index');
    Route::get('conferences/{conference}','ConferencesController@show');

    Route::post('conferences/{conference}/informations','InformationController@store')->middleware('admin');
    Route::get('conferences/{conference}/informations/create','InformationController@create')->middleware('admin');
    Route::delete('conferences/{conference}/informations/{information}','InformationController@destroy')->middleware('admin');
    Route::get('conferences/{conference}/informations/{information}/delete','InformationController@delete')->middleware('admin');
    Route::get('conferences/{conference}/informations/{information}/edit','InformationController@edit')->middleware('admin');
    Route::patch('conferences/{conference}/informations/{information}','InformationController@update')->middleware('admin');
    Route::get('conferences/{conference}/informations','InformationController@index');
    Route::get('conferences/{conference}/informations/{information}','InformationController@show');


    Route::patch('conferences/{conference}/banners/{banner}','BannersController@update')->middleware('admin');
    Route::get('conferences/{conference}/banners/{banner}/edit','BannersController@edit')->middleware('admin');

    Route::post('conferences/{conference}/sponsors_categories','SponsorsCategoriesController@store')->middleware('admin');
    Route::get('conferences/{conference}/sponsors_categories/create','SponsorsCategoriesController@create')->middleware('admin');
    Route::delete('conferences/{conference}/sponsors_categories/{sponsors_category}','SponsorsCategoriesController@destroy')->middleware('admin');
    Route::get('conferences/{conference}/sponsors_categories/{sponsors_category}/delete','SponsorsCategoriesController@delete')->middleware('admin');
    Route::patch('conferences/{conference}/sponsors_categories/{sponsors_category}','SponsorsCategoriesController@update')->middleware('admin');
    Route::get('conferences/{conference}/sponsors_categories/{sponsors_category}/edit','SponsorsCategoriesController@edit')->middleware('admin');

    Route::post('conferences/{conference}/sponsors_categories/{sponsors_category}/sponsors','SponsorsController@store')->middleware('admin');
    Route::get('conferences/{conference}/sponsors_categories/{sponsors_category}/sponsors/create','SponsorsController@create')->middleware('admin');
    Route::delete('conferences/{conference}/sponsors_categories/{sponsors_category}/sponsors/{sponsor}','SponsorsController@destroy')->middleware('admin');
    Route::get('conferences/{conference}/sponsors_categories/{sponsors_category}/sponsors/{sponsor}/delete','SponsorsController@delete')->middleware('admin');
    Route::patch('conferences/{conference}/sponsors_categories/{sponsors_category}/sponsors/{sponsor}','SponsorsController@update')->middleware('admin');
    Route::get('conferences/{conference}/sponsors_categories/{sponsors_category}/sponsors/{sponsor}/edit','SponsorsController@edit')->middleware('admin');


    Route::get('login','Auth\LoginController@showLoginForm');
    Route::post('login','Auth\LoginController@login');
    Route::post('logout','Auth\LoginController@logout');

    Route::get('register/confirm/{token}','Auth\RegisterController@confirmEmail');
    Route::post('postRegister','Auth\RegisterController@register');
    Route::get('preRegister','Auth\RegisterController@showPreRegistrationForm');
    Route::post('show/register','Auth\RegisterController@showRegistrationForm');
    Route::get('show/register/{user_type}','Auth\RegisterController@showRegistrationFormGet');
    Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset','Auth\ResetPasswordController@reset');
    Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm');



    Route::get('admin_login','AdminAuth\LoginController@showLoginForm');
    Route::post('admin_login','AdminAuth\LoginController@login');
    Route::post('admin_logout','AdminAuth\LoginController@logout');

    Route::get('user_panel','UserController@index')->middleware('auth');
    Route::get('user_panel/edit','UserController@edit')->middleware('auth');
    Route::get('user_panel/files','UserController@files')->middleware('auth');
    Route::patch('user_panel','UserController@update')->middleware('auth');
    Route::post('user_panel/upload/presentation','UserController@uploadPresentation')->middleware('auth');
    Route::post('user_panel/upload/summary','UserController@uploadSummary')->middleware('auth');
    Route::post('user_panel/upload/poliforum','UserController@uploadPoliforum')->middleware('auth');
    Route::get('user_panel/download/presentation','UserController@downloadPresentation')->middleware('auth');
    Route::get('user_panel/download/summary','UserController@downloadSummary')->middleware('auth');
    Route::get('user_panel/download/poliforum','UserController@downloadPoliforum')->middleware('auth');
    Route::get('user_panel/delete/presentation','UserController@deletePresentation')->middleware('auth');
    Route::get('user_panel/delete/summary','UserController@deleteSummary')->middleware('auth');
    Route::get('user_panel/delete/poliforum','UserController@deletePoliforum')->middleware('auth');
    Route::delete('user_panel/destroy/presentation','UserController@destroyPresentation')->middleware('auth');
    Route::delete('user_panel/destroy/summary','UserController@destroySummary')->middleware('auth');
    Route::delete('user_panel/destroy/poliforum','UserController@destroyPoliforum')->middleware('auth');
    Route::get('user_panel/meetings','UserController@meetings')->middleware('auth');
    Route::post('user_panel/meetings','UserController@acceptMeetings')->middleware('auth');
    Route::get('user_panel/contact','UserController@contact')->middleware('auth');

    Route::get('admin_panel','AdminController@index')->middleware('admin');
    Route::get('admin_panel/files','AdminController@files')->middleware('admin');
    Route::get('admin_panel/meetings','AdminController@meetings')->middleware('admin');
    Route::get('admin_panel/users','AdminController@users')->middleware('admin');
    Route::post('admin_panel/users/{user}/verify','AdminController@verify')->middleware('admin');
    Route::post('admin_panel/users{user}/ban','AdminController@ban')->middleware('admin');
    Route::get('admin_panel/users/{user}','AdminController@showUser')->middleware('admin');
    Route::get('admin_panel/users/{user}/delete','AdminController@delete')->middleware('admin');
    Route::delete('admin_panel/users/{user}','AdminController@destroy')->middleware('admin');
    Route::get('admin_panel/{user}/download/presentation','AdminController@downloadPresentation')->middleware('admin');
    Route::get('admin_panel/{user}/download/summary','AdminController@downloadSummary')->middleware('admin');
    Route::get('admin_panel/{user}/download/poliforum','AdminController@downloadPoliforum')->middleware('admin');
    Route::get('admin_panel/{user}/delete/presentation','AdminController@deletePresentation')->middleware('admin');
    Route::get('admin_panel/{user}/delete/summary','AdminController@deleteSummary')->middleware('admin');
    Route::get('admin_panel/{user}/delete/poliforum','AdminController@deletePoliforum')->middleware('admin');
    Route::delete('admin_panel/{user}/destroy/presentation','AdminController@destroyPresentation')->middleware('admin');
    Route::delete('admin_panel/{user}/destroy/summary','AdminController@destroySummary')->middleware('admin');
    Route::delete('admin_panel/{user}/destroy/poliforum','AdminController@destroyPoliforum')->middleware('admin');

    Route::post('admin_panel/meetings','AdminController@storeMeeting')->middleware('admin');
    Route::get('admin_panel/meetings/create','AdminController@createMeeting')->middleware('admin');
    Route::delete('admin_panel/meetings/{meeting}','AdminController@destroyMeeting')->middleware('admin');
    Route::get('admin_panel/meetings/{meeting}/delete','AdminController@deleteMeeting')->middleware('admin');
    Route::get('admin_panel/meetings/{meeting}/edit','AdminController@editMeeting')->middleware('admin');
    Route::patch('admin_panel/meetings/{meeting}','AdminController@updateMeeting')->middleware('admin');
    Route::get('admin_panel/meetings/{meeting}','AdminController@showMeeting')->middleware('admin');
    Route::get('admin_panel/meetings/{meeting}/delete/{user}','AdminController@deleteUserFromMeeting')->middleware('admin');
    Route::delete('admin_panel/meetings/{meeting}/delete/{user}','AdminController@destroyUserFromMeeting')->middleware('admin');

});

