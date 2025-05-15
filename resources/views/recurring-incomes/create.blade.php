<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Recurring Income</h1>
    <form method="POST" action="{{ route('recurring-incomes.store') }}">
        @include('recurring-incomes._form')
    </form>
</x-app-layout>
