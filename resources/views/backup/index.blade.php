<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Backup & Restore</h1>

    @if (session('success'))
        <div class="text-green-600 mb-4">{{ session('success') }}</div>
    @endif

    <div class="space-y-6">

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="font-semibold mb-2">Export Data</h2>
            <p class="text-sm text-gray-600 mb-2">Download your full financial data as a CSV file.</p>
            <a href="{{ route('backup.export') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Download CSV</a>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="font-semibold mb-2">Import Data</h2>
            <p class="text-sm text-gray-600 mb-2">Upload a CSV file of your expenses or incomes.</p>
            <form method="POST" action="{{ route('backup.import') }}" enctype="multipart/form-data" class="space-y-2">
                @csrf
                <input type="file" name="excel" accept=".xlsx,.xls" required class="block border p-2 rounded w-full">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Import Excel File</button>
            </form>


        </div>

    </div>
</x-app-layout>
