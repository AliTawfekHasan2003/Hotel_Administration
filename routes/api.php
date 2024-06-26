<?php

use App\Http\Controllers\Admin\RoleAndPermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use PhpParser\Node\Stmt\Return_;
use App\Traits\ResponseTrait;
use GuzzleHttp\Psr7\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout')->middleware("auth:api");
    Route::post('refresh', 'refresh')->middleware("auth:api");
});

Route::middleware(['auth:api', 'role:Admin', 'permission:Roles and permissions management'])->group(function () {
    Route::controller(RoleAndPermissionController::class)->group(function () {
        Route::get('GetAllPermissions', 'GetAllPermissions');
        Route::get('GetAllPermissionsForAdmin/{user}', 'GetAllPermissionsForAdmin');
        Route::put('AssignAllPermissionsToAdmin/{user}', 'AssignAllPermissionsToAdmin');
        Route::delete('RevokeAllPermissionsFromAdmin/{user}', 'RevokeAllPermissionsFromAdmin');
        Route::post('AssignPermissionToAdmin', 'AssignPermissionToAdmin');
        Route::post('RevokePermissionFromAdmin', 'RevokePermissionFromAdmin');
        Route::put('UpdateToUserRole/{user}', 'UpdateToUserRole');
        Route::put('UpdateToAdminRole/{user}', 'UpdateToAdminRole');
    });
});
