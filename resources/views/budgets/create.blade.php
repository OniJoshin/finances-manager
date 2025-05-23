<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Budget</h1>
    <form method="POST" action="{{ route('budgets.store') }}">
        @include('budgets._form', ['budget' => null, 'categories' => $categories])
    </form>
</x-app-layout>
