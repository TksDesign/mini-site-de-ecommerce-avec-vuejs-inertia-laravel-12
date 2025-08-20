<?php

use App\Http\Controllers\DahboardController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ->middleware('verified')
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DahboardController::class,'index'])->middleware([ 'verified'])->name('dashboard');
    Route::get('/profile',[ProfileController::class,'edit'] )->middleware(['password.confirm'])->name('profile.edit');
    // route pour modifier les information dans la base de donnee
    Route::patch('/profile',[ProfileController::class,'updateInfo'])->name('profile.info');
    // pour pouvoir modifier le password
    Route::put('/profile',[ProfileController::class,'updatePassword'])
    ->name('profile.password');
    // pour supprimer un utilisateur
    Route::delete('/profile',[ProfileController::class,'destroy'])
    ->name('profile.destroy');
});


Route::get('/', [ListingController::class,'index'])->name('home');
Route::resource('listing',ListingController::class);


require __DIR__ . '/auth.php';
