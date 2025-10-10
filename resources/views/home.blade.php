@extends('layouts.app')

@section('title', 'System Dashboard')

@section('content')
    {{-- Main Container and Background --}}
    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Main Title --}}
            <h1 class="text-4xl font-extrabold text-center mb-12 text-slate-800 border-b-2 border-blue-300 pb-2">
                Beet Tofer System Dashboard
            </h1>

            {{-- Feature List Data (Same as before, just for reference) --}}
            @php
                $features = [
                    [
                        'title' => 'Cashier Data Entry',
                        'description' => 'Manually enter cashier sales and financial inputs.',
                        'route' => route('cashier.input.index'),
                        'color' => 'teal',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>',
                    ],
                    [
                        'title' => 'Import Transactions',
                        'description' => 'Upload Excel files to import core transaction data.',
                        'route' => route('transaction.import.show'),
                        'color' => 'indigo',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>',
                    ],
                    [
                        'title' => 'Manage Devices',
                        'description' => 'Add, edit, and remove device numbers linked to branches.',
                        'route' => route('devices.index'),
                        'color' => 'blue',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1v-3.25m-7.25-6.75h10.5a1 1 0 011 1v7a1 1 0 01-1 1H8.5a1 1 0 01-1-1v-7a1 1 0 011-1zm0 0l.25-1.5a2 2 0 012-2h6.5a2 2 0 012 2l.25 1.5M4.5 17h15" /></svg>',
                    ],
                    [
                        'title' => 'Export Reports (General)',
                        'description' => 'Generate Excel reports of all cashier data by date range.',
                        'route' => route('cashier.export.show'),
                        'color' => 'purple',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6" /></svg>',
                    ],
                    [
                        'title' => 'Export Cash Entry',
                        'description' => 'Export detailed Excel reports for cashier cash input data.',
                        'route' => route('cashierentry.export.show'),
                        'color' => 'yellow',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 2v4m0 4v2m-6 2h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',
                    ],
                    [
                        'title' => 'Import Balances',
                        'description' => 'Upload Excel files to import opening/closing balance data.',
                        'route' => route('balance.import.show'),
                        'color' => 'sky',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>',
                    ],
                    [
                        'title' => 'Export Box Audits',
                        'description' => 'Export reports for auditing and reconciliation of cash box data.',
                        'route' => route('cashieraudits.index'),
                        'color' => 'red',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10m-8-4l8 4m-8-4v-2" /></svg>',
                    ],
                    [
                        'title' => 'Manage Balance',
                        'description' => 'edit, add, and delete balance audit records manually.',
                        'route' => route('balance-audits.index'), // **الرابط الجديد**
                        'button' => 'Manage Audits',
                        'color' => 'sky', // مطابقة للون صفحة Import Balance
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>',
                    ],
                ];
            @endphp

            {{-- Tile Grid Container (4 columns on large screens) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach($features as $feature)
                    <a href="{{ $feature['route'] }}"
                       class="group block bg-white rounded-xl p-6 shadow-lg border border-gray-100 transition-all duration-300 transform hover:shadow-2xl hover:-translate-y-1 hover:border-{{ $feature['color'] }}-500">

                        <div class="text-center">
                            {{-- Icon --}}
                            <div class="mx-auto w-16 h-16 flex items-center justify-center p-3 rounded-full bg-{{ $feature['color'] }}-100 text-{{ $feature['color'] }}-600 mb-4 transition-colors duration-300 group-hover:bg-{{ $feature['color'] }}-500 group-hover:text-white">
                                {!! $feature['icon'] !!}
                            </div>

                            {{-- Title --}}
                            <h2 class="text-lg font-bold text-slate-800 mb-2 leading-tight transition-colors duration-300 group-hover:text-{{ $feature['color'] }}-700">
                                {{ $feature['title'] }}
                            </h2>

                            {{-- Description (Slightly Reduced Visibility) --}}
                            <p class="text-gray-500 text-xs mt-1">
                                {{ $feature['description'] }}
                            </p>

                        </div>
                    </a>
                @endforeach

            </div>

            {{-- Footer Note --}}
            <p class="text-center text-gray-400 text-xs mt-12">
                © {{ date('Y') }} AhmedTawab. All rights reserved.
            </p>

        </div>
    </div>
@endsection
