<?php

use Illuminate\Http\Request;
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
Route::post('/login', 'API\Auth\UserController@login');

Route::middleware('auth:api', 'throttle:1200,1')->group(function () {
    Route::post('/loan-request', 'API\Loan\LoanController@loanRequest');
    Route::post('/user-payment', 'API\Loan\LoanController@repaymentLoan');
    Route::get('/current-loan', 'API\Loan\LoanController@currentloan');
    Route::get('/loan-history', 'API\Loan\LoanController@loanHistory');

});
