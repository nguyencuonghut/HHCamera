<?php

use App\Http\Controllers\AdminAdminController;
use App\Http\Controllers\AdminDeviceCategoryController;
use App\Http\Controllers\AdminDeviceController;
use App\Http\Controllers\AdminDeviceLogController;
use App\Http\Controllers\AdminErrorController;
use App\Http\Controllers\AdminErrorTypeController;
use App\Http\Controllers\AdminFarmController;
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\UserDeviceController;
use App\Http\Controllers\UserErrorController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\UserLoginController;
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

/**
 * Admin routes
 */
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'handleLogin'])->name('admin.handleLogin');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::name('admin.')->prefix('admin')->group(function() {
    Route::group(['middleware'=>'auth:admin'], function() {
        Route::get('/', [AdminHomeController::class, 'index'])->name('home');
        Route::get('/profile', [AdminHomeController::class, 'profile'])->name('profile');
        Route::get('/change-password', [AdminHomeController::class, 'showChangePasswordForm'])->name('change.password.get');
        Route::post('/change-password', [AdminHomeController::class, 'submitChangePasswordForm'])->name('change.password.post');

        Route::get('users/data', [AdminUserController::class, 'anyData'])->name('users.data');
        Route::resource('users', AdminUserController::class);

        Route::get('admins/data', [AdminAdminController::class, 'anyData'])->name('admins.data');
        Route::resource('admins', AdminAdminController::class);

        Route::get('farms/data', [AdminFarmController::class, 'anyData'])->name('farms.data');
        Route::resource('farms', AdminFarmController::class);

        Route::get('device_categories/data', [AdminDeviceCategoryController::class, 'anyData'])->name('device_categories.data');
        Route::resource('device_categories', AdminDeviceCategoryController::class);

        Route::get('devices/data', [AdminDeviceController::class, 'anyData'])->name('devices.data');
        Route::get('devices/farmData/{farm_id}', [AdminDeviceController::class, 'farmData'])->name('devices.farmData');
        Route::resource('devices', AdminDeviceController::class);

        Route::get('error_types/data', [AdminErrorTypeController::class, 'anyData'])->name('error_types.data');
        Route::resource('error_types', AdminErrorTypeController::class);

        Route::get('errors', [AdminErrorController::class, 'index'])->name('errors.index');
        Route::get('errors/data', [AdminErrorController::class, 'anyData'])->name('errors.data');
        Route::get('errors/farmData/{farm_id}', [AdminErrorController::class, 'farmData'])->name('errors.farmData');
        Route::get('errors/deviceData/{device_id}', [AdminErrorController::class, 'deviceData'])->name('errors.deviceData');

        Route::get('device_logs/deviceData/{device_id}', [AdminDeviceLogController::class, 'deviceData'])->name('device_logs.deviceData');
    });
});

/**
 * User routes
 */
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/login', [UserLoginController::class, 'handleLogin'])->name('user.handleLogin');
Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');

Route::group(['middleware'=>'auth:web'], function() {
    Route::get('/', [UserHomeController::class, 'index'])->name('user.home');
    Route::get('/profile', [UserHomeController::class, 'profile'])->name('user.profile');
    Route::get('/change-password', [UserHomeController::class, 'showChangePasswordForm'])->name('user.change.password.get');
    Route::post('/change-password', [UserHomeController::class, 'submitChangePasswordForm'])->name('user.change.password.post');

    Route::get('devices/data', [UserDeviceController::class, 'anyData'])->name('devices.data');
    Route::resource('devices', UserDeviceController::class);
    Route::get('devices/getChangeStatus/{id}', [UserDeviceController::class, 'getChangeStatus'])->name('devices.getChangeStatus');
    Route::patch('devices/postChangeStatus/{id}', [UserDeviceController::class, 'postChangeStatus'])->name('devices.postChangeStatus');

    Route::get('errors/data', [UserErrorController::class, 'anyData'])->name('errors.data');
    Route::get('errors/deviceData/{device_id}', [UserErrorController::class, 'deviceData'])->name('errors.deviceData');
    Route::get('errors/farmData/{farm_id}', [UserErrorController::class, 'farmData'])->name('errors.farmData');
    Route::resource('errors', UserErrorController::class);

});
