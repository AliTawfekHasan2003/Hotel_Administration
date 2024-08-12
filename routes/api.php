<?php

use App\Http\Controllers\Admin\RoleAndPermissionController;
use App\Http\Controllers\Admin\Room_ServiceController;
use App\Http\Controllers\Admin\Room_TypeController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\Room_Type;
use App\Models\User;
use PhpParser\Node\Stmt\Return_;
use App\Traits\ResponseTrait;
use GuzzleHttp\Psr7\Response;

use function Laravel\Prompts\error;

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

Route::middleware(['auth:api', 'role:Admin', 'permission:Services and rooms management'])->group(function () {
    Route::apiResource('room_types', Room_TypeController::class);
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('services', ServiceController::class);
});
 
Route::middleware(['auth:api', 'role:Admin', 'permission:Services and rooms management'])->group(function () {
    Route::controller(Room_ServiceController::class)->group(function () {
        Route::post('AssignServicesToRoom_type','AssignServicesToRoom_type');
        Route::post('RevokeServicesFromRoom_type','RevokeServicesFromRoom_type');
    });
});

