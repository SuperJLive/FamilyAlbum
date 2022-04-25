<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeApp\UserController as WeUserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AlbumOwnerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
//use phpDocumentor\Reflection\Types\Resource_;

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
Route::prefix('Admin')->group(function () {
    Route::get('Album/Create', [AlbumController::class, 'Create']);
    //Route::resource('Account', 'AccountController');
    Route::get('Account/Create', [AccountController::class, 'Create']);

    Route::get('AlbumOwner/Create', [AlbumOwnerController::class, 'Create']);

    Route::get('Permission/Index', [PermissionController::class, 'Index']);
    Route::post('Permission/Store', [PermissionController::class, 'Store']);
    Route::post('Permission/Destroy', [PermissionController::class, 'Destroy']);
    Route::post('Permission/Update/{id}', [PermissionController::class, 'Update']);

    Route::get('User/Index',[UserController::class, 'Index']);
    Route::post('User/GetList',[UserController::class, 'GetList']);
});
Route::get('WeApp/test', [UserController::class, 'test']);
