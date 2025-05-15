<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Category</h1>
    <form method="POST" action="{{ route('categories.update', $category) }}">
        @method('PUT')
        @include('categories._form', ['submitLabel' => 'Update'])
    </form>
</x-app-layout>
