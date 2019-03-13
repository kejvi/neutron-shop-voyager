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

use \App\Http\Controllers\ClientRegistration;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reg', [
    'uses' => 'ClientRegistration@showFormForRegistration',
    'as' => 'client.get'
]);
Route::post('/reg', [
    'uses' => 'ClientRegistration@makeRegistration',
    'as' => 'client.post'
]);

Route::get('/cities/get', [
    'uses' => 'ClientRegistration@getCities',
    'as' => 'voyager.get_cities'
]);

Route::get('get/city/{city}/njesite/', [
    'uses' => 'ClientRegistration@getNjesia',
    'as' => 'voyager.get_njesia'
]);

Route::get('get/{branch}/offices', [
    'uses' => 'ClientRegistration@getOfficesByBranch',
    'as' => 'voyager.get_offices'
]);


Route::group(['prefix' => 'admin'], function () {

    Voyager::routes();

    Route::post('/login', [
        'uses' => 'Admin\\LoginController@postLogin',
        'as' => 'voyager.custom.login'
    ]);



    Route::group(['middleware' => 'admin.user'], function () {

        Route::get('/kthime/check-approved', [
            'uses' => 'ReturnsController@checkIfApproved',
            'as' => 'voyager.returns.check_if_approved'
        ]);

        Route::get('/kthime/{id}/print-fatura', [
            'uses' => 'ReturnsController@printFatura',
            'as' => 'voyager.returns.print-fatura'
        ]);

        Route::get('/kthime/check-for-new-records', [
            'uses' => 'ReturnsController@checkForNew',
            'as' => 'voyager.returns.check_for_new'
        ]);


        Route::post('/kthime/auto-reject', [
            'uses' => 'ReturnsController@reject',
            'as' => 'voyager.returns.autoreject'
        ]);
    });


    Route::group(['namespace' => 'Admin' , 'middleware' => 'admin.user'], function () {


        Route::post('/print', [
            'uses' => 'PosController@ruajArtikujtEShitur',
            'as' => 'voyager.pos.storePrint'
        ]);

        Route::get('/change-password', [
            'uses' => 'AdminController@changePassword',
            'as' => 'voyager.change_password'
        ]);

        Route::post('/change-password/post', [
            'uses' => 'AdminController@postChangePassword',
            'as' => 'voyager.post_change_password'
        ]);

        Route::get('/report-daily', [
            'uses' => 'ReportsController@makeDailyReport',
            'as' => 'voyager.daily'
        ]);

        Route::get('/report', [
            'uses' => 'ReportsController@makeMonthlyReports',
            'as' => 'voyager.report'
        ]);

        Route::get('/import', [
            'uses' => 'ReportsController@import',
            'as' => 'voyeager.import'
        ]);

        Route::post('/test', [
            'uses' => 'ReportsController@upload',
            'as' => ''
        ]);
        Route::post('/reprint/{id}', [
            'uses' => 'ReportsController@reprint',
            'as' => 'voyeager.reprint'
        ]);
        Route::get('/import-sales', [
            'uses' => 'SalesSpreadController@import',
            'as' => 'voyeager.import-sales'
        ]);

        Route::post('/spread', [
            'uses' => 'SalesSpreadController@upload',
            'as' => ''
        ]);

        Route::get('filiali/get-by-role', [
            'uses' => 'MonitoringController@getSitesByRole',
            'as' => 'get.sites.by-role'
        ]);

        Route::get('filiali/deget/get-by-role', [
            'uses' => 'MonitoringController@getBranchesByRole',
            'as' => 'get.branches.by-role'
        ]);

        Route::get('deget/zyrat/get-by-role', [
            'uses' => 'MonitoringController@getOfficesByRole',
            'as' => 'get.offices.by-role'
        ]);

        Route::get('zyrat/users/get-by-role', [
            'uses' => 'MonitoringController@getUsersByRole',
            'as' => 'get.users.by-role'
        ]);

        Route::get('export/exel-with-barcodes', [
            'uses' => 'MonitoringController@exportWithBarcodes',
            'as' => 'reports.export.with_barcodes'
        ]);

        Route::get('/import-users',[
            'uses' => 'ImportUsersController@import',
            'as' => 'voyeager.import-users'
        ]);

        Route::post('/register-users', [
            'uses' => 'ImportUsersController@upload',
            'as' => ''
        ]);

        Route::get('/print/fatura', [
            'uses' => 'PosController@printFatura',
            'as' => 'pos.print.fatura'
        ]);

        Route::get('/print/bilanci-ditor', [
            'uses' => 'ReportsController@printDailyBill',
            'as' => 'pos.print.bilanci-ditor'
        ]);

        Route::post('/transfer-to-office', [
            'uses' => 'SalesManagerController@transfer',
            'as' => 'transfer-to-office'
        ]);




    });


});


