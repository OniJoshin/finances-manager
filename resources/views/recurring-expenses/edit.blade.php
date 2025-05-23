<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Recurring Expense</h1>
    <form method="POST" action="{{ route('recurring-expenses.update', $recurringExpense) }}">
        @method('PUT')
        @include('recurring-expenses._form')
    </form>
</x-app-layout>
