<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('product',ProductController::class);

// Route::controller(App\Http\Controllers\ProductController::class)->group(function(){
    
//     Route::get('export/excel', 'exportExcelFile')->name('export.excel');
// });

// Route::get('/export-users',[App\Http\Controllers\ProductController::class,'export'])->name('export-users');

Route::get('/export-product',[App\Http\Controllers\ProductController::class,'export'])->name('export-product');

Route::get('/exportpdf', [App\Http\Controllers\ProductController::class,'generatePDF'])->name('exportpdf');
Route::get('/viewpdf', [App\Http\Controllers\ProductController::class,'viewPDF'])->name('viewpdf');
