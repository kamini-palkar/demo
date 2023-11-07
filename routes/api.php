<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\controllers\PassportController;

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PDFController;



// use App\Http\Controllers\PassportController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 

Route::get('/send-mail', [MailController::class, 'index'])->name('send-mail');
Route::post('/User_Mail', [App\Http\Controllers\MailController::class, 'UserMail'])->name('User_Mail');
// Route::post('/create', PermissionsController::class,'store');



     

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
//  });


//  Route::post('/login', [PassportController::class,'login']);
//  Route::post('/register', [PassportController::class,'register']);
//  Route::group(['middleware' => 'auth:api'], function(){
// });

    Route::post('register', [PassportController::class, 'register']);
Route::post('login', [PassportController::class, 'login']);
     
Route::prefix('api')->middleware('auth:sanctum')->group( function () {
    Route::resource('products', ProductController::class);
   
   
});
Route::get('/fetch-data/{unique_id}', [PDFController::class, 'getData']);







Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('product',ProductController::class);
    Route::post('delete-product', [ProductController::class,'destroy']);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('delete-User', [UserController::class,'destroy']);
    Route::post('edit', [UserController::class,'update']);
    Route::post('delete-role', [RoleController::class,'destroy']);
    Route::resource('products', ProductController::class);
    Route::resource('permissions', PermissionsController::class);

    Route::post('product-import',[ProductController::class, 'import'])->name('product.import');
    Route::get('marksheet',[App\Http\Controllers\HomeController::class, 'marksheet'])->name('marksheet');
    Route::get('mail',[App\Http\Controllers\HomeController::class, 'mail'])->name('mail');

    Route::get('/upload-excel', [App\Http\Controllers\PDFController::class, 'uploadExcel'])->name('upload-excel-form');
    Route::post('/upload-excel', [App\Http\Controllers\PDFController::class, 'uploadExcel'])->name('upload-excel');
    

    Route::get('/ANU_DANAMICDATA', [App\Http\Controllers\ANUController::class,'index'])->name('ANU_DANAMICDATA');

    // Route::get('/send-mail', [MailController::class, 'index'])->name('send-mail');
    // Route::post('/User_Mail', [App\Http\Controllers\MailController::class, 'UserMail'])->name('User_Mail');


});

