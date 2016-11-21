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

//Route::get('/', function() {
//    return redirect('/auth/login');
//});

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
    Route::get('/', 'MainController@index');
    Route::post('/templates/mail', 'MainController@store_mail');
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

    //user profile routes
    Route::get('/my-profile/{id}', 'ProfileController@index')
        ->where(['id' => '[0-9]+']);
    Route::get('/my-profile/{id}/edit', 'ProfileController@edit')
        ->where(['id' => '[0-9]+']);
    Route::put('/my-profile/{id}/edit', 'ProfileController@update')
        ->where(['id' => '[0-9]+']);
    Route::put('my-profile/{id}/edit/password', 'ProfileController@updatePass')
        ->where(['id' => '[0-9]+']);
    Route::post('/userLINK', 'ProfileController@link');
    Route::post('user/{pic}', 'ProfileController@picture');
    Route::post('/twitter', 'ProfileController@widget');
    

    //notification routes
    Route::get('/notifications','NotificationController@show');
    Route::get('/notificationsC','NotificationController@count');
    Route::patch('/notifications','NotificationController@update');
    Route::get('/notificationsView','NotificationController@index');

    Route::get('/temp_store','StoreController@index');

    Route::get('preorder/show/{id}', 'StoreController@show');
    Route::post('preorder/buy/{id}', 'StoreController@buy');
    Route::any('preorder/inovice/{id}', 'StoreController@getInvoice');
    Route::resource('preorder', 'StoreController',
        ['except' => ['show']]
    );
    Route::controller('preorder', 'StoreController');

    //tharindu
    Route::any('/calender/view', 'AdminController@calender_view');
    Route::any('/calender/add_event', 'AdminController@calender_add_event');
    Route::any('/calender/{event}/delete', 'AdminController@calender_delete_event');
    Route::any('/calender/{event}/delete_all', 'AdminController@calender_delete_full_event');
    Route::any('/calender/{event}/edit_event', 'AdminController@calender_edit_event');
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
    Route::get('/templates/new', 'AdminController@index');
    Route::get('/templates/edit', 'AdminController@view');
    Route::get('/landing', 'AdminController@admin_view');
    Route::post('/update' , 'AdminController@update');
    Route::get('/admin/home' , 'AdminController@admin_view');

    Route::get('/templates/{temp}/edit' , 'AdminController@edit');
    Route::get('/templates/show/{temp}' , 'AdminController@show');
    Route::get('/templates/{temp}/delete' , 'AdminController@delete');
    Route::post('/templates/{temp}/update' , 'AdminController@update');
    Route::post('/templates/store', 'AdminController@store');

    Route::get('/templates/slide', 'AdminController@slide_view');
    //Route::get('/templates/slide', 'AdminController@slide_view');

    Route::post('/templates/slide/new', 'AdminController@store_image');
    Route::post('/templates/slide/select', 'AdminController@add_to_album');
    Route::post('/templates/slide/delete', 'AdminController@remove_from_album');
    Route::get('/templates/slide/{slide}/change1' , 'AdminController@change1');
    Route::get('/templates/slide/{slide}/change2' , 'AdminController@change2');
    Route::get('/templates/slide/{slide}/change3' , 'AdminController@change3');

    Route::get('/templates/mail/view', 'MainController@view_mail');
    Route::get('/templates/{mail}/ignor' , 'MainController@ignor_mail');
    Route::post('templates/{mail}/reply' , 'MainController@reply_mail');
    Route::get('templates/{mail}/show' , 'MainController@show_mail');


    Route::get('/admin/user/manage', 'AdminController@user_view');
    Route::get('user/{user}/promote' , 'AdminController@promote');
    Route::get('user/{user}/pro_super_admin' , 'AdminController@pro_super_admin');
    Route::post('user/{user}/demote' , 'AdminController@demote');
    Route::post('user/{user}/kick-out' , 'AdminController@kickout');
    Route::get('/admin/user/removed', 'AdminController@re_user_view');

//    Route::any('/calender/view', 'AdminController@calender_view');
//    Route::any('/calender/add_event', 'AdminController@calender_add_event');
//    Route::any('/calender/{event}/delete', 'AdminController@calender_delete_event');
//    Route::any('/calender/{event}/delete_all', 'AdminController@calender_delete_full_event');
//    Route::any('/calender/{event}/edit_event', 'AdminController@calender_edit_event');

    Route::any('/reports', 'AdminController@view_report_page');
    Route::any('/reports/user', 'PDFController@report_user');
    Route::any('/getPDF/user', 'PDFController@getPDF_user');
    Route::any('/reports/event', 'PDFController@report_event');
    Route::any('/getPDF/event', 'PDFController@getPDF_event');
    Route::any('/reports/event/search-download', 'PDFController@report_event_search');
    Route::any('/reports/temp', 'PDFController@report_temp');
    Route::any('/reports/temp/search-download', 'PDFController@report_temp_search');


    Route::get('/admin/logs/login', 'AdminController@viewLoginLog');
    Route::get('/admin/get-all-login', 'AdminController@getLoginLog');

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





    Route::get('/home', 'HomeController@index');
    Route::get('/home/store','HomeController@store');//dynamic content sameera
    Route::get('/home/getdata','HomeController@getdata');//dynamic content sameera
    Route::get('/home/delete','HomeController@deleteTab');
    //gallery routes
    Route::get('gallery/list','GalleryController@viewGalleryList');
    Route::post('gallery/save','GalleryController@saveGallery');
    Route::post('gallery/edit/{id}','GalleryController@editGallery');
    Route::post('gallery/delete/{id}','GalleryController@deleteGallery');
    Route::post('gallery/deleteImg/{id}','GalleryController@deleteImage');
    Route::get('gallery/view/{id}','GalleryController@viewGalleryPics');
    Route::post('image/do-upload','GalleryController@doImageUpload');

    //sameera
    Route::get('/temp','Loaddemo_controller@index');
    Route::get('/demo','Loaddemo_controller@demo');
    Route::get('/edit/{id}','Loaddemo_controller@edit');
    Route::get('/site/album','SiteController@getItems');
    Route::resource('site','SiteController');

    Route::resource('post','PostController');//insert,delete,create,view post routes
    Route::get('updatepost/{post}','PostController@update');//updating post route

    Route::any('/calender/view_site', 'AdminController@calender_view_site');//tharindu
    Route::post('/store/{id}','SiteController@store');//sameera
    //comments
    Route::get('comments',['uses'=>'CommentsController@store','as'=>'comments.store']);
    Route::get('comments/show/{post_id}',['uses'=>'CommentsController@show','as'=>'showcomments.show']);
    Route::get('comments/all',['uses'=>'CommentsController@index','as'=>'showallcomments.show']);
    Route::post('delete/{id}',['uses'=>'CommentsController@destroy','as'=>'delete.comment']);
    Route::get('approve','CommentsController@approve');
    Route::get('getapprovecomments','CommentsController@getApproveComments');
    Route::get('getComments','CommentsController@getComments');
    Route::get('getNewComments','CommentsController@getUnreadandUnapprovedcomments');

    Route::get('ViewTemplateChange/{tempname}/{siteid}',['uses'=>'SiteController@ViewChangeTemp','as'=>'viewtempchange.temp']);
    Route::get('ChangeTemplate/{old}/{new}/{siteid}',['uses'=>'SiteController@update','as'=>'changeTemplate.change']);
    Route::get('showupdatedsites','SiteController@index');

});
