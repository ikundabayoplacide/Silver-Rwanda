<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegistationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cooperativeController;
use App\Http\Controllers\DeviceDataController;
use App\Http\Controllers\FarmersController;
use App\Http\Controllers\HighChartController;

Route::get('/', function () {
    return view('home.home');
})->name('home');


// User routes with middleware


    Route::get('admin/register', [AdminRegistationController::class, 'create'])->name('admin.register');
    Route::post('admin/register', [AdminRegistationController::class, 'store'])->name('admin.store');
    Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login')->middleware('clear_cookies');
    Route::post('admin/check', [AdminLoginController::class, 'admincheck'])->name('admin.check');

// Route::middleware(['auth', 'user'])->group(function () {
// Route::get('device_data', [DeviceDataController::class, 'index'])->name('device_data.index');
// Route::get('device_data/create', [DeviceDataController::class, 'create'])->name('device_data.create');
// Route::post('device_data', [DeviceDataController::class, 'store'])->name('device_data.store');
// Route::get('/device_data/{device_data}', [DeviceDataController::class, 'show'])->name('device_data.show');
// Route::put('device_data/{device_data}', [DeviceDataController::class, 'update'])->name('device_data.update');
// Route::delete('device_data/{device_data}', [DeviceDataController::class, 'destroy'])->name('device_data.destroy');
// Route::get('device_data/{device_data}/edit', [DeviceDataController::class, 'edit'])->name('device_data.edit');
// // for coopeartive
// Route::resource('cooperatives', cooperativeController::class);
// Route::get('/assign', [CooperativeController::class, 'showAssignForm'])->name('cooperatives.showAssignForm');
// Route::post('/cooperatives/assign', [CooperativeController::class, 'assignFarmerToCooperative'])->name('cooperatives.assign');
// Route::get('cooperative/assignment-details', [CooperativeController::class, 'showAssignmentDetails'])->name('cooperatives.showAssignmentDetails');
// // for farmers

// // Route::get('farmers/index', [FarmersController::class, 'index'])->name('farmers.index');
// // Route::get('farmers/create', [FarmersController::class, 'create'])->name('farmers.register');
// // Route::post('farmers', [FarmersController::class, 'store'])->name('farmers.store');
// // Route::get('/farmers/{farmers}', [FarmersController::class, 'show'])->name('farmers.show');
// // Route::put('/farmers/{farmers}', [FarmersController::class, 'update'])->name('farmers.update');
// // Route::delete('farmers/{farmers}', [FarmersController::class, 'destroy'])->name('farmers.destroy');
// // Route::get('farmers/{farmers}/edit', [FarmersController::class, 'edit'])->name('farmers.edit');


// Route::get('/testChart',[HighChartController::class,'visual']);

// });

// Admin authentication
// Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login')->middleware('clear_cookies');
// Route::post('admin/check', [AdminLoginController::class, 'admincheck'])->name('admin.check');
// Route::get('admin/register', [AdminRegistationController::class, 'create'])->name('admin.register');
// Route::post('admin/register', [AdminRegistationController::class, 'store'])->name('admin.store');

// Admin routes with middleware
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
//     Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout')->middleware('clear_cookies');
//     Route::get('/role/add', [RoleController::class, 'add'])->name('role.add');
//     Route::get('role/edit/{id}', [RoleController::class, 'edit']);
//     Route::get('role/delete/{id}', [RoleController::class, 'delete']);
//     Route::post('role/edit/{id}', [RoleController::class, 'update']);
//     Route::get('role/list', [RoleController::class, 'list'])->name('role.list');
//     Route::post('/role/add', [RoleController::class, 'store'])->name('role.store');
  
    
// // for device
// Route::get('device_data', [DeviceDataController::class, 'index'])->name('device_data.index');
// Route::get('device_data/create', [DeviceDataController::class, 'create'])->name('device_data.create');
// Route::post('device_data', [DeviceDataController::class, 'store'])->name('device_data.store');
// Route::get('/device_data/{device_data}', [DeviceDataController::class, 'show'])->name('device_data.show');
// Route::put('device_data/{device_data}', [DeviceDataController::class, 'update'])->name('device_data.update');
// Route::delete('device_data/{device_data}', [DeviceDataController::class, 'destroy'])->name('device_data.destroy');
// Route::get('device_data/{device_data}/edit', [DeviceDataController::class, 'edit'])->name('device_data.edit');
// // for charts

// Route::resource('cooperatives', cooperativeController::class);
// Route::get('/assign', [CooperativeController::class, 'showAssignForm'])->name('cooperatives.showAssignForm');
// Route::post('/cooperatives/assign', [CooperativeController::class, 'assignFarmerToCooperative'])->name('cooperatives.assign');
// Route::get('cooperative/assignment-details', [CooperativeController::class, 'showAssignmentDetails'])->name('cooperatives.showAssignmentDetails');

// Route::get('/testChart',[HighChartController::class,'visual']);

// });


  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::get('farmers/index', [FarmersController::class, 'index'])->name('farmers.index');
    Route::get('farmers/create', [FarmersController::class, 'create'])->name('farmers.register');
    Route::post('farmers', [FarmersController::class, 'store'])->name('farmers.store');
    Route::get('/farmers/{farmers}', [FarmersController::class, 'show'])->name('farmers.show');
    Route::put('/farmers/{farmers}', [FarmersController::class, 'update'])->name('farmers.update');
    Route::delete('farmers/{farmers}', [FarmersController::class, 'destroy'])->name('farmers.destroy');
    Route::get('farmers/{farmers}/edit', [FarmersController::class, 'edit'])->name('farmers.edit');
    // Route::get('/register', [UserRegistrationController::class, 'create'])->name('register');
    // Route::post('/register', [UserRegistrationController::class, 'store'])->name('store');
  
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout')->middleware('clear_cookies');
    Route::get('/role/add', [RoleController::class, 'add'])->name('role.add');
    Route::get('role/edit/{id}', [RoleController::class, 'edit']);
    Route::get('role/delete/{id}', [RoleController::class, 'delete']);
    Route::post('role/edit/{id}', [RoleController::class, 'update']);
    Route::get('role/list', [RoleController::class, 'list'])->name('role.list');
    Route::post('/role/add', [RoleController::class, 'store'])->name('role.store');
  
    
// for device
Route::get('device_data', [DeviceDataController::class, 'index'])->name('device_data.index');
Route::get('device_data/create', [DeviceDataController::class, 'create'])->name('device_data.create');
Route::post('device_data', [DeviceDataController::class, 'store'])->name('device_data.store');
Route::get('/device_data/{device_data}', [DeviceDataController::class, 'show'])->name('device_data.show');
Route::put('device_data/{device_data}', [DeviceDataController::class, 'update'])->name('device_data.update');
Route::delete('device_data/{device_data}', [DeviceDataController::class, 'destroy'])->name('device_data.destroy');
Route::get('device_data/{device_data}/edit', [DeviceDataController::class, 'edit'])->name('device_data.edit');
// for charts

Route::resource('cooperatives', cooperativeController::class);
Route::get('/assign', [CooperativeController::class, 'showAssignForm'])->name('cooperatives.showAssignForm');
Route::post('/cooperatives/assign', [CooperativeController::class, 'assignFarmerToCooperative'])->name('cooperatives.assign');
Route::get('cooperative/assignment-details', [CooperativeController::class, 'showAssignmentDetails'])->name('cooperatives.showAssignmentDetails');

Route::get('/testChart',[HighChartController::class,'visual']);

});
