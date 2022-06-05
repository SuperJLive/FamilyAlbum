<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeApp\UserController as WeUserController;
use App\Http\Controllers\WeApp\AlbumOwnerController as WeAlbumOwnerController;
use App\Http\Controllers\WeApp\AlbumController as WeAlbumController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AlbumOwnerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Models\AlbumOwner;
use Illuminate\Support\Facades\File;
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

Route::get('/',function(){
    return File::get(public_path() . '/index.html');
});
//Route::get('wxprog/onlogin/{code}', [UserController::class, 'onLogin']);

Route::prefix('WeApp')->group(function () {
    Route::get('onLogin/{code}', [WeUserController::class, 'onLogin']);
    Route::post('CheckLogin', [WeUserController::class, 'CheckLogin']);

    Route::get('AlbumOwner/Index', [WeAlbumOwnerController::class, 'Index']);

    Route::get('Album/Show/{ownerId}', [WeAlbumController::class, 'Show']);
});
Route::prefix('Admin')->group(function () {
    Route::get('Album/Create', [AlbumController::class, 'Create']);
    Route::post('Album/Store', [AlbumController::class, 'Store']);
    Route::get('Album/Index', [AlbumController::class, 'Index']);


    Route::get('Photo/Create',[PhotoController::class, 'Create']);
    Route::post('Photo/Store',[PhotoController::class, 'Store']);
    Route::get('Photo/Index/{AlbumId}',[PhotoController::class, 'Index']);

    Route::get('Account/Create', [AccountController::class, 'Create']);

    Route::get('AlbumOwner/Create', [AlbumOwnerController::class, 'Create']);
    Route::post('AlbumOwner/Store', [AlbumOwnerController::class, 'Store']);
    Route::get('AlbumOwner/Index', [AlbumOwnerController::class, 'Index']);
    Route::post('AlbumOwner/GetList', [AlbumOwnerController::class, 'GetList']);

    Route::get('Permission/Index', [PermissionController::class, 'Index']);
    Route::post('Permission/Store', [PermissionController::class, 'Store']);
    Route::post('Permission/Destroy', [PermissionController::class, 'Destroy']);
    Route::post('Permission/Update/{id}', [PermissionController::class, 'Update']);
    //Route::get('Permission/getSDSelectItem/{ownerId}', [PermissionController::class, 'getSDSelectItem']);
    Route::get('Permission/getAlbumInheritText/{ownerId}', [PermissionController::class, 'getAlbumInheritText']);

    Route::get('User/Index',[UserController::class, 'Index']);
    Route::post('User/GetList',[UserController::class, 'GetList']);

    Route::post('/User/GetUserSelect',[UserController::class,'GetUserSelect']);

    Route::get('/Test/Test1',[TestController::class,'Test1']);
});

Route::get('WeApp/test', [UserController::class, 'test']);

//Route::resource('Admin/Photo', PhotoController::class);
