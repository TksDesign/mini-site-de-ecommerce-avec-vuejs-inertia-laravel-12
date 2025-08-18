<?php

use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotpasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthenticateController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    // ----------------Register-----------------//
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // ----------------login-----------------//
    Route::get('/login', [AuthenticateController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'store']);


    // ----------------forgot password-----------------//
    Route::get('/forgot-password', [ForgotpasswordController::class, 'requestPass'])->name('password.request');

    //  validate email
    Route::post('/forgot-password', [ForgotpasswordController::class, 'sendEmail'])->name('password.email');

    // password reset form
    Route::get('/reset-password/{token}', [ForgotpasswordController::class, 'resetForm'])->name('password.reset');


    // form submition
    Route::post('/reset-password', [ForgotpasswordController::class, 'resetHandler'])->name('password.update');
});
Route::middleware('auth')->group(function () {
    // ----------------logout-----------------//
    Route::post('/logout', [AuthenticateController::class, 'destroy'])->name('logout');

    // ----------------Emailverification-----------------//

    Route::get('/email/verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'handler'])->middleware(['signed'])->name('verification.verify');

    // ----------------resending de verification email-----------------//
    Route::post('/email/verification-notification', [EmailVerificationController::class, 'resent'])->middleware(['throttle:6,1'])->name('verification.send');

    //---------confirm password ---------//
    Route::get('/confirm-password', [ConfirmPasswordController::class, 'create'])->name('password.confirm');

    Route::post('/confirm-password', [ConfirmPasswordController::class,'store'])->middleware(['throttle:6,1']);
});
