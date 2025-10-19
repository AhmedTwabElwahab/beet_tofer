@extends('layouts.app')

@section('title', 'Export Cashier Audit Reports')

@section('content')
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Card Container: زودت max-width وpadding أكبر --}}
        <div class="w-full max-w-4xl mx-auto bg-white rounded-xl shadow-2xl p-10 ring-1 ring-gray-100 border-l-4 border-red-500">

            <h2 class="text-3xl font-extrabold mb-8 text-center text-slate-800">
                Export Cashier Audit Report
            </h2>

            <form action="{{ route('cashieraudits.export') }}" method="POST" class="space-y-6">
                @csrf

                {{-- تصدير بتاريخ محدد --}}
                <div class="p-5 bg-red-50 rounded-lg border border-red-200">
                    <label for="date" class="block text-sm font-bold text-gray-700 mb-3">
                        Select Specific Date
                    </label>
                    <input type="date" id="date" name="date"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-800 transition duration-150"
                           value="{{ date('Y-m-d') }}">
                </div>

                {{-- تصدير بين تاريخين --}}
                <div class="p-5 bg-red-50 rounded-lg border border-red-200">
                    <label class="block text-sm font-bold text-gray-700 mb-3">
                        Export Between Two Dates
                    </label>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <input type="date" name="from_date"
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-800"
                               placeholder="From Date">
                        <input type="date" name="to_date"
                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 text-gray-800"
                               placeholder="To Date">
                    </div>
                </div>

                {{-- أزرار التصدير --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <button type="submit" name="export_type" value="single"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold text-base focus:outline-none focus:ring-4 focus:ring-red-300 transition shadow-lg">
                        Download By Date
                    </button>

                    <button type="submit" name="export_type" value="range"
                            class="flex-1 bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-semibold text-base focus:outline-none focus:ring-4 focus:ring-orange-300 transition shadow-lg">
                        Export Between Dates
                    </button>

                    <button type="submit" name="export_type" value="all"
                            class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-3 rounded-lg font-semibold text-base focus:outline-none focus:ring-4 focus:ring-gray-300 transition shadow-lg">
                        Export All Data
                    </button>
                </div>
            </form>

            {{-- عرض مثال البيانات --}}
            <div class="mt-8 p-6 rounded-lg border-2 border-red-200 shadow-sm bg-red-50">
                <h3 class="font-bold text-lg text-red-800 mb-3 flex items-center">
                    Report Contents:
                </h3>
                <ul class="text-sm text-red-700 space-y-2">
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Date:</span> <span>`date`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Cashier No:</span> <span>`cashier_number`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Branch No:</span> <span>`branch_id`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Balance:</span> <span>`balance`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Cash:</span> <span>`cash`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Network:</span> <span>`network`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-red-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Returned:</span> <span>`returned`</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
