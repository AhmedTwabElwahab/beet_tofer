@extends('layouts.app')

@section('title', 'Export Cashier Reports')

@section('content')
    {{-- Main Container and Background --}}
    <div class="bg-gray-50 min-h-screen flex items-start justify-center py-10">

        {{-- Card Container (Compact and clean design) --}}
        <div class="max-w-md w-full mx-auto bg-white rounded-xl shadow-2xl p-7 ring-1 ring-gray-100 border-l-4 border-purple-500">

            {{-- Title --}}
            <h2 class="text-3xl font-extrabold mb-7 text-center text-slate-800">
                Export General Cashier Report
            </h2>

            <form action="{{ route('cashier.export') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Date Input Section --}}
                <div class="p-4 bg-purple-50 rounded-lg border border-purple-200">
                    <label for="date" class="block text-sm font-bold text-gray-700 mb-3">
                        <span class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Select Date for Report
                        </span>
                    </label>
                    <input type="date" id="date" name="date"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition duration-150"
                           value="{{ date('Y-m-d') }}" required>
                </div>

                {{-- Download Button (Using Purple color) --}}
                <button type="submit"
                        class="w-full bg-purple-600 text-white py-3 px-4 rounded-lg font-semibold text-lg hover:bg-purple-700 transition shadow-lg focus:outline-none focus:ring-4 focus:ring-purple-300">
                    <div class="flex items-center justify-center gap-2">
                        {{-- الأيقونة المذكورة في لوحة التحكم (Export Reports) --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0h6" />
                        </svg>
                        Download Excel Report
                    </div>
                </button>
            </form>

            {{-- Report Contents (List style similar to transactions page for consistency) --}}
            <div class="mt-8 p-5 rounded-lg border-2 border-purple-200 shadow-sm bg-purple-50">
                <h3 class="font-bold text-lg text-purple-800 mb-3 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-4h6v4m-3-4V3m0 0l-3 3m3-3l3 3m2 14H7a2 2 0 01-2-2v-3a2 2 0 012-2h10a2 2 0 012 2v3a2 2 0 01-2 2z" />
                    </svg>
                    Report Contents:
                </h3>
                <ul class="text-sm text-purple-700 space-y-2">
                    <li class="flex justify-between items-center py-1 border-b border-purple-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Report Date:</span> <span>`date`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-purple-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Cashier ID:</span> <span>`cashier_number`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-purple-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Branch ID:</span> <span>`branch_id`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-purple-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Cash Value:</span> <span>`cash_value`</span>
                    </li>
                    <li class="flex justify-between items-center py-1 border-b border-purple-200 last:border-b-0">
                        <span class="font-semibold text-gray-800">Network Value:</span> <span>`network_value`</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
