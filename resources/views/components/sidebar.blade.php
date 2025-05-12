@props(['collapsed' => false])

<aside x-data="{ collapsed: false }"
       class="bg-white shadow-lg transition-all duration-300"
       :class="{ 'w-16': collapsed, 'w-64': !collapsed }">
    <div class="p-4 border-b flex items-center justify-between">
        <h1 class="text-lg font-bold whitespace-nowrap" x-show="!collapsed">Finance Manager</h1>
    </div>
    <nav class="p-4 space-y-2 text-sm">
        @php $label = 'Dashboard'; @endphp
        <a href="{{ route('dashboard') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100 relative group"
        :title="collapsed ? '{{ $label }}' : ''">
            <x-heroicon-o-home class="w-5 h-5"/>
            <span x-show="!collapsed" class="whitespace-nowrap">{{ $label }}</span>
        </a>
        
        @php $label = 'Bills'; @endphp
        <a href="{{ route('bills.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100"
        :title="collapsed ? '{{ $label }}' : ''">
            <x-heroicon-o-calendar class="w-5 h-5"/>
            <span x-show="!collapsed" class="whitespace-nowrap">{{ $label }}</span>
        </a>

        @php $label = 'Income'; @endphp
        <a href="{{ route('income.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100"
        :title="collapsed ? '{{ $label }}' : ''">
            <x-heroicon-o-currency-pound class="w-5 h-5"/>
            <span x-show="!collapsed" class="whitespace-nowrap">{{ $label }}</span>
        

        @php $label = 'Expenses'; @endphp
        <a href="{{ route('expenses.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100"
        :title="collapsed ? '{{ $label }}' : ''">
            <x-heroicon-o-credit-card class="w-5 h-5"/>
            <span x-show="!collapsed" class="whitespace-nowrap">{{ $label }}</span>
        </a>

        @php $label = 'Goals'; @endphp
        <a href="{{ route('goals.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100"
        :title="collapsed ? '{{ $label }}' : ''">
            <x-heroicon-o-sparkles class="w-5 h-5"/>
            <span x-show="!collapsed" class="whitespace-nowrap">{{ $label }}</span>
        </a>
        @php $label = 'Tags'; @endphp
        <a href="{{ route('tags.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100"
        :title="collapsed ? '{{ $label }}' : ''">
            <x-heroicon-o-tag class="w-5 h-5"/>
            <span x-show="!collapsed" class="whitespace-nowrap">{{ $label }}</span>
        </a>
        @php $label = 'Backup'; @endphp
        <a href="{{ route('backup.index') }}"
        class="flex items-center gap-2 px-3 py-2 rounded hover:bg-gray-100"
        :title="collapsed ? '{{ $label }}' : ''">
            <x-heroicon-o-cloud class="w-5 h-5"/>
            <span x-show="!collapsed" class="whitespace-nowrap">{{ $label }}</span>
        </a>
    </nav>
</aside>
