<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\InvoiceController;
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



Route::get('login', [UserAuthController::class, 'login'])->middleware('isAlreadyLoggedIn');
Route::post('checkCredentials', [UserAuthController::class, 'checkCredentials'])->name('checkCredentials');



Route::middleware('isLoggedIn')->group(function () {
    
    Route::get('dashboard', [UserAuthController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [UserAuthController::class, 'profile'])->name('profile');
    Route::patch('profile', [UserAuthController::class, 'update'])->name('profile.update');
    Route::get('logout', [UserAuthController::class, 'logout'])->name('logout');

    // Shipments CRUD operations
    Route::prefix('shipments')->group(function () {
        Route::get('/', [ShipmentController::class, 'index'])->name('shipments');
        Route::get('/add', [ShipmentController::class, 'add'])->name('shipments.add');
        Route::post('/add', [ShipmentController::class, 'store'])->name('shipments.store');
        Route::get('/{id}/edit', [ShipmentController::class, 'edit'])->name('shipments.edit');
        Route::patch('/{id}/edit', [ShipmentController::class, 'update'])->name('shipments.update');
        Route::patch('/{id}/complete', [ShipmentController::class, 'markAsComplete'])->name('shipments.markAsComplete');
        Route::delete('/{id}/delete', [ShipmentController::class, 'delete'])->name('shipments.delete');
    });
    
    // Products CRUD operations
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products');
        Route::get('/add', [ProductController::class, 'add'])->name('products.add');
        Route::post('/add', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::patch('/{id}/edit', [ProductController::class, 'update'])->name('products.update');
        Route::delete('{id}/delete', [ProductController::class, 'delete'])->name('products.delete');
    });
    //Reserved to admin
    Route::middleware('isAdmin')->group(function() {

        // Employees CRUD operations
        Route::prefix('employees')->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('employees');
            Route::get('/add', [EmployeeController::class, 'add'])->name('employees.add');
            Route::post('/add', [EmployeeController::class, 'store'])->name('employees.store');
            Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
            Route::patch('/{id}/edit', [EmployeeController::class, 'update'])->name('employees.update');
            Route::delete('{id}/delete', [EmployeeController::class, 'delete'])->name('employees.delete');
        });

        // Suppliers CRUD operations
        Route::prefix('suppliers')->group(function () {
            Route::get('/', [SupplierController::class, 'index'])->name('suppliers');
            Route::get('/add', [SupplierController::class, 'add'])->name('suppliers.add');
            Route::post('/add', [SupplierController::class, 'store'])->name('suppliers.store');
            Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
            Route::patch('/{id}/edit', [SupplierController::class, 'update'])->name('suppliers.update');
            Route::delete('/{id}/delete', [SupplierController::class, 'delete'])->name('suppliers.delete');
        });

        //Invoices 
        Route::prefix('invoices')->group(function () {
            Route::get('/', [InvoiceController::class, 'index'])->name('invoices');
            Route::patch('/{id}/paid', [InvoiceController::class, 'markAsPaid'])->name('invoice.markAsPaid');
            Route::get('/{id}/print', [InvoiceController::class, 'print'])->name('invoice.print');
        });
    });

});
