<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Expense</h1>
    <form method="POST" action="{{ route('expenses.store') }}">
        @include('expenses._form')
    </form>
</x-app-layout>