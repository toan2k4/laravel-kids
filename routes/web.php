<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
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

Route::get('/', function () {
    return view('welcome');
});

$cruds = [
    'customers' => CustomerController::class,
    'suppliers' => SupplierController::class,
    'products' => ProductController::class,
    'orders' => OrderController::class,
];

foreach ($cruds as $obj => $controller) {
    Route::resource($obj, $controller);
}
