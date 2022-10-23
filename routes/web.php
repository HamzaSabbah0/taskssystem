<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Mail\WelcomeEmail;
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

Route::prefix('cms')->middleware('guest:admin')->group(function(){

    // Route::view('login','cms.login')->name('login');
    Route::get('{guard}/login',[AuthController::class,'showLogin'])->name('login');
    Route::post('/login',[AuthController::class,'login']);

});

Route::prefix('cms/admin')->middleware('auth:admin')->group(function(){

    Route::resource('admins',AdminController::class);
    Route::resource('users',UserController::class);


    Route::resource('roles',RoleController::class);
    Route::resource('premissions',PermissionController::class);
    Route::resource('roles.permissions',RolePermissionController::class);

    Route::resource('cities',CityController::class);
});

Route::prefix('cms/admin')->middleware('auth:admin,user')->group(function(){

    Route::view('/', 'cms.starter');
    Route::resource('categories',CategoryController::class);

    Route::get('edit-password',[AuthController::class,'editPassword'])->name('edit-password');
    Route::put('update-password',[AuthController::class,'updatePassword']);

    Route::get('edit-profile',[AuthController::class,'editProfile'])->name('edit-profile');
    Route::put('update-profile',[AuthController::class,'updateProfile']);

    Route::get('logout',[AuthController::class,'logout'])->name('logout');

});

// Route::get('test-mail',function(){
//     return new WelcomeEmail();
// });
