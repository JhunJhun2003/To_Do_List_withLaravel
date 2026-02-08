<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
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

Route::get('/complete', [TodoController::class, 'complete'])->name('complete');

Route::get('/pending', [TodoController::class, 'pending'])->name('pending');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('registerpost');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginpost');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//edit profile
Route::get('/editprofile/{id}', [AuthController::class, 'showEditProfile'])->name('showeditprofile');

Route::post('/updatedprofile/{id}', [AuthController::class, 'updatedprofile'])->name('updatedprofile');