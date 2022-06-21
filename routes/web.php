<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeApp\UserController as WeUserController;
use App\Http\Controllers\WeApp\AlbumsController as WeAlbumsController;
use App\Http\Controllers\WeApp\AlbumController as WeAlbumController;
use App\Http\Controllers\WeApp\PhotoController as WePhotoController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\AlbumsPermissionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\TestController;
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

    Route::get('Albums/Index', [WeAlbumsController::class, 'Index']);

    Route::get('Album/Show/{ownerId}', [WeAlbumController::class, 'Show']);

    Route::get('Photo/Index/{albumId}', [WePhotoController::class, 'Index']);
});
Route::prefix('Admin')->group(function () {
    Route::get('Album/Create', [AlbumController::class, 'Create']);
    Route::post('Album/Store', [AlbumController::class, 'Store']);
    Route::get('Album/Index', [AlbumController::class, 'Index']);


    Route::get('Photo/Create',[PhotoController::class, 'Create']);
    Route::post('Photo/Store',[PhotoController::class, 'Store']);
    Route::get('Photo/Index/{AlbumId}',[PhotoController::class, 'Index']);

    Route::any('ChunkUploadFile/Upload',[ChunkUploadFileController::class, 'Upload']);

    Route::get('Account/Create', [AccountController::class, 'Create']);

    Route::get('Albums/Create', [AlbumsController::class, 'Create']);
    Route::post('Albums/Store', [AlbumsController::class, 'Store']);
    Route::get('Albums/Edit/{id}', [AlbumsController::class, 'Edit']);
    Route::post('Albums/Update', [AlbumsController::class, 'Update']);
    Route::get('Albums/Index', [AlbumsController::class, 'Index']);
    Route::post('Albums/GetList', [AlbumsController::class, 'GetList']);

    Route::get('AlbumsPermission/ModalIndex/{albumsId}', [AlbumsPermissionController::class, 'ModalIndex']);
    Route::post('Permission/Store', [PermissionController::class, 'Store']);
    Route::post('Permission/Destroy', [PermissionController::class, 'Destroy']);
    Route::post('Permission/Update/{id}', [PermissionController::class, 'Update']);
    //Route::get('Permission/getSDSelectItem/{ownerId}', [PermissionController::class, 'getSDSelectItem']);
    Route::get('Permission/getAlbumInheritText/{ownerId}', [PermissionController::class, 'getAlbumInheritText']);

    Route::get('User/Index',[UserController::class, 'Index']);
    Route::post('User/GetList',[UserController::class, 'GetList']);
    Route::post('/User/GetUserSelect',[UserController::class,'GetUserSelect']);

    Route::get('UserGroup/Index', [UserGroupController::class, 'Index']);
    Route::post('UserGroup/Store', [UserGroupController::class, 'Store']);
    Route::post('UserGroup/Destroy', [UserGroupController::class, 'Destroy']);
    Route::post('UserGroup/Update/{id}', [UserGroupController::class, 'Update']);

    Route::get('/Test/Test1',[TestController::class,'Test1']);
});

Route::get('WeApp/test', [UserController::class, 'test']);

//Route::resource('Admin/Photo', PhotoController::class);
