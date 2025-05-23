<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Savings Goal</h1>
    <form method="POST" action="{{ route('goals.store') }}">
        @include('goals._form', ['goal' => null])
    </form>
</x-app-layout>
