<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\mainController;

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



// login & logout
Route::post('/login', [mainController::class, 'login']);
Route::post('/logout', [mainController::class, 'logout']) -> middleware(['Authorized']);


// books
Route::get('/books', [mainController::class, 'getBooks']) -> middleware(['Authorized']);
Route::post('/books', [mainController::class, 'createBook']) -> middleware(['Authorized']);
Route::get('/books/{id}', [mainController::class, 'getBookInfo']) -> middleware(['Authorized']);
Route::put('/books/{id}', [mainController::class, 'updateBookInfo']) -> middleware(['Authorized']);
Route::delete('/books/{id}', [mainController::class, 'deleteBook']) -> middleware(['Authorized']);


// customers
Route::get('/customers', [mainController::class, 'getCustomers']) -> middleware(['Authorized']);
Route::post('/customers', [mainController::class, 'createCustomer']) -> middleware(['Authorized']);
Route::get('/customers/{id}', [mainController::class, 'getCustomerInfo']) -> middleware(['Authorized']);
Route::put('/customers/{id}', [mainController::class, 'updateCustomerInfo']) -> middleware(['Authorized']);
Route::delete('/customers/{id}', [mainController::class, 'deleteCustomer']) -> middleware(['Authorized']);


// orders
Route::get('/orders', [mainController::class, 'getOrders']) -> middleware(['Authorized']);
Route::post('/orders', [mainController::class, 'createOrder']) -> middleware(['Authorized']);
Route::get('/orders/{id}', [mainController::class, 'getOrderInfo']) -> middleware(['Authorized']);
Route::put('/orders/{id}', [mainController::class, 'updateOrderInfo']) -> middleware(['Authorized']);
Route::delete('/orders/{id}', [mainController::class, 'deleteOrder']) -> middleware(['Authorized']);