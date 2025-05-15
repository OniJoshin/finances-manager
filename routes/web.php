<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('/bills', 'bills.index')->name('bills.index');
    Route::view('/expenses', 'expenses.index')->name('expenses.index');
    Route::view('/goals', 'goals.index')->name('goals.index');
    Route::view('/backup', 'backup.index')->name('backup.index');

    Route::resource('income', \App\Http\Controllers\IncomeController::class)->except(['show']);
    Route::resource('recurring-incomes', \App\Http\Controllers\RecurringIncomeController::class)->except('show');
    Route::resource('categories', \App\Http\Controllers\CategoryController::class)->except('show');
    Route::resource('tags', \App\Http\Controllers\TagController::class)->except('show');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');




});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
