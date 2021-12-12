<?php

use App\Http\Controllers\ListsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaysController;

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
//     return view('main');
// });

Route::get('/', [ListsController::class,'index'])->name('main');

Route::get('/dashboard', 
    [ListsController::class,'index']
);
Route::get('/regiView', 
    [SaysController::class,'regiView']
)->name('register');

Route::post('/list/{listId}', 
    [ListsController::class,'store']
)->middleware(['auth'])->name('store');

Route::get('/list/create', 
    [ListsController::class,'create']
)->middleware(['auth'])->name('create');
Route::delete('/list/delete/{id}', 
    [ListsController::class,'destroy']
)->middleware(['auth'])->name('destroy');

Route::patch('/list/update/{li}', 
    [ListsController::class,'update']
)->middleware(['auth'])->name('update');

Route::patch('/list/updateTodo/{li}', 
    [ListsController::class,'updateTodo']
)->middleware(['auth'])->name('updateTodo');

Route::get('/profile/{userName}', 
    [ListsController::class,'profile']
)->middleware(['auth'])->name('profile');
require __DIR__.'/auth.php';