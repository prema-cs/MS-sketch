<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return redirect('customers/');
});
Route::get('customers/import', [CustomerController::class, 'showImportForm'])->name('customers.import.form');
Route::post('customers/import', [CustomerController::class, 'import'])->name('customers.import');
Route::get('customers/download/template', [CustomerController::class, 'downloadImportCustomerTemplate'])->name('customers.download.template');
Route::get('customers/export', [CustomerController::class, 'export'])->name('customers.export');
Route::resource('customers', CustomerController::class);