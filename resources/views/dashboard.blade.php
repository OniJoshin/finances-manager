<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            <!-- Monthly Summary -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Monthly Summary</h2>
                <p class="text-sm text-gray-500">Income vs Expenses</p>
                <!-- Placeholder chart or values -->
                <div class="h-24 bg-gray-100 rounded mt-2 flex items-center justify-center text-gray-400">
                    Chart Placeholder
                </div>
            </div>

            <!-- Upcoming Bills -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Upcoming Bills</h2>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li>- Rent (Due 1st)</li>
                    <li>- Netflix (Due 5th)</li>
                    <li class="text-gray-400">More...</li>
                </ul>
            </div>

            <!-- Income Overview -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Income Overview</h2>
                <p class="text-sm text-gray-500">This Month</p>
                <div class="mt-2 text-green-600 font-bold text-xl">£2,300</div>
            </div>

            <!-- Expenses Overview -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Expenses Breakdown</h2>
                <div class="h-24 bg-gray-100 rounded mt-2 flex items-center justify-center text-gray-400">
                    Category Pie Chart Placeholder
                </div>
            </div>

            <!-- Financial Goals -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Financial Goals</h2>
                <p class="text-sm text-gray-500">Progress</p>
                <div class="mt-2 space-y-2">
                    <div class="bg-gray-100 p-2 rounded">
                        <span class="block text-sm">Holiday Fund</span>
                        <div class="w-full bg-gray-200 h-2 rounded-full">
                            <div class="bg-blue-500 h-2 rounded-full w-2/3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tags & Categories -->
            <div class="bg-white p-4 rounded-xl shadow">
                <h2 class="text-lg font-semibold mb-2">Tags & Categories</h2>
                <p class="text-sm text-gray-500">Manage and apply to expenses</p>
                <div class="flex flex-wrap gap-2 mt-2 text-sm">
                    <span class="bg-gray-200 rounded px-2 py-1">Food</span>
                    <span class="bg-gray-200 rounded px-2 py-1">Fuel</span>
                    <span class="bg-gray-200 rounded px-2 py-1">Subscriptions</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
