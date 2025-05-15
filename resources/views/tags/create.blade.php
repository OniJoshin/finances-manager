<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Add Tag</h1>
    <form method="POST" action="{{ route('tags.store') }}">
        @include('tags._form', ['submitLabel' => 'Add'])
    </form>
</x-app-layout>
