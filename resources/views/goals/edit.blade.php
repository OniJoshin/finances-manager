<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Savings Goal</h1>
    <form method="POST" action="{{ route('goals.update', $goal) }}">
        @method('PUT')
        @include('goals._form', ['goal' => $goal])
    </form>
</x-app-layout>
