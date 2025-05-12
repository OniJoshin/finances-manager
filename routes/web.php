<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('/bills', 'bills.index')->name('bills.index');
    Route::view('/income', 'income.index')->name('income.index');
    Route::view('/expenses', 'expenses.index')->name('expenses.index');
    Route::view('/goals', 'goals.index')->name('goals.index');
    Route::view('/tags', 'tags.index')->name('tags.index');
    Route::view('/backup', 'backup.index')->name('backup.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
