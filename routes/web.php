<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('home');

Route::get('/addtask', [TodoController::class, 'addtask'])->name('addtask');

Route::post('/storetask', [TodoController::class, 'storetask'])->name('storetask');

Route::get('/edit/{id}', [TodoController::class,'edittask'])->name('edittask');

Route::put('/updatedtask/{id}', [TodoController::class,'updatedtask'])->name('updatedtask');

Route::get('/deletetask/{id}', [TodoController::class,'deletetask'])->name('deletetask');

Route::get('/taskdetail', [TodoController::class, 'taskdetail'])->name('taskdetail');

Route::patch('/todos/{todo}/toggle', [TodoController::class, 'toggle'])->name('toggle');

Route::any('/searchtitle', [TodoController::class, 'searchtitle'])->name('searchtitle');

