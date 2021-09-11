<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeApp\UserController;
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

Route::get('/', function () {
    return view('master');
});

Route::get('admin/AccountAdd', function () {
    return view('Account.AccountAdd');
});

//Route::get('wxprog/onlogin/{code}', [UserController::class, 'onLogin']);

Route::prefix('WeApp')->group(function () {
    Route::get('onlogin/{code}', [UserController::class, 'onLogin']);
});
Route::get('WeApp/test', [UserController::class, 'test']);

