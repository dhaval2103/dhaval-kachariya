<?php

use App\Http\Controllers\admin\auth\DashboardController;
use App\Http\Controllers\admin\auth\LoginController;
use App\Http\Controllers\Rolecontroller;
use App\Http\Controllers\user\userController;
use Illuminate\Support\Facades\Route;


Route::group(['namespace' => 'auth'], function () {
    Route::get('/', [LoginController::class, 'loginpage'])->name('logins');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
Route::group(['middleware' => 'auth:admin'], function () {

    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });
    Route::get('userdetail', [userController::class, 'showdata'])->name('userdata');
    Route::post('addeducation', [userController::class, 'addeducation'])->name('education');
    Route::post('viewdata', [userController::class, 'viewdata'])->name('vieweducation');
    Route::post('editdata', [userController::class, 'editdata'])->name('editeducation');
    Route::post('edituser', [userController::class, 'edituser'])->name('edituserdata');
    Route::post('updatedata', [userController::class, 'updatedata'])->name('updateeducation');
    Route::post('updateuser', [userController::class, 'updateuser'])->name('updateuserdata');
    Route::post('deletuser', [userController::class, 'deleteuser'])->name('deletedata');
    Route::post('deleteeducation', [userController::class, 'deleteeducation'])->name('deleteeducation');
    Route::post('activation', [userController::class, 'activation'])->name('multiplechecked');
    Route::get('userblog/{id}', [userController::class, 'userblog'])->name('userblog');

    Route::get('addrole', [Rolecontroller::class, 'addrole'])->name('addrole');
    Route::post('createrole', [Rolecontroller::class, 'createrole'])->name('createrole');
    Route::get('viewrole', [Rolecontroller::class, 'viewrole'])->name('showrole');
    Route::post('viewpermission', [Rolecontroller::class, 'viewpermission'])->name('viewpermission');
    Route::get('editrolepage/{id?}', [Rolecontroller::class, 'editrolepage'])->name('editrolepage');
    Route::post('updaterole', [Rolecontroller::class, 'updaterole'])->name('updaterole');
    Route::post('deleterole', [Rolecontroller::class, 'deleterole'])->name('deleterole');
});
