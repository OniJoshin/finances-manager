<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Expense</h1>
    <form method="POST" action="{{ route('expenses.update', $expense) }}">
        @method('PUT')
        @include('expenses._form')
    </form>
</x-app-layout>
