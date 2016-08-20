<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function() {
    return redirect('/auth/login');
});

/**
 * Use the space below to test controller methods
 * using postman bypassing the middleware via Routes
 */

/**
 * This route grouping is used if the route has to support sessions ONLY.
 * Most routes either require no sessions or need sessions along with additional functionality.
 * This grouping should therefore not exist in production
 */

Route::group(['middleware' => 'web'], function() {
    // Authentication routes...
    // Authentication routes...
    Route::get('auth/login', 'CustomAuthenticationController@show');
    Route::post('auth/login', 'CustomAuthenticationController@loginUser');
    Route::get('auth/logout', 'CustomAuthenticationController@logoutUser');

    //Password reset routes
    Route::get('/auth/reset-password', 'CustomAuthenticationController@resetPasswordView');
    Route::post('/auth/reset-password', 'CustomAuthenticationController@passwordReset');

    // Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

});


/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
|
| This grouping of routes are used when the user must be logged into their account
| Most pages will require the user to be logged in, except for a few such as the login page
| This route grouping provides the required middleware for user authorisation via the
| 'RedirectIfUserIsNotLoggedIn' middleware
|
*/
Route::group(['middleware' => ['web', 'requireAuth']], function() {

});
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| This grouping of routes are used when the user that is logged in is of an 'admin' type.
| Relevant middleware can be found in 'RedirectIfUserIsNotAdmin'
|
*/
Route::group(['middleware' => ['web', 'requireAuthAdmin']], function() {
    Route::get('/admin', 'AdminController@index');
});

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| This grouping of routes are used when the user that is logged in is of an 'client' type.
| Relevant middleware can be found in 'RedirectIfUserIsNotClient'
|
*/
Route::group(['middleware' => ['web', 'requireAuthClient']], function() {
    Route::get('/client', 'HomeController@index');
});
