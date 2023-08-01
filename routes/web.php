<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    //user management
    Route::group(['prefix' => 'userroles'], function () {
        Route::get('/get', [UserRoleController::class, 'index']);
        Route::get('/{id}', [UserRoleController::class, 'getById']);
        Route::post('/store', [UserRoleController::class, 'store']);
        Route::patch('/update', [UserRoleController::class, 'update']);
    });
    Route::group(['prefix' => 'role'], function () {
        Route::get('/get', [RoleController::class, 'get']);
        Route::get('/getById/{id}', [RoleController::class, 'getById']);
        Route::post('/store', [RoleController::class, 'store']);
        Route::patch('/update/{id}', [RoleController::class, 'update']);
        Route::delete('/delete/{id}', [RoleController::class, 'delete']);
    });
    Route::group(['prefix' => 'permissions'], function () {
        Route::get('/get', [PermissionController::class, 'get']);
        Route::get('/index', [PermissionController::class, 'index']);
        Route::get('/getById/{id}', [PermissionController::class, 'getById']);
        Route::post('/store', [PermissionController::class, 'store']);
        Route::delete('/delete/{id}', [PermissionController::class, 'destroy']);
        Route::get('/update/{id}', [PermissionController::class, 'update']);
    });
});
