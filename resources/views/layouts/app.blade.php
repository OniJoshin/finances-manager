<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Finance Manager') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div x-data="{ collapsed: false, mobileOpen: false }" class="min-h-screen flex">

        <!-- Backdrop -->
        <div x-show="mobileOpen" @click="mobileOpen = false"
        class="fixed inset-0 bg-black bg-opacity-30 z-20 md:hidden"></div>
        
        <!-- Sidebar Wrapper -->
        <div
            class="md:relative fixed top-0 left-0 h-full z-30 transform transition-transform duration-300"
            :class="{ '-translate-x-full md:translate-x-0': !mobileOpen, 'translate-x-0': mobileOpen }"
        >
            <x-sidebar />
        </div>


        </div>


        <!-- Main Content -->
        <main class="flex-1">
            <!-- Topbar -->
            <header class="bg-white shadow p-4 flex justify-between items-center md:hidden">
                <button @click="mobileOpen = !mobileOpen" class="text-gray-600 hover:text-gray-900">
                    <x-heroicon-o-bars-3 class="w-6 h-6"/>
                </button>
                <span class="font-semibold">Finance Manager</span>
            </header>
            


            <div class="p-4">
                {{ $slot }}
            </div>
        </main>

    </div>
</body>
</html>
