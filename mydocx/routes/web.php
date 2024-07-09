<?php

use App\Http\Controllers\cooperativeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeviceDataController;
use App\Http\Controllers\FarmersController;
use App\Http\Controllers\HighchartController;
use App\Models\cooperative;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



Route::get('/', function () {
    return view('welcome');
   });


Route::view('add','AddCustomer');

Route::get('device_data', [DeviceDataController::class, 'index'])->name('device_data.index');
Route::get('device_data/create', [DeviceDataController::class, 'create'])->name('device_data.create');
Route::post('device_data', [DeviceDataController::class, 'store'])->name('device_data.store');
Route::get('/device_data/{device_data}', [DeviceDataController::class, 'show'])->name('device_data.show');
Route::put('device_data/{device_data}', [DeviceDataController::class, 'update'])->name('device_data.update');
Route::delete('device_data/{device_data}', [DeviceDataController::class, 'destroy'])->name('device_data.destroy');
Route::get('device_data/{device_data}/edit', [DeviceDataController::class, 'edit'])->name('device_data.edit');


//routes for farmers

Route::get('farmers/index', [FarmersController::class, 'index'])->name('farmers.index');
Route::get('farmers/create', [FarmersController::class, 'create'])->name('farmers.register');
Route::post('farmers', [FarmersController::class, 'store'])->name('farmers.store');
Route::get('/farmers/{farmers}', [FarmersController::class, 'show'])->name('farmers.show');
Route::put('/farmers/{farmers}', [FarmersController::class, 'update'])->name('farmers.update');
Route::delete('farmers/{farmers}', [FarmersController::class, 'destroy'])->name('farmers.destroy');
Route::get('farmers/{farmers}/edit', [FarmersController::class, 'edit'])->name('farmers.edit');


//charts

Route::get('/chart',[HighchartController::class,'visual']);

Route::get('/farmers', [FarmersController::class, 'index'])->name('farmers.index');
Route::post('/farmers/create', [FarmersController::class, 'store'])->name('farmers.store');



//Route for the cooperative

Route::resource('cooperatives', cooperativeController::class);
Route::get('/assign', [CooperativeController::class, 'showAssignForm'])->name('cooperatives.showAssignForm');
Route::post('/cooperatives/assign', [CooperativeController::class, 'assignFarmerToCooperative'])->name('cooperatives.assign');
Route::view('login','auth.login');
Route::get('cooperative/assignment-details', [CooperativeController::class, 'showAssignmentDetails'])->name('cooperatives.showAssignmentDetails');

//userController

Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/dashboard', [UserController::class, 'login'])->name('dashboard');
