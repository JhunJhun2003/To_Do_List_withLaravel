<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('home');

Route::get('/addtask', [TodoController::class, 'addtask'])->name('addtask');

Route::post('/storetask', [TodoController::class, 'storetask'])->name('storetask');

Route::get('/taskdetail', [TodoController::class, 'taskdetail'])->name('taskdetail');
