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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => '/v1'], function() {

    Route::get('', 'api\HomeController@index');
    Route::get('/', 'api\HomeController@index');

    Route::group(['prefix' => '', 'middleware' => ['throttle:20,5']], function () {

        Route::post('/login', 'api\Auth\LoginController@login')->name('api.login');

        Route::post('/contact', 'api\ContactController@newContact');
        Route::post('/new-demo-request', 'api\ContactController@newDemoRequest');

        Route::post('/new-sign-up', 'api\SignUpController@index');
        Route::post('/sign-up', 'api\SignUpController@confirmSignUp');
//    Route::post('/register', 'api\Auth\RegisterController@register')->name('api.register');

    });

    Route::group(['prefix' => '', 'middleware' => ['throttle:200,5', 'auth:api']], function () {

        Route::get('/user/info', 'api\Auth\UserInfoController@index');
        Route::get('/events-user/timestamp/{start}/{end}', 'api\Events\RetrieveEventsController@getUserEventsTimestamp');
        Route::get('/unplanned-users/timestamp/{start}/{end}', 'api\Events\RetrieveEventsController@getUnplannedUsers');

        Route::group(['prefix' => '', 'middleware' => ['level2', 'employee_has_branch']], function() {
            Route::post('/user/update/{id}', 'api\Users\ManageUserController@update');

            Route::post('/new/event', 'api\Events\ManageEventsController@newEvent');
            Route::post('/delete/event', 'api\Events\ManageEventsController@deleteEvent');
            Route::post('/edit/event', 'api\Events\ManageEventsController@editEvent');
            Route::post('/events/activate', 'api\Events\ManageEventsController@activateEvents');

            Route::get('/events-branch/timestamp/{start}/{end}', 'api\Events\RetrieveEventsController@getBranchEventsTimestamp');
            Route::get('/events-branch/copy-last-week/{start}/{end}', 'api\Events\ManageEventsController@copyFromLastWeek');
            Route::get('/events-branch/delete/{start}/{end}', 'api\Events\ManageEventsController@deleteEventsTimestamp');
        });

    });

});