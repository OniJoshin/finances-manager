<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Recurring Expense</h1>
    <form method="POST" action="{{ route('recurring-expenses.store') }}">
        @include('recurring-expenses._form')
    </form>
</x-app-layout>
