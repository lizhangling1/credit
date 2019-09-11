<?php

Route::get('/', 'IndexController@index');

Route::get('/login', 'UserController@login');
Route::post('/login/act', 'UserController@loginAction');
Route::get('/login/recaptcha', 'UserController@recaptcha');
Route::get('/register', 'UserController@register');
Route::post('/register/act', 'UserController@registerAction');
Route::get('/logout', 'UserController@logoutAction');
Route::get('/verify', 'UserController@verify');
Route::post('/email/verify', 'UserController@verifyAction');
Route::get('/send/mail', 'UserController@sendEmail');

Route::get('/loan/introduce', 'LoanController@introduction');
Route::get('/loan/process', 'LoanController@process');
Route::post('/loan/create', 'LoanController@create');
Route::get('/loan/affirm', 'LoanController@affirm');
Route::get('/loan/next', 'LoanController@intoStep');//进入第三步了
Route::get('/loan/pre', 'LoanController@intoPreStep');//进入第三步了
Route::post('/loan/report', 'LoanController@creditReport');//上传信用报告

//公共方法
Route::post('/file/update', 'ToolsController@fileUpdate');


//20190909 test passing of url to php
Route::get('/loan/session', 'LoanController@sessionAction');

Route::any('/email', 'ToolsController@sendEmail');



