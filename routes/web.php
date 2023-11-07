<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;

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

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    



Route::get('/export-product',[App\Http\Controllers\ProductController::class,'export'])->name('export-product');

Route::get('/exportpdf', [App\Http\Controllers\ProductController::class,'generatePDF'])->name('exportpdf');
Route::get('/viewpdf', [App\Http\Controllers\ProductController::class,'viewPDF'])->name('viewpdf');
Route::get('/exportcsv', [App\Http\Controllers\ProductController::class,'exportCSVFile'])->name('exportcsv');

Route::get('/exporttcpdf', [App\Http\Controllers\UserController::class,'exporttcpdf'])->name('exporttcpdf');


Route::get('/generatetcpdf', [App\Http\Controllers\UserController::class,'generatetcpdf'])->name('generatetcpdf');
Route::get('/newtcpdf', [App\Http\Controllers\PDFController::class,'index'])->name('newtcpdf');
Route::get('/SDMUniversityTCPDF', [App\Http\Controllers\SDMUniversityController::class,'index'])->name('SDMUniversityTCPDF');

Route::controller(ImageController::class)->group(function(){
    Route::get('/image-upload', 'index')->name('image.form');
    Route::post('/upload-image', 'storeImage')->name('image.store');
});




Route::get('/image', [EmployeeController::class, 'index']);
Route::any('/store', [EmployeeController::class, 'store'])->name('store');
Route::get('/fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/delete', [EmployeeController::class, 'delete'])->name('delete');
Route::get('/edit', [EmployeeController::class, 'edit'])->name('edit');
Route::any('/update', [EmployeeController::class, 'update'])->name('update');



// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('product',ProductController::class);
//     Route::post('delete-product', [ProductController::class,'destroy']);
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
//     Route::post('delete-User', [UserController::class,'destroy']);
//     Route::post('edit', [UserController::class,'update']);
//     Route::post('delete-role', [RoleController::class,'destroy']);
//     Route::resource('products', ProductController::class);
//     Route::resource('permissions', PermissionsController::class);

//     Route::post('product-import',[ProductController::class, 'import'])->name('product.import');
//     Route::get('marksheet',[App\Http\Controllers\HomeController::class, 'marksheet'])->name('marksheet');
//     Route::get('mail',[App\Http\Controllers\HomeController::class, 'mail'])->name('mail');

//     Route::get('/upload-excel', [App\Http\Controllers\PDFController::class, 'uploadExcel'])->name('upload-excel-form');
//     Route::post('/upload-excel', [App\Http\Controllers\PDFController::class, 'uploadExcel'])->name('upload-excel');


//     Route::get('/ANU_DANAMICDATA', [App\Http\Controllers\ANUController::class,'index'])->name('ANU_DANAMICDATA');

//     // Route::get('/send-mail', [MailController::class, 'index'])->name('send-mail');
//     // Route::post('/User_Mail', [App\Http\Controllers\MailController::class, 'UserMail'])->name('User_Mail');


// });





// Route::get('qr-code-g', function () {
  
//     \QrCode::sizeof(500)
//             ->format('png')
//             ->generate('ItSolutionStuff.com', public_path('images/qrcode.png'));
    
//   return view('qrCode');
    
// });


