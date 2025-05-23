<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Budget</h1>
    <form method="POST" action="{{ route('budgets.update', $budget) }}">
        @method('PUT')
        @include('budgets._form', ['budget' => $budget, 'categories' => $categories])
    </form>
</x-app-layout>
