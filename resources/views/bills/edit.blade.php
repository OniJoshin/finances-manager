<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Edit Bill</h1>
    <form method="POST" action="{{ route('bills.update', $bill) }}">
        @method('PUT')
        @include('bills._form', ['tags' => $tags])
    </form>
</x-app-layout>