<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecurringIncomeController;
use App\Http\Controllers\RecurringExpenseController;
use App\Http\Controllers\RecurringIncomeLogController;
use App\Http\Controllers\RecurringExpenseLogController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::view('/bills', 'bills.index')->name('bills.index');
    Route::view('/expenses', 'expenses.index')->name('expenses.index');
    Route::view('/goals', 'goals.index')->name('goals.index');
    Route::view('/backup', 'backup.index')->name('backup.index');

    Route::resource('income', IncomeController::class)->except(['show']);
    Route::resource('recurring-incomes', RecurringIncomeController::class)->except('show');
    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('tags', TagController::class)->except('show');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('recurring-income-logs', [RecurringIncomeLogController::class, 'index'])
        ->name('recurring-income-logs.index');

    Route::resource('expenses', ExpenseController::class)->except('show');
    Route::resource('recurring-expenses', RecurringExpenseController::class)->except('show');
    Route::get('recurring-expense-logs', [RecurringExpenseLogController::class, 'index'])
        ->name('recurring-expense-logs.index');





});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
