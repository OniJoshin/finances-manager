<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Recurring Income</h1>
    <form method="POST" action="{{ route('recurring-incomes.update', $recurringIncome) }}">
        @method('PUT')
        @include('recurring-incomes._form')
    </form>
</x-app-layout>
