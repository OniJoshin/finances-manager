<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Income</h1>

    <form method="POST" action="{{ route('income.update', $income) }}">
        @method('PUT')
        @include('income._form', ['submitLabel' => 'Update Income'])
    </form>
</x-app-layout>
