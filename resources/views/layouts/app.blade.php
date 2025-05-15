<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name', 'Finance Manager') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="bg-gray-100 font-sans antialiased">
    <div x-data="{ collapsed: false }" class="min-h-screen flex">

        <!-- Sidebar Wrapper (Fixed Width + Collapsible) -->
        <div
            class="fixed top-0 left-0 h-screen bg-white shadow-lg transition-all duration-300 z-30"
            :class="{ 'w-20': collapsed, 'w-64': !collapsed }"
        >
            <x-sidebar collapsed="@{{ '{{ collapsed.toString() }}' }}" />
        </div>

        <!-- Main Content Wrapper (Offset by Sidebar Width) -->
        <!-- Main Content Wrapper -->
<div
    class="flex-1 flex flex-col min-h-screen transition-all duration-300"
    :style="collapsed ? 'padding-left: 5rem' : 'padding-left: 16rem'"
>
    <!-- Header -->
    <header class="bg-white shadow px-4 py-3 flex items-center justify-between">
        <button @click="collapsed = !collapsed" class="text-gray-600 hover:text-gray-800">
            <x-heroicon-o-bars-3 class="w-6 h-6" />
        </button>
        <h2 class="font-semibold text-lg">Finance Manager</h2>
    </header>

    <!-- Page Content -->
    <main class="flex-1 p-4">
        {{ $slot }}
    </main>
</div>

    </div>
</body>

</html>
