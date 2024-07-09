<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginAuthController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentFolderController;
use App\Http\Controllers\DriveAccountController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\LogController;
use App\Http\Middleware\NoCacheMiddleware;

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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
});


//login
Route::get('/login',[LoginAuthController::class,'getLogin'])->name('getLogin')->middleware([NoCacheMiddleware::class]);
Route::post('/login',[LoginAuthController::class,'postLogin'])->name('postLogin');
Route::get('/update-pass', [EmployeeController::class, 'updateEmployeePasswords']);
Route::group(['middleware'=>['login_auth', NoCacheMiddleware::class]],function(){
    
    Route::get('/dashboard',[MasterController::class,'dashboard'])->name('dashboard');

    //Drive
    Route::get('/drive',[MasterController::class,'drive'])->name('drive');
    Route::get('/account',[DriveAccountController::class,'driveAccount'])->name('drive-account');
    Route::get('/account/create',[DriveAccountController::class,'createAccount'])->name('create-account');  
    Route::get('/account/edit/{id}',[DriveAccountController::class,'editAccount'])->name('edit-account'); 
    Route::get('/drive/{id}', [DocumentFolderController::class, 'subFolder'])->name('sub-folder');

    Route::post('/drive/create-folder', [DocumentFolderController::class, 'createFolder'])->name('create-folder');
    Route::post('/drive/update-folder', [DocumentFolderController::class, 'updateFolder'])->name('update-folder');
    
    Route::post('/drive/create-subfolder/{id}', [DocumentFolderController::class, 'createSubFolder'])->name('create-subfolder');
    Route::get('/delete-folder/{id}', [DocumentFolderController::class, 'deleteFolder'])->name('delete-folder');



    Route::get('/logs',[LogController::class,'logs'])->name('logs');
    
    //UploaFile
    Route::post('/upload/{id}', [DocumentController::class, 'storeFile'])->name('document-store');
    Route::post('/update-file', [DocumentController::class, 'updateFile'])->name('document-update');
    Route::get('/delete-file/{id}', [DocumentController::class, 'deleteFile'])->name('delete-file');

    //User
    Route::get('/users/ulist',[MasterController::class,'user'])->name('ulist');
    Route::post('/users/uCreate',[UserController::class,'uCreate'])->name('uCreate');
    Route::get('/users/uEdit/{id}',[UserController::class,'uEdit'])->name('uEdit');
    Route::post('/users/uUpdate',[UserController::class,'uUpdate'])->name('uUpdate');
    Route::get('/users/uDelete/{id}',[UserController::class,'uDelete'])->name('uDelete');
    
    //Employee
    Route::get('/emp',[EmployeeController::class,'emp_list'])->name('emp_list');
    Route::post('/empCreate',[EmployeeController::class,'empCreate'])->name('empCreate');
    Route::get('/empEdit/{id}',[EmployeeController::class,'empEdit'])->name('empEdit');
    Route::post('/empUpdate',[EmployeeController::class,'empUpdate'])->name('empUpdate');
    Route::get('/empEditRate/{id}',[EmployeeController::class,'empEditRate'])->name('empEditRate');
    Route::get('/empDelete/{id}',[EmployeeController::class,'empDelete'])->name('empDelete');
    Route::post('/empPartimeRate',[EmployeeController::class,'empPartimeRate'])->name('empPartimeRate');

    Route::post('/modify/show', [ModifyController::class, 'modifyShow'])->name('modifyShow');
    Route::post('/modify/update', [ModifyController::class, 'modifyUpdate'])->name('modifyUpdate');

    //Office
    Route::get('/office',[OfficeController::class,'officeList'])->name('officeList');
    Route::post('/office/officeCreate', [OfficeController::class, 'officeCreate'])->name('officeCreate');
    Route::get('/office/officeEdit/{id}',[OfficeController::class,'officeEdit'])->name('officeEdit');
    Route::post('/office/officeUpdate',[OfficeController::class,'officeUpdate'])->name('officeUpdate');
    Route::get('/office/officeDelete{id}',[OfficeController::class,'officeDelete'])->name('officeDelete');

    //logout 
    Route::get('/logout',[MasterController::class,'logout'])->name('logout');
    
});


