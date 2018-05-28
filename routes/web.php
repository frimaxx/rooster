<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');

/**
 * Level 5 god routes
 */
Route::middleware(['auth', 'level5'])->group(function () {
    Route::get('/new/company', 'Companies\NewCompanyController@index')->name('new.company');
    Route::post('/new/company', 'Companies\NewCompanyController@addCompany');

    Route::get('/change-company/{id}', 'Companies\ChangeCompaniesController@changeCompany')->name('change.company');
});

/**
 * Level 4 and up routes
 */
Route::middleware(['auth', 'level4'])->group(function () {
    Route::get('/new/branch', 'Branches\NewBranchController@index')->name('new.branch');
    Route::post('/new/branch', 'Branches\NewBranchController@addBranch');

    Route::get('/edit/company', 'Companies\EditCompanyController@index')->name('edit.company');
    Route::post('/edit/company', 'Companies\EditCompanyController@editCompany')->name('edit.company');
});

/**
 * Level 3 and up routes
 */
Route::middleware(['auth', 'level3'])->group(function() {
    Route::get('/new/manager', 'Managers\NewMangerController@index')->name('new.manager');
    Route::post('/new/manager', 'Managers\NewMangerController@addManager');
});

/**
 * Level 2 and up routes
 */
Route::middleware(['auth', 'level2'])->group(function() {
    Route::get('/new/employee', 'Employees\NewEmployeeController@index')->name('new.employee');
    Route::post('/new/employee', 'Employees\NewEmployeeController@addEmployee');

    Route::get('/new/rooster', 'Rooster\RoosterController@index')->name('new.rooster');
    Route::get('/print-schedule', 'Rooster\RoosterController@printRooster')->name('printRooster');

    Route::get('/change-branch/{branch_id}', 'Branches\setCurrentBranchController@setBranch')->name('change.branch');

    Route::get('/manage-users', 'Managers\ManageUsersController@index')->name('manage.users');

    Route::get('/user/{id}', 'Managers\ManageUsersController@showUser')->name('user.info');
    Route::post('/user/{id}/change-role', 'Managers\ManageUsersController@changeRole')->name('user.change-role');
    Route::post('/user/{id}/addBranch', 'Managers\ManageUsersController@addBranch')->name('user.addBranch');
    Route::post('/user/{id}/addManagerToBranch', 'Managers\ManageUsersController@addManagerBranch')->name('user.addManagerBranch');
    Route::get('/user/{id}/deleteUserFromBranch/{branch_id}', 'Managers\ManageUsersController@deleteUserFromBranch')->name('user.deleteUserFromBranch');
    Route::get('/user/{id}/deleteManagerFromBranch/{branch_id}', 'Managers\ManageUsersController@deleteManagerFromBranch')->name('user.deleteManagerFromBranch');
    Route::post('/user/{id}/delete', 'Managers\ManageUsersController@deleteUser')->name('user.deleteUser');

    Route::get('/manage-branches', 'Branches\ManageBranchesController@showBranches')->name('manage.branches');
    Route::post('/manage-branches/update-branch', 'Branches\ManageBranchesController@editBranch')->name('update.branch');
    Route::post('/manage-branches/delete', 'Branches\ManageBranchesController@deleteBranch')->name('delete.branch');
});

/**
 * Authenticated routes
 */
Route::middleware(['auth'])->group(function() {
   Route::get('/account', 'Auth\AccountSettingsController@index')->name('auth.account');
   Route::post('/account/update-email', 'Auth\AccountSettingsController@updateEmail')->name('auth.account.email');
   Route::post('/account/update-password', 'Auth\AccountSettingsController@updatePassword')->name('auth.account.password');
   Route::post('/account/upload-avatar', 'Auth\AccountSettingsController@uploadAvatar')->name('auth.account.avatar');
});

// Register
Route::get('/confirm/sign-up/{token}', 'SignUpController@index')->name('confirm.signup');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');