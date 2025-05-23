@props(['collapsed' => false])

<aside class="h-full overflow-y-auto">
    <nav class="p-4 space-y-2 text-sm">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Dashboard' : ''">
            <x-heroicon-o-home class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Dashboard</span>
        </a>
        <!-- Repeat for other nav links -->
        <a href="{{ route('bills.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('bills.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Bills' : ''">
            <x-heroicon-o-calendar class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Bills</span>
        </a>
        <a href="{{ route('income.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('income.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Income' : ''">
            <x-heroicon-o-currency-pound class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Income</span>
        </a>
        <a href="{{ route('recurring-incomes.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('recurring-incomes.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Recurring Incomes' : ''">
            <x-heroicon-o-arrow-path class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Recurring Incomes</span>
        </a>
        <a href="{{ route('expenses.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('expenses.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Expenses' : ''">
            <x-heroicon-o-credit-card class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Expenses</span>
        </a>
        <!-- Recurring Expenses -->
        <a href="{{ route('recurring-expenses.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('recurring-expenses.*') ? 'bg-gray-200 font-semibold' : '' }}"
        :title="collapsed ? 'Recurring Expenses' : ''">
            <x-heroicon-o-arrow-path-rounded-square class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Recurring Expenses</span>
        </a>
        <a href="{{ route('recurring-income-logs.index') }}"
            class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('recurring-income-logs.*') ? 'bg-gray-200 font-semibold' : '' }}"
            :title="collapsed ? 'Recurring Logs' : ''">
                <x-heroicon-o-clipboard-document class="w-5 h-5 flex-shrink-0" />
                <span x-show="!collapsed">Income Logs</span>
        </a>
        <!-- Recurring Expense Logs -->
        <a href="{{ route('recurring-expense-logs.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('recurring-expense-logs.*') ? 'bg-gray-200 font-semibold' : '' }}"
        :title="collapsed ? 'Expense Logs' : ''">
            <x-heroicon-o-clipboard-document-check class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Expense Logs</span>
        </a>

        <a href="{{ route('budgets.index') }}"
            class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('budgets.*') ? 'bg-gray-200 font-semibold' : '' }}"
            :title="collapsed ? 'Budgets' : ''">
                <x-heroicon-o-wallet class="w-5 h-5 flex-shrink-0" />
                <span x-show="!collapsed">Budgets</span>
        </a>

        <a href="{{ route('goals.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('goals.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Goals' : ''">
            <x-heroicon-o-sparkles class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Goals</span>
        </a>
        <a href="{{ route('categories.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('categories.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Categories' : ''">
            <x-heroicon-o-folder class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Categories</span>
        </a>
        <a href="{{ route('tags.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('tags.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Tags' : ''">
            <x-heroicon-o-tag class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Tags</span>
        </a>
        <a href="{{ route('backup.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('backup.*') ? 'bg-gray-200 font-semibold' : '' }}"
           :title="collapsed ? 'Backup' : ''">
            <x-heroicon-o-cloud class="w-5 h-5 flex-shrink-0" />
            <span x-show="!collapsed">Backup</span>
        </a>
    </nav>
</aside>