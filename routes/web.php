<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [TodoController::class,'index']);

Route::post('/add', [TodoController::class,'add']);

Route::post('/update/{id}', [TodoController::class,'update']);

Route::get('delete/{id}',[TodoController::class,'delete']);

Route::get('/changeStatus', [TodoController::class, 'changeStatus'])->name('changeStatus');
