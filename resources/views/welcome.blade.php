<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Finance Manager') }}</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name', 'Finance Manager') }}" />
    <link rel="manifest" href="/site.webmanifest" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-xl w-full text-center space-y-6">
            <h1 class="text-4xl font-bold text-blue-600">Finance Manager</h1>
            <p class="text-lg text-gray-600">
                Take control of your finances. Track bills, expenses, income, budgets and savings goals — all in one place.
            </p>
            <div class="flex justify-center gap-4 mt-6">
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Login</a>
                <a href="{{ route('register') }}" class="border border-blue-600 text-blue-600 px-6 py-2 rounded hover:bg-blue-50">Register</a>
            </div>

            <div class="bg-white shadow rounded-xl p-6 mt-8 space-y-4 text-left">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">What You Can Do</h2>
                <ul class="space-y-3 text-sm text-gray-700">
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-calendar class="w-5 h-5 text-blue-500 mt-1" />
                        <span><strong>Track bills & subscriptions</strong> with due dates and amounts</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-credit-card class="w-5 h-5 text-blue-500 mt-1" />
                        <span><strong>Log expenses</strong> with categories and tags</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-currency-pound class="w-5 h-5 text-blue-500 mt-1" />
                        <span><strong>Record income</strong>, both one-time and recurring</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-chart-bar class="w-5 h-5 text-blue-500 mt-1" />
                        <span><strong>Set monthly budgets</strong> by category and monitor usage</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-sparkles class="w-5 h-5 text-blue-500 mt-1" />
                        <span><strong>Create savings goals</strong> and watch your progress</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-home class="w-5 h-5 text-blue-500 mt-1" />
                        <span><strong>Dashboard overview</strong> for income, expenses, and upcoming bills</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-heroicon-o-arrow-down-tray class="w-5 h-5 text-blue-500 mt-1" />
                        <span><strong>Export & import your data</strong> with easy CSV backups</span>
                    </li>
                </ul>
            </div>
        </div>

        


    </div>

</body>
</html>
