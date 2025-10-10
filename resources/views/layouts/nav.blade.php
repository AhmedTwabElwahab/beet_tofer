<nav class="bg-white shadow-xl sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center justify-between h-16">

            {{-- 1. Logo / System Title --}}
            <div class="flex items-center">
                <a href="/" class="flex items-center text-slate-800 hover:text-blue-600 transition-colors" title="Beet Tofer System Dashboard">
                    {{-- Icon (Using Blue for branding) --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                    <h1 class="text-xl font-extrabold tracking-tight hidden sm:block">Beet Tofer System</h1>
                </a>
            </div>

            {{-- 2. Navigation Links (Stacked Icon + Text) --}}
            {{-- استخدام flex-wrap للسماح للروابط بالنزول لسطر جديد على الشاشات الصغيرة جدًا --}}
            <div class="flex flex-wrap items-center space-x-2 sm:space-x-4 text-xs font-medium">

                {{-- Home --}}
                <a href="/" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200" title="Home">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span class="mt-1">Home</span>
                </a>

                {{-- Cashier Input --}}
                <a href="{{ route('cashier.input.index') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-teal-600 hover:bg-teal-50 transition-colors duration-200" title="Cashier Input">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="mt-1">Cashier Input</span>
                </a>

                {{-- Import Transactions --}}
                <a href="{{ route('transaction.import.show') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition-colors duration-200" title="Import Transactions">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span class="mt-1">Import Txns</span>
                </a>

                {{-- Import Balances --}}
                <a href="{{ route('balance.import.show') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition-colors duration-200" title="Import Balances">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <span class="mt-1">Import Balances</span>
                </a>

                {{-- Manage Audits (New CRUD Link) --}}
                <a href="{{ route('balance-audits.index') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-sky-600 hover:bg-sky-50 transition-colors duration-200" title="Manage Balance Audits">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    <span class="mt-1">Manage Balances</span>
                </a>

                {{-- Export Reports --}}
                <a href="{{ route('cashier.export.show') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-purple-600 hover:bg-purple-50 transition-colors duration-200" title="General Export Reports">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6" />
                    </svg>
                    <span class="mt-1">Export Reports</span>
                </a>

                {{-- Export Entry Reports (Cash Entry) --}}
                <a href="{{ route('cashierentry.export.show') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-yellow-600 hover:bg-yellow-50 transition-colors duration-200" title="Export Cash Entry">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 2v4m0 4v2m-6 2h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="mt-1">Export Cash Entry</span>
                </a>

                {{-- Export Boxes Reports (Audits) --}}
                <a href="{{ route('cashieraudits.index') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-red-600 hover:bg-red-50 transition-colors duration-200" title="Export Boxes Audits">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m-8-4l8 4m-8-4v-2" />
                    </svg>
                    <span class="mt-1">Export Audits</span>
                </a>

                {{-- Manage Devices (Using Settings icon again for management) --}}
                <a href="{{ route('devices.index') }}" class="flex flex-col items-center p-2 rounded-lg text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200" title="Manage Devices">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.827 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.827 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.827-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.827-3.31 2.37-2.37h.001z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="mt-1">Manage Devices</span>
                </a>

            </div>
        </div>
    </div>
</nav>
