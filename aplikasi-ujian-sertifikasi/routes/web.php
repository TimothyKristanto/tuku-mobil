<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routing seputar order customer
Route::get('/', [OrderController::class, 'index']);
Route::get('/addOrder/{customerId}', [OrderController::class, 'addOrderView']);
Route::post('/addOrder/{customerId}', [OrderController::class, 'addOrder']);
Route::delete('/deleteOrder/{pivotId}/{customerId}', [OrderController::class, 'deleteOrder']);
Route::get('/updateOrder/{vehicleId}/{customerId}/{pivotId}', [OrderController::class, 'updateOrderView']);
Route::put('/updateOrder/{pivotId}/{customerId}', [OrderController::class, 'updateOrder']);

// Routing seputar customer
Route::get('/customer', [CustomerController::class, 'index']);
Route::get('/addCustomer', [CustomerController::class, 'addCustomerView']);
Route::post('/addCustomer', [CustomerController::class, 'addCustomer']);
Route::delete('/deleteCustomer/{customerId}', [CustomerController::class, 'deleteCustomer']);
Route::get('/updateCustomer/{customerId}', [CustomerController::class, 'updateCustomerView']);
Route::put('/updateCustomer/{customerId}', [CustomerController::class, 'updateCustomer']);
Route::get('/showCustomerDetails/{customerId}', [CustomerController::class, 'showCustomerDetails']);

// Routing seputar vehicle
Route::get('/vehicle', [VehicleController::class, 'index']);
Route::get('/addVehicle', [VehicleController::class, 'addVehicleView']);
Route::post('/addVehicle', [VehicleController::class, 'addVehicle']);
Route::delete('/deleteVehicle/{vehicleId}', [VehicleController::class, 'deleteVehicle']);
Route::get('/updateVehicle/{vehicleId}', [VehicleController::class, 'updateVehicleView']);
Route::put('/updateVehicle/{vehicleId}', [VehicleController::class, 'updateVehicle']);
Route::get('/showVehicleDetails/{vehicleId}', [VehicleController::class, 'showVehicleDetails']);
