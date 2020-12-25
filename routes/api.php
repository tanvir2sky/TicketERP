<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('/user', 'Auth\UserController@current');

    Route::patch('settings/profile', 'Settings\UserProfileController@updateProfile');
    Route::patch('settings/password', 'Settings\UserProfileController@updatePassword');

    Route::resource('global-settings','Settings\GlobalSettingsController')->only(['index','store','update']);
    Route::resource('users','Resource\UserResourceController')->only(['index','store','show','destroy' ,'update']);
    Route::resource('ticket-categories','Resource\TicketCategoryResourceController')->only(['index','store','show','destroy' ,'update']);
    Route::resource('priorities','Resource\PriorityResourceController')->only(['index','store','show','destroy','update']);
    Route::resource('tickets','Resource\TicketResourceController')->only(['index','store','show','destroy' ,'update']);
    Route::resource('ticket-replies','Resource\TicketReplyResourceController')->only(['store','update']);
    Route::resource('faqs','Resource\FaqResourceController')->only(['index','store','show','destroy' ,'update']);

    Route::resource('logo','Resource\LogoResourceController')->only(['update']);

    Route::resource('dashboard-report','Reports\DashboardReportController')->only(['index']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
    //Ticket Create Request
    Route::post('frontend/store-ticket','Frontend\Ticket\TicketCreateController@store');
    Route::post('frontend/store-reply','Frontend\Ticket\TicketManageController@store');
    Route::post('frontend/search-ticket','Frontend\Ticket\TicketManageController@searchTicket');
    //all categories for frontend
    Route::get('frontend/categories', 'Frontend\TicketCategory\TicketCategoryController@index');
    Route::resource('frontend/faqs', 'Frontend\Faq\FaqController')->only(['index' , 'show']);
});
