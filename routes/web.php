<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('home');

Route::get('/addtask', [TodoController::class, 'addtask'])->name('addtask');

Route::post('/storetask', [TodoController::class, 'storetask'])->name('storetask');

Route::get('/edit/{id}', [TodoController::class, 'edittask'])->name('edittask');

Route::put('/updatedtask/{id}', [TodoController::class, 'updatedtask'])->name('updatedtask');

Route::get('/deletetask/{id}', [TodoController::class, 'deletetask'])->name('deletetask');

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

    // for testing real email sending with Mailpit
//   Route::get('/test-gmail', function() {
//     \Illuminate\Support\Facades\Mail::raw('Test email at ' . now(), function($message) {
//         $message->to('kokyaw3482@gmail.com')
//                 ->subject('Test from Laravel')
//                 ->from('todolist@gmail.com', 'Test App');
//     });
    
//     return "Email sent (check test address).";
// });

// Login with OTP
Route::get('/loginwithotp', [AuthController::class, 'showLoginWithOTP'])->name('loginwithotp');
Route::post('/loginwithotp', [AuthController::class,'loginWithOTP'])->name('loginwithotppost');
Route::post('/verifyotp', [AuthController::class,'verifyOTP'])->name('verifyotppost');


// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// edit profile
Route::get('/editprofile/{id}', [AuthController::class, 'showEditProfile'])->name('showeditprofile');

Route::post('/updatedprofile/{id}', [AuthController::class, 'updatedprofile'])->name('updatedprofile');
