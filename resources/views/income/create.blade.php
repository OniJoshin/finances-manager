<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Income</h1>

    <form method="POST" action="{{ route('income.store') }}">
        @include('income._form', ['submitLabel' => 'Add Income'])
    </form>
</x-app-layout>
