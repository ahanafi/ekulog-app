<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

/* Route Data Member */
Route::get('/member', 'MemberController@index');
Route::post('/member', 'MemberController@store');
Route::get('/member/{id}/edit', 'MemberController@edit');
Route::get('/member/{id}', 'MemberController@show');
Route::put('/member/{id}', 'MemberController@update');

/* Route Data Bulan */
Route::get('/month', 'MonthController@index');
Route::post('/month', 'MonthController@store');
Route::get('/month/{id}/edit', 'MonthController@edit');
Route::put('/month/{id}', 'MonthController@update');
Route::delete('/month/{id}', 'MonthController@destroy');

/* Route Data Transaksi */
Route::get('/transaction', 'TransactionController@index');
Route::get('/transaction/create', 'TransactionController@create');
Route::post('/transaction', 'TransactionController@store');
Route::get('/transaction/{id}/edit', 'TransactionController@edit');
Route::put('/transaction/{id}', 'TransactionController@update');
Route::delete('/transaction/{id}', 'TransactionController@destroy');

Route::get('/transaction-non-lunas', 'TransactionController@nominal');

/* Route Deposit */
Route::get('/deposit', 'DepositController@index');
Route::post('/deposit', 'DepositController@store');
Route::delete('/deposit/{id}', 'DepositController@destroy');
Route::get('/deposit/{id}/edit', 'DepositController@edit');
Route::put('/deposit/{id}', 'DepositController@update');

/* Route Konfigurasi */
Route::get('/config', 'ConfigController@index');
Route::post('/config', 'ConfigController@update');
//Route::put('/config/{id}', 'MonthController@update');

/* Route Jobs */
Route::get('/jobs', 'JobController@index');

/* Route Report */
Route::get('/report', 'ReportController@index');
Route::get('/report/transaction', 'ReportController@index');
Route::post('/report/print', 'ReportController@print');

Route::get('/report/member', 'ReportController@member');

Route::get('/report/deposit', 'ReportController@deposit');
Route::post('/report/deposit/show', 'ReportController@deposit_show');


/* Route Status */
Route::get('/status', 'StatusController@index');


Route::get('/home', 'HomeController@index');
