<?php

use App\Http\Controllers\Api\V1\VersionController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\RoleController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('signin', [AuthController::class, 'signin']);

Route::group(['middleware' => 'auth:api'], function () {

    Route::group(['middleware' => ['role:Admin', 'permission:user-read']], function () {
        Route::get('version', [VersionController::class, 'index']);
    });

    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
