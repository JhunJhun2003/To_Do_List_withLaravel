<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

// Password reset
Route::get('/passwordrequest', [AuthController::class, 'showPasswordRequest'])->name('passwordrequest');
Route::post('/passwordrequest', [AuthController::class, 'sendPasswordResetLink'])->name('passwordrequestpost');
Route::get('/passwordreset/{token}', [AuthController::class, 'showPasswordReset'])->name('passwordreset');
Route::post('/passwordreset', [AuthController::class, 'resetPassword'])->name('passwordresetpost');


Route::get('/test-email', function() {
    try {
        Mail::raw('Test email content', function($message) {
            $message->to('test@example.com')
                    ->subject('Test Email')
                    ->from('noreply@noretodolist.asia', 'Test App');
        });
        return 'Email sent successfully! Check Mailpit at http://localhost:8025';
    } catch (\Exception $e) {
        return 'Email failed: ' . $e->getMessage();
    }
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//edit profile
Route::get('/editprofile/{id}', [AuthController::class, 'showEditProfile'])->name('showeditprofile');

Route::post('/updatedprofile/{id}', [AuthController::class, 'updatedprofile'])->name('updatedprofile');