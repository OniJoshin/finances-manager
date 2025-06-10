<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Backup & Restore</h1>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-800 px-4 py-3 flex items-center" role="alert">
            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="space-y-6">

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="font-semibold mb-2">Export Data</h2>
            <p class="text-sm text-gray-600 mb-2">Download your full financial data as an Excel file.</p>
            <a href="{{ route('backup.export') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Download Backup</a>
        </div>

        <div class="bg-white p-4 rounded-xl shadow">
            <h2 class="font-semibold mb-2">Import Data</h2>
            <p class="text-sm text-gray-600 mb-2">Upload your Excel file of your previous backup or changes.</p>
            <form method="POST" action="{{ route('backup.import') }}" enctype="multipart/form-data" class="space-y-2">
                @csrf
                <input type="file" name="excel" accept=".xlsx,.xls" required class="block border p-2 rounded w-full">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Import Backup / Changes</button>
            </form>
        </div>
    </div>
</x-app-layout>
