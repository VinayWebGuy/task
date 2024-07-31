<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/temp-data',[HomeController::class, 'tempData']);
Route::get('/permanent-data', [HomeController::class, 'permanentData']);



Route::post('/submit-form', [HomeController::class, 'submitForm'])->name('form.submit');
Route::post('/update-form', [HomeController::class, 'updateData'])->name('form.update');
Route::post('/delete-data/{id}', [HomeController::class, 'deleteData'])->name('delete.data');
Route::get('/edit-data/{id}', [HomeController::class, 'editData'])->name('edit.data');
Route::post('/final-submit', [HomeController::class, 'finalSubmit'])->name('final.submit');

Route::get('/download-excel', [HomeController::class, 'downloadExcel'])->name('download.excel');
Route::post('/upload-excel', [HomeController::class, 'uploadExcel'])->name('upload.excel');