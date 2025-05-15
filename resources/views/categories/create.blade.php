<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Category</h1>
    <form method="POST" action="{{ route('categories.store') }}">
        @include('categories._form', ['submitLabel' => 'Add'])
    </form>
</x-app-layout>
