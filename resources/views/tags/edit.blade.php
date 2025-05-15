<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Tag</h1>
    <form method="POST" action="{{ route('tags.update', $tag) }}">
        @method('PUT')
        @include('tags._form', ['submitLabel' => 'Update'])
    </form>
</x-app-layout>
