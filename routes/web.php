<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BillController,
    BudgetController,
    CategoryController,
    DashboardController,
    ExpenseController,
    IncomeController,
    ProfileController,
    SavingsGoalController,
    TagController,
    RecurringIncomeController,
    RecurringExpenseController,
    RecurringIncomeLogController,
    RecurringExpenseLogController,
    BackupController
};

Route::get('/', fn () => view('welcome'));

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Core resources
    Route::resources([
        'income' => IncomeController::class,
        'recurring-incomes' => RecurringIncomeController::class,
        'expenses' => ExpenseController::class,
        'recurring-expenses' => RecurringExpenseController::class,
        'bills' => BillController::class,
        'budgets' => BudgetController::class,
        'goals' => SavingsGoalController::class,
        'categories' => CategoryController::class,
        'tags' => TagController::class,
    ], ['except' => ['show']]);

    // Recurring logs
    Route::get('recurring-income-logs', [RecurringIncomeLogController::class, 'index'])->name('recurring-income-logs.index');
    Route::get('recurring-expense-logs', [RecurringExpenseLogController::class, 'index'])->name('recurring-expense-logs.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Backup routes
Route::middleware(['auth', 'verified'])->prefix('backup')->name('backup.')->group(function () {
    Route::get('/', [BackupController::class, 'index'])->name('index');
    Route::get('/export', [BackupController::class, 'export'])->name('export');
    Route::post('/import', [BackupController::class, 'import'])->name('import');
});

require __DIR__.'/auth.php';
